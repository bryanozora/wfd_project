@extends('base.baseAdmin')

@section('content')

<h1 class="text-green-400 text-center font-raleway font-bold text-3xl my-10">Approve Album</h1>

<div class="max-w-4xl mx-auto my-10 bg-gray-800 border border-gray-700 rounded-lg shadow-lg p-8">
    <h2 class="text-white text-xl font-raleway font-medium mb-4">Approve Album: {{ $album->name }}</h2>
    <form action="{{ route('admin.approveAlbum', ['album' => $album]) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="price" class="block text-sm font-raleway font-medium text-gray-300">Price</label>
            <input type="number" name="price" id="price" step="0.01" 
                   class="mt-1 p-2 px-3 block w-full rounded-md bg-gray-700 text-white border-gray-600 focus:ring-green-500 focus:border-green-500"
                   placeholder="Enter album price" required>
            @error('price')
            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="stock" class="block text-sm font-raleway font-medium text-gray-300">Stock</label>
            <input type="number" name="stock" id="stock" 
                   class="mt-1 p-2 px-3 block w-full rounded-md bg-gray-700 text-white border-gray-600 focus:ring-green-500 focus:border-green-500"
                   placeholder="Enter album stock" required>
            @error('stock')
            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="text-right">
            <button type="submit" 
                    class="inline-block px-6 py-2 bg-green-500 text-black font-raleway font-semibold text-sm rounded-md hover:bg-green-600">
                Approve Album
            </button>
        </div>
    </form>
</div>

@endsection
