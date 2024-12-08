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

<h1 class="text-green-400 text-center font-raleway font-bold text-3xl my-10">Admin Dashboard</h1>

<div class="max-w-6xl mx-auto my-10 grid grid-cols-1 md:grid-cols-3 gap-6">
    <a href="{{ route('admin.albumList') }}" 
       class="bg-gray-800 border border-gray-700 rounded-lg shadow-lg p-6 hover:bg-gray-700 transition-all text-center">
        <h2 class="text-white text-xl font-bold mb-4">Album List</h2>
        <p class="text-gray-400">View and manage all albums.</p>
        @if ($albums->where('status', 0)->count() > 0)
            <p class="text-red-400">You have {{ $albums->where('status', 0)->count() }} albums to review.</p>
        @else
            <p class="text-green-400">You have no albums to review.</p>
        @endif
    </a>

    <a href="{{ route('admin.transactionList') }}" 
       class="bg-gray-800 border border-gray-700 rounded-lg shadow-lg p-6 hover:bg-gray-700 transition-all text-center">
        <h2 class="text-white text-xl font-bold mb-4">Transactions</h2>
        <p class="text-gray-400">View and manage Transactions.</p>
        @if ($transactions->where('status', 'pending')->count() > 0)
            <p class="text-red-400">You have {{ $transactions->where('status', 'pending')->count() }} transactions to review.</p>
        @else
            <p class="text-green-400">You have no transaction to review.</p>
        @endif
    </a>

    <a href="{{ route('admin.report') }}" 
       class="bg-gray-800 border border-gray-700 rounded-lg shadow-lg p-6 hover:bg-gray-700 transition-all text-center">
        <h2 class="text-white text-xl font-bold mb-4">Report</h2>
        <p class="text-gray-400">Generate and view reports.</p>
    </a>
</div>

@endsection
