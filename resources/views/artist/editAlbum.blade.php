@extends('base.baseArtist')

@section('content')

<h1 class="text-green-400 text-center font-raleway font-bold text-3xl my-10">Edit Album</h1>

<div class="max-w-2xl mx-auto my-10 bg-gray-800 border border-gray-700 rounded-lg shadow-lg p-8">
    <form action="{{ route('artist.updateAlbum', ['album' => $album->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-6">
            <label for="name" class="block text-white text-sm font-raleway font-medium mb-2">Album Name</label>
            <input type="text" id="name" name="name" 
                class="w-full px-4 py-2 text-gray-800 rounded-lg focus:ring focus:ring-green-400 focus:outline-none" 
                placeholder="Enter album name" 
                value="{{ old('name', $album->name) }}" 
                required>
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="photo" class="block text-white text-sm font-raleway font-medium mb-2">Album Photo</label>
            <input type="file" id="photo" name="photo" 
                class="w-full text-gray-800 bg-white rounded-lg focus:ring focus:ring-green-400 focus:outline-none" 
                accept="image/*">
            <p class="text-gray-400 text-sm mt-2">Current Photo: {{ $album->photo }}</p>
            @error('photo')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="description" class="block text-white text-sm font-raleway font-medium mb-2">Description</label>
            <textarea id="description" name="description" rows="5" 
                class="w-full px-4 py-2 text-gray-800 rounded-lg focus:ring focus:ring-green-400 focus:outline-none" 
                placeholder="Enter album description" 
                required>{{ old('description', $album->description) }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label class="block text-white text-sm font-raleway font-medium mb-2">Genres</label>
            <div class="flex flex-wrap gap-4">
                @foreach($genres as $genre)
                    <div>
                        <input type="checkbox" id="genre_{{ $genre->id }}" name="genres[]" value="{{ $genre->id }}" 
                            class="rounded text-green-500 focus:ring focus:ring-green-400" 
                            {{ in_array($genre->id, old('genres', $album->genre->pluck('id')->toArray())) ? 'checked' : '' }}>
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
                Update Album
            </button>
        </div>
    </form>
</div>


@endsection