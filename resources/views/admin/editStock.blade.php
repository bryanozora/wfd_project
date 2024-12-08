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

<h1 class="text-green-400 text-center font-raleway font-bold text-3xl my-10">Edit Album Stock</h1>

<div class="max-w-3xl mx-auto bg-gray-800 border border-gray-700 rounded-lg shadow-lg p-6 font-raleway">

    <div class="flex items-center mb-8 space-x-6">
        <div class="w-1/3">
            <img src="{{ asset('images/albums/' . $album->photo) }}" alt="Album Photo" class="w-full h-72 object-cover rounded-md shadow-md">
        </div>

        <div class="w-2/3 text-white">
            <h2 class="text-xl mb-4">Album Details</h2>
            <div class="space-y-4">
                <div>
                    <strong>Artist Name:</strong>
                    <p class="text-gray-300">{{ $album->user->name }}</p>
                </div>
                <div>
                    <strong>Album Name:</strong>
                    <p class="text-gray-300">{{ $album->name }}</p>
                </div>
                <div>
                    <strong>Price:</strong>
                    <p class="text-gray-300">{{ $album->price ? number_format($album->price, 2) : 'Not Set' }}</p>
                </div>
                <div>
                    <strong>Current Stock:</strong>
                    <p class="text-gray-300">{{ $album->stock ?? 'Not Set' }}</p>
                </div>
            </div>
        </div>
    </div>

    <h2 class="text-xl text-white mt-8 mb-4">Update Stock</h2>

    <form action="{{ route('admin.updateStock', ['album' => $album->id]) }}" method="POST" class="bg-gray-700 p-6 rounded-lg shadow-md">
        @csrf
        @method('PUT')

        <div class="mb-6">
            <label for="stock" class="block text-white mb-2">Stock Quantity</label>
            <input type="number" id="stock" name="stock" value="{{ old('stock', $album->stock) }}" min="0" class="w-full p-3 bg-gray-800 font-raleway text-white border border-gray-600 rounded-md" required>
            @error('stock')
                <span class="text-red-400 text-sm mt-2 block">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-raleway font-bold py-2 px-6 rounded-md shadow-md">Update Stock</button>
        </div>
    </form>
</div>

@endsection
