@extends('base.base')

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

<div class="py-10 px-6 md:px-20">
    <div class="max-w-4xl mx-auto">

        <h1 class="text-3xl my-10 font-raleway font-semibold text-center text-white mb-4">
            Transaction History
        </h1>

        @if($transactions->count() > 0)
            <div class="overflow-x-auto bg-transparent text-white">
                <table class="my-10 min-w-full bg-transparent border-collapse">
                    <thead>
                        <tr class="text-white">
                            <th class="py-2 px-4 border-b text-sm text-center">Transaction Id</th>
                            <th class="py-2 px-4 border-b text-sm text-center">Album Photo</th>
                            <th class="py-2 px-4 border-b text-sm text-center">Album Name</th>
                            <th class="py-2 px-4 border-b text-sm text-center">Quantity</th>
                            <th class="py-2 px-4 border-b text-sm text-center">Price</th>
                            <th class="py-2 px-4 border-b text-sm text-center">Status</th>
                            <th class="py-2 px-4 border-b text-sm text-center">Action</th>
                            <th class="py-2 px-4 border-b text-sm text-center">Created At</th>
                            <th class="py-2 px-4 border-b text-sm text-center">Updated At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $transaction)
                            <tr class="transition-colors duration-300 hover:bg-gray-700 hover:bg-opacity-80">
                                <td class="py-2 px-4 text-sm text-center">{{ $transaction->id }}</td>
                                <td class="py-2 px-4 text-sm flex justify-center">
                                    <img src="{{ URL::asset('images/albums/' . $transaction->album->photo) }}" alt="Album Image" class="h-16 w-16 object-cover rounded">
                                </td>
                                <td class="py-2 px-4 text-sm text-center">{{ $transaction->album->name }}</td>
                                <td class="py-2 px-4 text-sm text-center">{{ $transaction->jumlah }}</td>
                                <td class="py-2 px-4 text-sm text-center">{{ number_format($transaction->harga, 2) }}</td>
                                @if ($transaction->status == 'unpaid')
                                    <td class="py-2 px-4 text-red-500 text-sm text-center">
                                        Unpaid
                                    </td>
                                    <td class="py-2 px-4 text-sm text-center">
                                        <form action="{{ route('pay', ['transaction' => $transaction['id']]) }}" method="get" >
                                            @csrf
                                            <button type="submit" class="px-4 py-2 bg-green-400 text-gray-900 font-semibold rounded-lg hover:bg-green-500 focus:outline-none focus:ring-4 focus:ring-green-300">
                                                Pay
                                            </button>
                                        </form>
                                    </td>
                                @elseif ($transaction->status == 'pending')
                                    <td class="py-2 px-4 text-orange-500 text-sm text-center">
                                        Pending
                                    </td>
                                    <td class="py-2 px-4 text-sm text-center">
                                        <button class="px-4 py-2 bg-gray-400 text-white font-semibold rounded-lg cursor-not-allowed" disabled>
                                            Pending
                                        </button>
                                    </td>
                                @elseif ($transaction->status == 'paid')
                                    <td class="py-2 px-4 text-green-500 text-sm text-center">
                                        Paid
                                    </td>
                                    <td class="py-2 px-4 text-sm text-center">
                                        <button class="px-4 py-2 bg-gray-400 text-white font-semibold rounded-lg cursor-not-allowed" disabled>
                                            Paid
                                        </button>
                                    </td>
                                @elseif ($transaction->status == 'delivered')
                                    <td class="py-2 px-4 text-green-500 text-sm text-center">
                                        Delivered
                                    </td>
                                    <td class="py-2 px-4 text-sm text-center">
                                        <button class="px-4 py-2 bg-gray-400 text-white font-semibold rounded-lg cursor-not-allowed" disabled>
                                            Delivered
                                        </button>
                                    </td>
                                @endif

                                <td class="py-2 px-4 text-sm text-center">
                                    {{ $transaction->created_at ? $transaction->created_at->format('d M Y H:i') : 'Unknown' }}
                                </td>
                                <td class="py-2 px-4 text-sm text-center">
                                    {{ $transaction->updated_at ? $transaction->updated_at->format('d M Y H:i') : 'Unknown' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-white text-center font-raleway text-lg mt-10">No transactions found</p>
        @endif
        
    </div>
</div>

@endsection
