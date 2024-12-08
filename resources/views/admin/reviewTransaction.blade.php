@extends('base.baseAdmin')

@section('content')

@if(session('success'))
    <div id="success-alert" class="fixed top-0 left-1/2 transform -translate-x-1/2 mt-8 w-4/5 sm:w-1/3 bg-green-100 border-t-4 border-green-500 text-green-700 px-6 py-4 rounded-lg shadow-md animate__animated animate__fadeIn">
        <div class="flex justify-between items-center">
            <span class="text-lg font-semibold">{{ session('success') }}</span>
            <button onclick="document.getElementById('success-alert').style.display='none'" class="text-green-700 hover:text-green-900 font-bold ml-4">
                &times;
            </button>
        </div>
    </div>
@endif

<h1 class="text-green-400 text-center font-raleway font-bold text-3xl my-10">Review Transaction</h1>

<div class="max-w-6xl mx-auto my-10 bg-gray-800 border border-gray-700 rounded-lg shadow-lg p-8">

    <h2 class="text-green-400 text-xl font-medium mb-4">Transaction ID: {{ $transaction->id }}</h2>

    <div class="bg-gray-700 p-8 rounded-lg shadow-md mb-6">
        <div class="mb-4">
            <h3 class="text-white font-semibold">User</h3>
            <p class="text-white">{{ $transaction->user->name }}</p>
        </div>

        <div class="mb-4">
            <h3 class="text-white font-semibold">Album</h3>
            <p class="text-white">{{ $transaction->album->name }}</p>
        </div>

        <div class="mb-4">
            <h3 class="text-white font-semibold">Quantity</h3>
            <p class="text-white">{{ $transaction->jumlah }}</p>
        </div>

        <div class="mb-4">
            <h3 class="text-white font-semibold">Price</h3>
            <p class="text-white">{{ number_format($transaction->harga, 2) }}</p>
        </div>

        <div class="mb-4">
            <h3 class="text-white font-semibold">Status</h3>
            <p class="text-white">
                @if ($transaction->status == 'paid')
                    <span class="text-green-400">Paid</span>
                @elseif ($transaction->status == 'delivered')
                    <span class="text-green-400">Delivered</span>
                @elseif ($transaction->status == 'unpaid')
                    <span class="text-red-400">Unpaid</span>
                @elseif ($transaction->status == 'pending')
                    <span class="text-orange-400">Pending</span>
                @endif
            </p>
        </div>

        <div class="mb-4">
            <h3 class="text-white font-semibold">Transaction Date</h3>
            <p class="text-white">{{ $transaction->created_at ? $transaction->created_at->format('d M Y H:i') : 'Unknown' }}</p>
        </div>

        <div class="mb-4">
            <h3 class="text-white font-semibold">Payment Date</h3>
            <p class="text-white">{{ $payment->created_at ? $payment->created_at->format('d M Y H:i') : 'Unknown' }}</p>
        </div>
    </div>

    <div class="bg-gray-700 p-6 rounded-lg shadow-md mb-6">
        <h3 class="text-white font-semibold">Payment Receipt</h3>
        @if ($transaction->payment)
            <img src="{{ URL::asset('images/payment_proofs/' . $payment->receipt) }}" alt="Payment Receipt" class="w-full max-w-md mx-auto rounded-md shadow-md">
        @else
            <p class="text-red-500">No receipt available for this transaction.</p>
        @endif
    </div>

    <div class="flex justify-center gap-4 mt-6">
        <form action="{{ route('admin.confirmTransaction', ['transaction' => $transaction->id]) }}" method="POST">
            @method('PUT')
            @csrf
            <button type="submit" class="bg-green-400 text-black px-6 py-2 rounded-lg hover:bg-green-500">
                Confirm
            </button>
        </form>
        <form action="{{ route('admin.rejectTransaction', ['transaction' => $transaction->id]) }}" method="POST">
            @method('PUT') 
            @csrf
            <button type="submit" class="bg-red-400 text-black px-6 py-2 rounded-lg hover:bg-red-500">
                Reject
            </button>
        </form>
    </div>

</div>

@endsection
