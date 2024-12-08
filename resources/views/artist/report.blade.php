@extends('base.baseArtist')

@section('content')

<h1 class="text-green-400 text-center font-raleway font-bold text-3xl my-10">Sold Albums Report</h1>

<div class="max-w-6xl mx-auto my-10 bg-gray-800 border border-gray-700 rounded-lg shadow-lg p-8 pb-5">
    <h2 class="text-white text-xl font-medium mb-4">Album List</h2>
    
    @if ($albums->isEmpty())
    <p class="text-red-500">No Albums Found</p>
    @else
    <table class="min-w-full table-auto border-collapse">
        <thead>
            <tr class="bg-gray-900 text-white">
                <th class="py-3 px-6 text-center">Album Name</th>
                <th class="py-3 px-6 text-center">Stock</th>
                <th class="py-3 px-6 text-center">Sold</th>
                <th class="py-3 px-6 text-center">Price</th>
                <th class="py-3 px-6 text-center">Total Earnings</th>
            </tr>
        </thead>
        <tbody class="text-white">
            @php
                $totalEarningsAllAlbums = 0;
            @endphp
            @foreach($albums as $album)
                @php
                    $transactions = $album->transaction;
                    $totalSold = 0;
                    foreach($transactions as $transaction) {
                        $totalSold += $transaction->jumlah;
                    }
                    $stock = $album->stock ?? '-';
                    $price = $album->price ?? '-';
                    $formattedPrice = $price !== '-' ? number_format($price, 2) : '-';
                    $totalEarnings = $totalSold !== 0 && $price !== '-' ? number_format($price * $totalSold, 2) : '-';
                    
                    if ($totalEarnings !== '-') {
                        $totalEarningsAllAlbums += $price * $totalSold;
                    }
                @endphp
                <tr class="bg-gray-700 border-b hover:bg-gray-600">
                    <td class="py-3 px-6 text-center">{{ $album->name }}</td>
                    <td class="py-3 px-6 text-center">{{ $stock }}</td>
                    <td class="py-3 px-6 text-center">{{ $totalSold }}</td>
                    <td class="py-3 px-6 text-center">{{ $formattedPrice }}</td>
                    <td class="py-3 px-6 text-center">{{ $totalEarnings }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-6 text-white text-lg font-medium p-4 rounded-lg">
        <p class="text-right">Total Earnings: {{ number_format($totalEarningsAllAlbums, 2) }}</p>
    </div>
    @endif
</div>

@endsection
