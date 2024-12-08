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

<h1 class="text-green-400 text-center font-raleway font-bold text-3xl my-10">Transaction List</h1>

<div class="max-w-6xl mx-auto my-10 bg-gray-800 border border-gray-700 rounded-lg shadow-lg p-8">
    <h2 class="text-green-400 text-xl font-medium mb-4">Pending Transactions</h2>
    
    @if ($pendingTransactions->isEmpty())
        <p class="text-red-500">No pending transactions found.</p>
    @else
        <table class="min-w-full table-auto border-collapse mb-10">
            <thead>
                <tr class="bg-gray-900 text-white">
                    <th class="py-3 px-6 text-center">Id</th>
                    <th class="py-3 px-6 text-center">User</th>
                    <th class="py-3 px-6 text-center">Album</th>
                    <th class="py-3 px-6 text-center">Quantity</th>
                    <th class="py-3 px-6 text-center">Price</th>
                    <th class="py-3 px-6 text-center">Status</th>
                    <th class="py-3 px-6 text-center">Created At</th>
                    <th class="py-3 px-6 text-center">Updated At</th>
                    <th class="py-3 px-6 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="text-white">
                @foreach($pendingTransactions as $index => $transaction)
                    <tr class="bg-gray-700 border-b hover:bg-gray-600">
                        <td class="py-3 px-6 text-center">{{ $transaction->id }}</td>
                        <td class="py-3 px-6 text-center">{{ $transaction->user->name }}</td>
                        <td class="py-3 px-6 text-center">{{ $transaction->album->name }}</td>
                        <td class="py-3 px-6 text-center">{{ $transaction->jumlah }}</td>
                        <td class="py-3 px-6 text-center">{{ number_format($transaction->harga, 2) }}</td>
                        <td class="py-3 px-6 text-center">
                            <span class="text-orange-400">Pending</span>
                        </td>
                        <td class="py-3 px-6 text-center">{{ $transaction->created_at ? $transaction->created_at->format('d M Y H:i') : 'Unknown' }}</td>
                        <td class="py-3 px-6 text-center">{{ $transaction->updated_at ? $transaction->updated_at->format('d M Y H:i') : 'Unknown' }}</td>
                        <td class="py-3 px-6 text-center">
                            <a href="{{ route('admin.reviewTransaction', ['transaction' => $transaction->id]) }}" 
                               class="text-green-400 hover:underline">Review</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

<div class="max-w-6xl mx-auto my-10 bg-gray-800 border border-gray-700 rounded-lg shadow-lg p-8">
    <h2 class="text-green-400 text-xl font-medium mb-4">Other Transactions</h2>
    
    @if ($otherTransactions->isEmpty())
        <p class="text-red-500">No other transactions found.</p>
    @else
        <table class="min-w-full table-auto border-collapse mb-10">
            <thead>
                <tr class="bg-gray-900 text-white">
                    <th class="py-3 px-6 text-center">Id</th>
                    <th class="py-3 px-6 text-center">User</th>
                    <th class="py-3 px-6 text-center">Album</th>
                    <th class="py-3 px-6 text-center">Quantity</th>
                    <th class="py-3 px-6 text-center">Price</th>
                    <th class="py-3 px-6 text-center">Status</th>
                    <th class="py-3 px-6 text-center">Created At</th>
                    <th class="py-3 px-6 text-center">Updated At</th>
                </tr>
            </thead>
            <tbody class="text-white">
                @foreach($otherTransactions as $index => $transaction)
                    <tr class="bg-gray-700 border-b hover:bg-gray-600">
                        <td class="py-3 px-6 text-center">{{ $transaction->id }}</td>
                        <td class="py-3 px-6 text-center">{{ $transaction->user->name }}</td>
                        <td class="py-3 px-6 text-center">{{ $transaction->album->name }}</td>
                        <td class="py-3 px-6 text-center">{{ $transaction->jumlah }}</td>
                        <td class="py-3 px-6 text-center">{{ number_format($transaction->harga, 2) }}</td>
                        <td class="py-3 px-6 text-center">
                            @if ($transaction->status == 'paid')
                                <span class="text-green-400">Paid</span>
                            @elseif ($transaction->status == 'delivered')
                                <span class="text-green-400">Delivered</span>
                            @elseif ($transaction->status == 'unpaid')
                                <span class="text-red-400">Unpaid</span>
                            @endif
                        </td>
                        <td class="py-3 px-6 text-center">{{ $transaction->created_at ? $transaction->created_at->format('d M Y H:i') : 'Unknown' }}</td>
                        <td class="py-3 px-6 text-center">{{ $transaction->updated_at ? $transaction->updated_at->format('d M Y H:i') : 'Unknown' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

@endsection
