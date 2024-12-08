@extends('base.base')

@section('content')

@if(session('error'))
    <div id="error-alert" class="fixed top-0 left-1/2 transform -translate-x-1/2 mt-8 w-4/5 sm:w-1/3 bg-red-100 border-t-4 border-red-500 text-red-700 px-6 py-4 rounded-lg shadow-md animate__animated animate__fadeIn">
        <div class="flex justify-between items-center">
            <span class="text-lg font-semibold">{{ session('error') }}</span>
            <button onclick="document.getElementById('error-alert').style.display='none'" class="text-red-700 hover:text-red-900 font-bold ml-4">
                &times;
            </button>
        </div>
    </div>
@endif

<div class="py-10 px-6 md:px-20">
    <div class="max-w-4xl mx-auto">

        <h1 class="text-3xl font-raleway font-semibold text-center text-white mb-4">
            Payment for {{ $transaction->album->name }}
        </h1>

        <div class="flex justify-center mb-8">
            <div class="max-w-xs">
                <img src="{{ URL::asset('images/albums/' . $transaction->album->photo) }}" alt="Album Image" class="w-64 h-64 object-cover rounded-md shadow-lg">
            </div>
        </div>

        <div class="bg-gray-800 p-6 rounded-md shadow-md mb-8">
            <h2 class="text-xl text-white font-semibold mb-4">Transaction Details</h2>
            <p class="text-white text-lg mb-2"><strong>Album Name:</strong> {{ $transaction->album->name }}</p>
            <p class="text-white text-lg mb-2"><strong>Quantity:</strong> {{ $transaction->jumlah }}</p>
            <p class="text-white text-lg mb-2"><strong>Total Price:</strong> {{ number_format($transaction->harga, 2) }}</p>

            @if ($transaction->status == 'unpaid')
                <p class="text-red-500 text-lg font-semibold">Status: Unpaid</p>
            @elseif ($transaction->status == 'paid')
                <p class="text-green-500 text-lg font-semibold">Status: Paid</p>
            @elseif ($transaction->status == 'delivered')
                <p class="text-blue-500 text-lg font-semibold">Status: Delivered</p>
            @endif
        </div>

        <form action="{{ route('pay.confirm', ['transaction' => $transaction['id']]) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-6">
                <label for="payment_image" class="text-white text-lg">Upload Payment Proof (Image)</label>
                <input type="file" id="payment_image" name="payment_image" class="mt-2 p-2 bg-transparent text-white border border-gray-600 rounded w-full" required>
                @error('payment_image')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <button type="submit" class="px-6 py-2 bg-green-400 text-gray-900 font-semibold rounded-lg hover:bg-green-500 focus:outline-none focus:ring-4 focus:ring-green-300">
                    Submit Payment
                </button>
            </div>

        </form>

    </div>
</div>

@endsection
