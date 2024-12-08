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

<h1 class="text-green-400 text-center font-raleway font-bold text-3xl my-10">Album List</h1>

<div class="max-w-6xl mx-auto my-10 bg-gray-800 border border-gray-700 rounded-lg shadow-lg p-8">
    <h2 class="text-red-400 text-xl font-medium mb-4">Unavailable Albums</h2>
    
    @if ($unavailableAlbums->isEmpty())
    <p class="text-green-400 mb-10">No unavailable albums found.</p>
    @else
    <table class="min-w-full table-auto border-collapse mb-10">
        <thead>
            <tr class="bg-gray-900 text-white">
                <th class="py-3 px-6 text-center">No</th>
                <th class="py-3 px-6 text-center">Photo</th>
                <th class="py-3 px-6 text-center">Artist Name</th>
                <th class="py-3 px-6 text-center">Album Name</th>
                <th class="py-3 px-6 text-center">Price</th>
                <th class="py-3 px-6 text-center">Stock</th>
                <th class="py-3 px-6 text-center">Actions</th>
            </tr>
        </thead>
        <tbody class="text-white">
            @foreach($unavailableAlbums as $index => $album)
                <tr class="bg-gray-700 border-b hover:bg-gray-600">
                    <td class="py-3 px-6 text-center">{{ $index + 1 }}</td>
                    <td class="py-3 px-6 text-center">
                        <img src="{{ asset('images/albums/' . $album->photo) }}" alt="Album Photo" 
                             class="w-16 h-16 object-cover rounded-md mx-auto">
                    </td>
                    <td class="py-3 px-6 text-center">{{ $album->user->name }}</td>
                    <td class="py-3 px-6 text-center">{{ $album->name }}</td>
                    <td class="py-3 px-6 text-center">{{ $album->price ?? '-' }}</td>
                    <td class="py-3 px-6 text-center">{{ $album->stock ?? '-' }}</td>
                    <td class="py-3 px-6 text-center">
                        <div class="flex justify-center items-center space-x-4">
                            <a href="{{ route('admin.approve', ['album' => $album->id]) }}" 
                            class="text-green-400 hover:underline">Approve</a>
                            <form action="{{ route('admin.deleteAlbum', ['album' => $album]) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-400 hover:underline"
                                        onclick="return confirm('Are you sure you want to delete this album?');">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    <h2 class="text-green-400 text-xl font-medium mb-4">Available Albums</h2>
    
    @if ($availableAlbums->isEmpty())
    <p class="text-red-500">No available albums found.</p>
    @else
    <table class="min-w-full table-auto border-collapse">
        <thead>
            <tr class="bg-gray-900 text-white">
                <th class="py-3 px-6 text-center">No</th>
                <th class="py-3 px-6 text-center">Photo</th>
                <th class="py-3 px-6 text-center">Artist Name</th>
                <th class="py-3 px-6 text-center">Album Name</th>
                <th class="py-3 px-6 text-center">Price</th>
                <th class="py-3 px-6 text-center">Stock</th>
                <th class="py-3 px-6 text-center">Actions</th>
            </tr>
        </thead>
        <tbody class="text-white">
            @foreach($availableAlbums as $index => $album)
                <tr class="bg-gray-700 border-b hover:bg-gray-600">
                    <td class="py-3 px-6 text-center">{{ $index + 1 }}</td>
                    <td class="py-3 px-6 text-center">
                        <img src="{{ asset('images/albums/' . $album->photo) }}" alt="Album Photo" 
                             class="w-16 h-16 object-cover rounded-md mx-auto">
                    </td>
                    <td class="py-3 px-6 text-center">{{ $album->user->name }}</td>
                    <td class="py-3 px-6 text-center">{{ $album->name }}</td>
                    <td class="py-3 px-6 text-center">{{ $album->price ? number_format($album->price, 2) : '-' }}</td>
                    <td class="py-3 px-6 text-center">{{ $album->stock ?? '-' }}</td>
                    <td class="py-3 px-6 text-center">
                        <a href="{{ route('admin.editStock', ['album' => $album->id]) }}" 
                           class="text-blue-400 hover:underline">Edit Stock</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>

@endsection
