@extends('base.baseArtist')

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

<h1 class="text-green-400 text-center font-raleway font-bold text-3xl my-10">MY ALBUMS</h1>

<div class="text-center mx-4 my-6">
    <form action="{{ route('artist.search') }}" method="GET" class="flex justify-center items-center">
        @csrf
        <input type="text" name="search" class="w-2/3 sm:w-1/2 lg:w-1/3 px-4 py-2 rounded-lg text-gray-800 focus:ring focus:ring-green-400 focus:outline-none" placeholder="Search albums..." value=""/>
        <button 
            type="submit" 
            class="ml-4 px-4 py-2 bg-green-400 text-black font-medium rounded-lg hover:bg-green-500 focus:outline-none focus:ring-4 focus:ring-green-300">
            Search
        </button>
    </form>
</div>

<div class="text-center mx-4 my-6">
    <a href="{{ route('artist.addAlbum') }}" class="inline-flex items-center px-4 py-2 bg-green-400 text-black font-medium rounded-lg hover:bg-green-500 focus:outline-none focus:ring-4 focus:ring-green-300">
        Add New Album
    </a>
</div>

<h1 class="text-white text-center font-raleway font-bold text-2xl my-8">Genres</h1>
<div class="text-center mx-4 my-10 font-raleway font-semibold uppercase text-m grid grid-flow-col text-white gap-2">
<a href="/artist/genre" class="mx-10 hover:underline">All</a>
    @foreach ($genres as $genre)
        <a href="/artist/genre/{{ $genre['id'] }}" class="mx-10 hover:underline">{{ $genre['name'] }}</a>
    @endforeach
</div>

<div class="text-center mx-10 my-10 font-serif font-semibold text-m grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 text-white gap-4">
    @php
        $count = 0;
    @endphp
    @foreach ($albums as $album)
    @php
        $count++;
    @endphp
    <div class="max-w-sm bg-gray-800 border border-gray-700 rounded-lg shadow-lg overflow-hidden hover:shadow-2xl transition-shadow duration-300">
    <img class="w-full h-72 object-cover rounded-t-lg" src="{{ URL::asset('images/albums/' . $album['photo']) }}" alt="Album photo" />  
    <div class="p-4">
        <h5 class="mb-2 text-lg font-semibold text-white font-raleway truncate">{{ $album['name'] }}</h5>
        @if ($album->song->count() == 0)
            <p class="mb-3 text-gray-400 font-raleway text-sm">No Songs</p>
        @else
            <p class="mb-3 text-gray-400 font-raleway text-sm">{{ $album->song->count() }} Songs</p>
        @endif
        @if ($album->status == 1)
            <p class="mb-3 text-green-400 font-raleway text-sm">Available</p>
            <p class="mb-3 text-gray-400 font-raleway text-sm">Stock: {{ $album->stock }}</p>
        @else
            <p class="mb-3 text-red-400 font-raleway text-sm">Unavailable</p>
            <p class="mb-3 text-gray-400 font-raleway text-sm">Stock: -</p>
        @endif
        
        @php
        $sold = 0;
        $transactions = $album->transaction;
        foreach ($transactions as $transaction) {
            $sold += $transaction->jumlah;
        }
        @endphp
        <p class="mb-3 text-gray-400 font-raleway text-sm">Sold: {{ $sold }}</p>

        @if ($album->status == 0)
            <div class="flex flex-wrap justify-between space-x-2 mt-4">
                <a href="{{ route('artist.editAlbum', ['album' => $album->id]) }}" 
                class="flex-1 flex items-center justify-center px-3 py-2 text-sm font-raleway font-medium text-center text-black bg-green-400 rounded-lg hover:bg-green-500 focus:outline-none focus:ring-4 focus:ring-green-300">
                    Edit
                </a>
                <a href="{{ route('artist.songList', ['album' => $album->id]) }}" 
                class="flex-1 flex items-center justify-center px-3 py-2 text-sm font-raleway font-medium text-center text-black bg-blue-400 rounded-lg hover:bg-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-300">
                    Song List
                </a>
            </div>
            <div class="mt-4">
                <form action="{{ route('artist.deleteAlbum', ['album' => $album->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="w-full flex items-center justify-center px-3 py-2 text-sm font-raleway font-medium text-center text-black bg-red-400 rounded-lg hover:bg-red-500 focus:outline-none focus:ring-4 focus:ring-red-300">
                        Delete Album and Songs
                    </button>
                </form>
            </div>
        @else
            <div class="flex flex-wrap justify-between space-x-2 mt-4">
                <a href="javascript:void(0)" 
                class="flex-1 flex items-center justify-center px-3 py-2 text-sm font-raleway font-medium text-center text-gray-500 bg-gray-300 rounded-lg cursor-not-allowed">
                    Edit
                </a>
                <a href="javascript:void(0)" 
                class="flex-1 flex items-center justify-center px-3 py-2 text-sm font-raleway font-medium text-center text-gray-500 bg-gray-300 rounded-lg cursor-not-allowed">
                    Add Song
                </a>
            </div>
            <div class="mt-4">
                <form action="javascript:void(0)" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" 
                            class="w-full flex items-center justify-center px-3 py-2 text-sm font-raleway font-medium text-center text-gray-500 bg-gray-300 rounded-lg cursor-not-allowed">
                        Delete
                    </button>
                </form>
            </div>
        @endif
    </div>
</div>

    @endforeach
</div>

@if ($count == 0)
    <h1 class="text-white text-center font-raleway italic text-m my-8">No Albums Found</h1>
@endif

@endsection
