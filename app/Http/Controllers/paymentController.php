<?php

namespace App\Http\Controllers;

use App\Models\payment;
use App\Models\transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class paymentController extends Controller
{
    public function payConfirm(Transaction $transaction, Request $request)
    {
        if (!Gate::allows('user')) {
            return abort(403);
        }
        $validated = $request->validate([
            'payment_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'payment_image.required' => 'Payment proof must be uploaded',
            'payment_image.image' => 'Payment proof must be an image',
            'payment_image.mimes' => 'Payment proof must be a jpeg, png, or jpg',
            'payment_image.max' => 'Payment proof must be less than 2MB',
        ]);

        if ($request->hasFile('payment_image')) {
            $image = $request->file('payment_image');
            $imageName = time() . '.' . $image->getClientOriginalName();
            $image->move('images/payment_proofs', $imageName);
        }

        $payment = new payment();
        $payment->transaction_id = $transaction->id;

        $payment->receipt = $imageName;

        $transaction->status = 'pending';

        $transaction->save();
        $payment->save();

        return redirect()->route('history', $transaction->id)->with('success', 'Payment confirmed and status updated.');
    }
}
