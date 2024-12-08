@extends('base.base')

@section('content')
<div class="container mx-auto my-10 px-6 py-8 bg-gray-800 shadow-lg rounded-lg">
    <div class="grid grid-cols-1 gap-6 items-center">
        
        <div class="flex justify-center items-center">
            <img src="{{ URL::asset('images/albums/' . $song->album['photo']) }}" 
                 alt="{{ $song->album->name ?? 'Unknown Album' }}" 
                 class="h-72 w-72 object-cover">
        </div>

        <div class="text-white flex flex-col items-center">
            <h1 class="text-3xl font-rubik_mono_one text-green-400 mb-4 text-center">{{ $song->name }}</h1>
            <p class="text-lg mb-2 text-center">
                <span class="font-semibold">Artist:</span> 
                {{ $song->album->user->name ?? 'Unknown Artist' }}
            </p>
            <p class="text-lg mb-2 text-center">
                <span class="font-semibold">Album:</span> 
                <a href="/album/{{ $song->album->id }}" class="text-green-400 hover:underline">
                    {{ $song->album->name ?? 'Unknown Album' }}
                </a>
            </p>
            <p class="text-lg mb-2 text-center">
                <span class="font-semibold">Genre:</span> 
                {{ $song->genre->pluck('name')->join(', ') ?? 'Unknown Genre' }}
            </p>
            <p class="text-lg mb-2 text-center">
                <span class="font-semibold">Duration:</span> 
                {{ \Carbon\Carbon::parse($song->duration)->format('i:s') }}
            </p>
            <p class="text-lg mb-4 text-center">
                <span class="font-semibold">Lyrics:</span><br>
                {{ $song->lyrics ?? 'Lyrics not available' }}
            </p>
        </div>
    </div>
</div>
@endsection
