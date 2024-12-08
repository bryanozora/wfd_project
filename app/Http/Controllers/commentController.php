<?php

namespace App\Http\Controllers;

use App\Models\album;
use App\Models\comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class commentController extends Controller
{
    public function comment(album $album, Request $request){
        if (!Gate::allows('user')) {
            return abort(403);
        }
        $request->validate([
            'comment' => 'required'
        ], [
            'comment.required' => 'Komentar harus diisi'
        ]);

        $comment = new comment();
        $comment->user_id = Auth::user()->id;
        $comment->album_id = $album->id;
        $comment->comment = $request->comment;

        $comment->save();

        return back()->with('success', 'Berhasil menambahkan komentar');
    }
}
