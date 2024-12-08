<?php

namespace App\Http\Controllers;

use App\Models\album;
use App\Models\genre_song;
use App\Models\song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class songController extends Controller
{
    public function show(song $song){
        return view('song', ['song' => $song]);
    }

    public function create(album $album, Request $request){
        if (!Gate::allows('artist')) {
            return abort(403);
        }
        $validate = $request->validate([
            'name' => 'required',
            'duration' => ['required', 'regex:/^\d{2}:\d{2}:\d{2}$/'],
            'lyrics' => 'required',
            'genres' => 'required',
            'genres.*' => 'exists:genre,id'

        ], [
            'name.required' => 'Name is required',
            'duration.required' => 'Duration is required',
            'duration.regex' => 'Duration must be in format HH:MM:SS',
            'lyrics.required' => 'Lyrics is required',
            'genres.required' => 'Genre is required',
            'genres.*.exists' => 'Genre is not valid'
        ]);

        $song = new song();
        $song->name = $request['name'];
        $song->duration = $request['duration'];
        $song->lyrics = $request['lyrics'];
        $song->album_id = $album->id;

        $song->save();

        foreach ($request->genres as $genre) {
            $genre_song = new genre_song();
            $genre_song->song_id = $song['id'];
            $genre_song->genre_id = $genre;
            $genre_song->save();
        }

        return redirect('/artist/songList/' . $album->id)->with('success', 'Song created successfully');
    }

    public function update(Request $request, song $song){
        if (!Gate::allows('artist')) {
            return abort(403);
        }
        $validated = $request->validate([
            'name' => 'required',
            'duration' => ['required', 'regex:/^\d{2}:\d{2}:\d{2}$/'],
            'lyrics' => 'required',
            'genres' => 'required',
            'genres.*' => 'exists:genre,id'

        ], [
            'name.required' => 'Name is required',
            'duration.required' => 'Duration is required',
            'duration.regex' => 'Duration must be in format HH:MM:SS',
            'lyrics.required' => 'Lyrics is required',
            'genres.required' => 'Genre is required',
            'genres.*.exists' => 'Genre is not valid'
        ]);

        $song->name = $request['name'];
        $song->duration = $request['duration'];
        $song->lyrics = $request['lyrics'];

        $song->save();

        genre_song::where('song_id', $song->id)->delete();

        foreach ($request->genres as $genre) {
            $genre_song = new genre_song();
            $genre_song->song_id = $song->id;
            $genre_song->genre_id = $genre;
            $genre_song->save();
        }

        return redirect('/artist/songList/' . $song->album_id)->with('success', 'Song updated successfully');
    }

    public function delete(song $song){
        if (!Gate::allows('artist')) {
            return abort(403);
        }
        $song->genre_song()->delete();
        $song->delete();
        return redirect('/artist/songList/' . $song->album_id)->with('success', 'Song deleted successfully');
    }
}
