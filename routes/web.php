<?php

use App\Http\Controllers\albumController;
use App\Http\Controllers\authController;
use App\Http\Controllers\commentController;
use App\Http\Controllers\paymentController;
use App\Http\Controllers\songController;
use App\Http\Controllers\transactionController;
use App\Http\Controllers\userController;
use App\Models\album;
use App\Models\genre;
use App\Models\payment;
use App\Models\song;
use App\Models\transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


// no login needed
Route::get('/', function () {
    return view('home', ['albums' => album::all(), 'genres' => genre::all()]);
})->name('home');
Route::get('/genre/{genre:id?}', [albumController::class, 'show'])->name('genre');
Route::get('/album/{album:id}', [albumController::class, 'showAlbum'])->name('album');
Route::get('/song/{song:id}', [songController::class, 'show'])->name('song');
Route::get('/search', [albumController::class, 'search'])->name('search');
Route::get('/login', [authController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login_auth', [authController::class, 'login_auth'])->name('login.post');
Route::post('/logout', [authController::class, 'logout'])->name('logout');
Route::get('/signUp', [userController::class, 'index'])->name('signUp');
Route::post('/signUp_create', [userController::class, 'signUp'])->name('signUp.post');

//login needed
Route::middleware(['auth'])->group(function(){
    Route::middleware(['role:user'])->group(function(){
        Route::get('/history', function () {
            return view('user.history', ['transactions' => transaction::where('user_id', Auth::id())->orderByDesc('updated_at')->get()]);
        })->name('history');
        Route::get('/buy/{album:id}', [albumController::class, 'buy'])->name('buy');
        Route::post('/buy/{album:id}/confirm', [transactionController::class, 'buyConfirm'])->name('buy.confirm');
        Route::post('/comment/{album:id}', [commentController::class, 'comment'])->name('comment');
        Route::get('/pay/{transaction:id}', function ($transaction) {
            return view('user.pay', ['transaction' => transaction::where('id', $transaction)->first()]);
        })->name('pay');
        Route::post('/pay/{transaction:id}/confirm', [paymentController::class, 'payConfirm'])->name('pay.confirm');
    });

    Route::middleware(['role:admin'])->group(function(){
        Route::get('/admin', function () {
            return view('admin.homeAdmin', ['albums' => album::all()], ['transactions' => transaction::all()]);
        })->name('admin.home');
        Route::get('/admin/albumList', function () {
            return view('admin.albumList', ['unavailableAlbums' => album::where('status', 0)->get(), 'availableAlbums' => album::where('status', 1)->get()]);
        })->name('admin.albumList');
        Route::get('admin/approve/{album:id}', function($id) {
            return view('admin.approveAlbum', ['album' => album::where('id', $id)->first()]);
        })->name('admin.approve');
        Route::put('/admin/approve/album/{album:id}', [albumController::class, 'approve'])->name('admin.approveAlbum');
        Route::delete('/admin/delete/album/{album:id}', [albumController::class, 'delete'])->name('admin.deleteAlbum');
        Route::get('/admin/editStock/{album:id}', function($id) {
            return view('admin.editStock', ['album' => album::where('id', $id)->first()]);
        })->name('admin.editStock');
        Route::put('/admin/updateStock/{album:id}', [albumController::class, 'updateStock'])->name('admin.updateStock');
        Route::get('/admin/transactionList', function () {
            return view('admin.transactionList', ['pendingTransactions' => transaction::where('status', 'pending')->orderByDesc('updated_at')->get(), 'otherTransactions' => transaction::where('status', '!=', 'pending')->orderByDesc('updated_at')->get()]);
        })->name('admin.transactionList');
        Route::get('/admin/transaction/review/{transaction:id}', function($id) {
            return view('admin.reviewTransaction', ['transaction' => transaction::where('id', $id)->orderByDesc('created_at')->first(), 'payment' => payment::where('transaction_id', $id)->orderByDesc('created_at')->first()]);
        })->name('admin.reviewTransaction');
        Route::put('/admin/transaction/confirm/{transaction:id}', [transactionController::class, 'confirm'])->name('admin.confirmTransaction');
        Route::put('/admin/transaction/reject/{transaction:id}', [transactionController::class, 'reject'])->name('admin.rejectTransaction');
        Route::get('/admin/report', function () {
            return view('admin.report', ['albums' => album::all()]);
        })->name('admin.report');
    });

    Route::middleware(['role:artist'])->group(function(){
        Route::get('/artist', function () {
            return view('artist.homeArtist', ['albums' => album::where('artist_id', Auth::id())->get()], ['genres' => genre::all()]);
        })->name('artist.home');
        Route::get('/artist/search', [albumController::class, 'artistSearch'])->name('artist.search');
        Route::get('/artist/genre/{genre:id?}', [albumController::class, 'artistShow'])->name('artist.genre');
        
        Route::get('/artist/addAlbum', function () {
            return view('artist.addAlbum', ['genres' => genre::all()]);
        })->name('artist.addAlbum');
        Route::post('/artist/createAlbum', [albumController::class, 'create'])->name('artist.createAlbum');
        Route::get('/artist/editAlbum/{album:id}', function ($id) {
            return view('artist.editAlbum', ['genres' => genre::all()], ['album' => album::where('id', $id)->first()]);
        })->name('artist.editAlbum');
        Route::put('/artist/updateAlbum/{album:id}', [albumController::class, 'update'])->name('artist.updateAlbum');
        Route::delete('/artist/deleteAlbum/{album:id}', [albumController::class, 'delete'])->name('artist.deleteAlbum');

        Route::get('/artist/songList/{album:id}', function ($id) {
            return view('artist.songList', ['album' => album::where('id', $id)->first()]);
        })->name('artist.songList');
        Route::get('/artist/addSong/{album:id}', function ($id) {
            return view('artist.addSong', ['album' => album::where('id', $id)->first(), 'genres' => genre::all()]);
        })->name('artist.addSong');
        Route::post('/artist/createSong/{album:id}', [songController::class, 'create'])->name('artist.createSong');
        Route::get('/artist/editSong/{song:id}', function ($id) {
            return view('artist.editSong', ['song' => song::where('id', $id)->first(), 'genres' => genre::all()]);
        })->name('artist.editSong');
        Route::put('/artist/updateSong/{song:id}', [songController::class, 'update'])->name('artist.updateSong');
        Route::delete('/artist/deleteSong/{song:id}', [songController::class, 'delete'])->name('artist.deleteSong');
        Route::get('/artist/song/{song:id}', function ($id) {
            return view('artist.songArtist', ['song' => song::where('id', $id)->first()]);
        })->name('artist.song');

        Route::get('artist/report', function () {
            return view('artist.report', ['albums' => album::where('artist_id', Auth::id())->get()]);
        })->name('artist.report');
    });
});
