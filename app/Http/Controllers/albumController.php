<?php

namespace App\Http\Controllers;

use App\Models\album;
use App\Models\genre;
use App\Models\genre_album;
use App\Models\transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class albumController extends Controller
{
    public function show(genre $genre = null)
    {
        if ($genre) {
            $albums = album::whereHas('genre', function ($query) use ($genre) {
                $query->where('genre_id', $genre->id);
            })->with('genre')->get();
        } else {
            $albums = album::with('genre')->get();
        }

        $genres = genre::all();

        return view('home', compact('albums', 'genres', 'genres'));
    }

    public function showAlbum(album $album)
    {
        return view('album', ['album' => $album]);
    }

    public function search(Request $request)
    {
        $albums = Album::where('name', 'like', '%' . $request->search . '%')->get();
        $genres = genre::all();

        return view('home', compact('albums', 'genres'));
    }

    public function buy(album $album)
    {
        return view('user.buy', ['album' => $album]);
    }

    public function artistSearch(Request $request)
    {
        if (!Gate::allows('artist')) {
            return abort(403);
        }
        $albums = Album::where('name', 'like', '%' . $request->search . '%')->where('artist_id', Auth::id())->get();
        $genres = genre::all();

        return view('artist.homeArtist', compact('albums', 'genres'));
    }

    public function artistShow(genre $genre = null)
    {
        if (!Gate::allows('artist')) {
            return abort(403);
        }
        if ($genre) {
            $albums = album::whereHas('genre', function ($query) use ($genre) {
                $query->where('genre_id', $genre->id);
            })->where('artist_id', Auth::id())->with('genre')->get();
        } else {
            $albums = album::where('artist_id', Auth::id())->with('genre')->get();
        }

        $genres = genre::all();

        return view('artist.homeArtist', compact('albums', 'genres'));
    }

    public function create(Request $request){
        if (!Gate::allows('artist')) {
            return abort(403);
        }
        $validated = $request->validate([
            'name' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
            'description' => 'required',
            'genres' => 'required',
            'genres.*' => 'exists:genre,id'
        ], [
            'name.required' => 'Album name must be filled',
            'photo.required' => 'Album photo must be uploaded',
            'photo.image' => 'Album photo must be an image',
            'photo.mimes' => 'Album photo must be a jpeg, png, jpg, or svg',
            'photo.max' => 'Album photo must be less than 2MB',
            'description.required' => 'Album description must be filled',
            'genres.required' => 'Album genre must be selected',
            'genres.*.exists' => 'Album genre must be selected from the list'
        ]);

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageName = time() . '.' . $image->getClientOriginalName();
            $image->move('images/albums', $imageName);
        }

        $album = new album();
        $album->artist_id = Auth::user()['id'];
        $album->name = $request->name;
        $album->photo = $imageName;
        $album->description = $request->description;

        $album->save();

        foreach ($request->genres as $genre) {
            $genre_album = new genre_album();
            $genre_album->album_id = $album['id'];
            $genre_album->genre_id = $genre;
            $genre_album->save();
        }

        return redirect('/artist')->with('success', 'Album successfully added');
    }

    public function update(album $album, Request $request) {
        if (!Gate::allows('artist')) {
            return abort(403);
        }
        $validated = $request->validate([
            'name' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
            'description' => 'required',
            'genres' => 'required',
            'genres.*' => 'exists:genre,id'
        ], [
            'name.required' => 'Album name must be filled',
            'photo.image' => 'Album photo must be an image',
            'photo.mimes' => 'Album photo must be a jpeg, png, jpg, or svg',
            'photo.max' => 'Album photo must be less than 2MB',
            'description.required' => 'Album description must be filled',
            'genres.required' => 'Album genre must be selected',
            'genres.*.exists' => 'Album genre must be selected from the list'
        ]);

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageName = time() . '.' . $image->getClientOriginalName();
            $image->move('images/albums', $imageName);
        } else {
            $imageName = $album->photo;
        }

        $album->name = $request->name;
        $album->photo = $imageName;
        $album->description = $request->description;

        $album->save();

        genre_album::where('album_id', $album->id)->delete();

        foreach ($request->genres as $genre) {
            $genre_album = new genre_album();
            $genre_album->album_id = $album->id;
            $genre_album->genre_id = $genre;
            $genre_album->save();
        }

        return redirect('/artist')->with('success', 'Album successfully updated');
    }

    public function delete(album $album) {
        if (!Gate::allows('artist') && !Gate::allows('admin')) {
            return abort(403);
        }
        $genre_album = $album->genre_album;
        if ($genre_album != null) {
            foreach ($genre_album as $ga) {
                $ga->delete();
            }
        }
        $songs = $album->song;
        if ($songs != null) {
            foreach ($songs as $song) {
                $genre_song = $song->genre_song;
                if ($genre_song != null) {
                    foreach ($genre_song as $gs) {
                        $gs->delete();
                    }
                }
                $song->delete();
            }
        }
        $album->delete();
        if (Auth::user()->roles->role == 'admin') {
            return redirect('/admin/albumList')->with('success', 'Album successfully deleted');
        }
        return redirect('/artist')->with('success', 'Album successfully deleted');
    }

    public function approve(album $album, Request $request) {
        if (!Gate::allows('admin')) {
            return abort(403);
        }
        $request->validate([
            'price' => 'required|numeric|min:1', 
            'stock' => 'required|integer|min:1'    
        ], [
            'price.required' => 'Album price must be filled',
            'price.numeric' => 'Album price must be a number',
            'price.min' => 'Album price must be at least 1',
            'stock.required' => 'Album stock must be filled',
            'stock.integer' => 'Album stock must be an integer',
            'stock.min' => 'Album stock must be at least 1'
        ]);

        $album->status = 1;
        $album->price = $request->price;
        $album->stock = $request->stock;

        $album->save();

        return redirect('/admin/albumList')->with('success', 'Album successfully approved');
    }

    public function updateStock(Request $request, album $album) {
        if (!Gate::allows('admin')) {
            return abort(403);
        }
        $request->validate([
            'stock' => 'required|integer|min:0'
        ], [
            'stock.required' => 'Album stock must be filled',
            'stock.integer' => 'Album stock must be an integer',
            'stock.min' => 'Album stock can not be negative'
        ]);

        $album->stock = $request->stock;

        $album->save();

        return redirect('/admin/albumList')->with('success', 'Album stock successfully updated');
    }
}

