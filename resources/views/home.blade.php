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

<h1 class="text-green-400 text-center font-raleway font-bold text-3xl my-10">ALBUM LIST</h1>

<div class="text-center mx-4 my-6">
    <form action="{{ route('search') }}" method="GET" class="flex justify-center items-center">
        @csrf
        <input type="text" name="search" class="w-2/3 sm:w-1/2 lg:w-1/3 px-4 py-2 rounded-lg text-gray-800 focus:ring focus:ring-green-400 focus:outline-none" placeholder="Search albums..." value=""/>
        <button 
            type="submit" 
            class="ml-4 px-4 py-2 bg-green-400 text-black font-medium rounded-lg hover:bg-green-500 focus:outline-none focus:ring-4 focus:ring-green-300">
            Search
        </button>
    </form>
</div>

<h1 class="text-white text-center font-raleway font-bold text-2xl my-8">Genres</h1>
<div class="text-center mx-4 my-10 font-raleway font-semibold uppercase text-m grid grid-flow-col text-white gap-2">
<a href="/genre" class="mx-10 hover:underline">All</a>    
    @foreach ($genres as $genre)
        <a href="/genre/{{ $genre['id'] }}" class="mx-10 hover:underline">{{ $genre['name'] }}</a>
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
    <div class="max-w-sm bg-gray-800 border border-gray-700 rounded-lg shadow-lg overflow-hidden">
        <a href="/album/{{ $album['id'] }}">
            <img class="w-80 h-80 object-cover rounded-t-lg" src="{{ URL::asset('images/albums/' . $album['photo']) }}" alt="album photo"/>
        </a>    
        <div class="p-4">
            <a href="/album/{{ $album['id'] }}">
                <h5 class="mb-2 text-lg font-semibold text-white font-raleway truncate">{{ $album['name'] }}</h5>
            </a>
            <p class="mb-3 text-gray-400 font-raleway text-sm">{{ $album->user->name ?? 'No Artist Specified' }}</p>
            @if ($album->status == 0)
                <p class="mb-3 text-red-400 font-raleway text-sm">Unavailable</p>
            @elseif ($album->stock == 0)
                <p class="mb-3 text-red-400 font-raleway text-sm">Out of Stock</p>
            @else
                <p class="mb-3 text-green-400 font-raleway text-sm">Available</p>
            @endif
            @if ($album->song->count() == 0)
                <p class="mb-3 text-gray-400 font-raleway text-sm">No Songs</p>
            @else
                <p class="mb-3 text-gray-400 font-raleway text-sm">{{ $album->song->count() }} Songs</p>
            @endif
            <div class="flex space-x-2">
                <a href="/album/{{ $album['id'] }}" class="w-1/2 inline-flex font-raleway items-center px-4 py-2 text-sm font-medium text-center text-black bg-green-400 rounded-lg hover:bg-green-500 focus:outline-none focus:ring-4 focus:ring-green-300">
                    Details
                    <svg class="w-3.5 h-3.5 ml-auto" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                    </svg>
                </a>
                <form action="{{ route('buy', ['album' => $album['id']]) }}" method="GET" class="inline w-1/2">
                    @csrf
                    <button type="submit" 
                        class="w-full rounded-lg inline-flex font-raleway items-center px-4 py-2 text-sm font-medium text-center text-black 
                        {{ $album->stock == 0 ? 'bg-gray-400 cursor-not-allowed' : 'bg-blue-400 hover:bg-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-300' }}" 
                        {{ $album->stock == 0 ? 'disabled' : '' }}>
                        Buy
                        <svg class="w-4 h-4 ml-auto" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2 10h16M10 2l6 8-6 8"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>

@if ($count == 0)
    <h1 class="text-white text-center font-raleway italic text-m my-8">No Album Found</h1>
@endif

@endsection
