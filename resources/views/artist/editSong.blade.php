@extends('base.baseArtist')

@section('content')

<h1 class="text-green-400 text-center font-raleway font-bold text-3xl my-10">Edit Song: {{ $song->name }}</h1>

<div class="max-w-2xl mx-auto my-10 bg-gray-800 border border-gray-700 rounded-lg shadow-lg p-8">
    <form action="{{ route('artist.updateSong', ['song' => $song->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-6">
            <label for="name" class="block text-white text-sm font-raleway font-medium mb-2">Song Name</label>
            <input type="text" id="name" name="name" 
                class="w-full px-4 py-2 text-gray-800 rounded-lg focus:ring focus:ring-green-400 focus:outline-none" 
                placeholder="Enter song name" 
                value="{{ old('name', $song->name) }}" 
                required>
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="duration" class="block text-white text-sm font-raleway font-medium mb-2">Duration (HH:MM:SS)</label>
            <input type="text" id="duration" name="duration" 
                class="w-full px-4 py-2 text-gray-800 rounded-lg focus:ring focus:ring-green-400 focus:outline-none" 
                placeholder="Enter song duration (e.g., 01:30:45)" 
                value="{{ old('duration', $song->duration) }}" 
                required>
            @error('duration')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="lyrics" class="block text-white text-sm font-raleway font-medium mb-2">Lyrics</label>
            <textarea id="lyrics" name="lyrics" rows="5" 
                class="w-full px-4 py-2 text-gray-800 rounded-lg focus:ring focus:ring-green-400 focus:outline-none" 
                placeholder="Enter song lyrics" 
                required>{{ old('lyrics', $song->lyrics) }}</textarea>
            @error('lyrics')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label class="block text-white text-sm font-raleway font-medium mb-2">Genres</label>
            <div class="flex flex-wrap gap-4">
                @foreach ($genres as $genre)
                    <div>
                        <input type="checkbox" id="genre_{{ $genre->id }}" name="genres[]" value="{{ $genre->id }}" 
                            class="rounded text-green-500 focus:ring focus:ring-green-400"
                            {{ in_array($genre->id, old('genres', $song->genre->pluck('id')->toArray())) ? 'checked' : '' }}>
                        <label for="genre_{{ $genre->id }}" class="text-white text-sm">{{ $genre->name }}</label>
                    </div>
                @endforeach
            </div>
            @error('genres')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="text-center">
            <button type="submit" 
                class="px-6 py-3 bg-green-400 text-black font-raleway font-medium rounded-lg hover:bg-green-500 focus:outline-none focus:ring-4 focus:ring-green-300">
                Update Song
            </button>
        </div>
    </form>
</div>

@endsection
