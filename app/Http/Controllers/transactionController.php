<?php

namespace App\Http\Controllers;

use App\Models\album;
use App\Models\transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class transactionController extends Controller
{
    public function buyConfirm(Request $request, album $album)
    {
        if (!Gate::allows('user')) {
            return abort(403);
        }
        $request->validate([
            'jumlah' => 'required|numeric|min:1'
        ], [
            'jumlah.required' => 'Jumlah harus diisi',
            'jumlah.numeric' => 'Jumlah harus berupa angka',
            'jumlah.min' => 'Jumlah minimal 1'
        ]);

        $transaction = new transaction();

        $transaction->user_id = Auth::user()->id;
        $transaction->album_id = $album->id;
        $transaction->jumlah = $request->jumlah;
        $transaction->harga = $album->price * $request->jumlah;
        $transaction->status = 'unpaid';

        $album->stock -= $request->jumlah;

        $album->save();
        $transaction->save();
        
        return redirect('history')->with('success', 'Berhasil Memesan Album');
    }

    public function confirm(transaction $transaction)
    {
        if (!Gate::allows('admin')) {
            return abort(403);
        }
        $transaction->status = 'paid';
        $transaction->save();

        return redirect('admin/transactionList')->with('success', 'Berhasil Konfirmasi Pembayaran');
    }

    public function reject(transaction $transaction)
    {
        if (!Gate::allows('admin')) {
            return abort(403);
        }
        $transaction->status = 'unpaid';
        $transaction->save();

        return redirect('admin/transactionList')->with('success', 'Berhasil Reject Pembayaran');
    }
}
