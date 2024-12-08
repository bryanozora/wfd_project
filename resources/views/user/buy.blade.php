@extends('base.base')

@section('content')

<h1 class="text-3xl font-rubik_mono_one text-green-400 my-8 text-center">Buy Album</h1>

<div class="container mx-auto my-10 max-w-4xl px-6 py-8 bg-gray-700 shadow-lg rounded-lg">
    <div class="flex justify-between gap-10">

        <div class="w-full sm:w-1/3 p-6 bg-gray-800 rounded-lg shadow-lg">
            <h2 class="text-3xl font-bold text-white mb-4">{{ $album->name }}</h2>
            <img src="{{ URL::asset('images/albums/' . $album->photo) }}" alt="Album Cover" class="w-full h-auto object-cover rounded-lg mb-6">
            <p class="text-lg font-semibold text-gray-300">Artist: {{ $album->user->name ?? 'No Artist Specified' }}</p>
            <p class="text-lg font-semibold text-gray-300">Genre:
                {{ $album->genre->pluck('name')->join(', ') }}
            </p>
            <p class="text-lg font-semibold text-gray-300">Release Date: {{ $album->release_date }}</p>
            <p class="text-gray-400 mt-4">{{ $album->description }}</p>
            <p class="text-xl font-bold mt-6 text-green-400">Stock: {{ $album->stock }}</p>
            <p class="text-xl font-bold mt-6 text-green-400">Price: {{ number_format($album->price, 2) }}</p>
        </div>

        <div class="w-full sm:w-2/3 p-6 bg-gray-800 rounded-lg shadow-lg flex flex-col justify-between">

            <form action="{{ route('buy.confirm', ['album' => $album['id']]) }}" method="POST" class="space-y-4 flex-grow">
                @csrf
                <div>
                    <label for="Jumlah" class="ml-3 block text-sm font-semibold text-white">Quantity</label>
                    <input type="number" name="jumlah" id="jumlah" 
                        class="px-3 py-3 mt-2 block w-full rounded-md border-gray-300 focus:ring-green-500 focus:border-green-500 shadow-sm sm:text-sm" 
                        value="1" min="1" max="{{ $album->stock }}" required>
                </div>

                <div class="mt-4">
                    <p id="subtotal" class="text-lg font-semibold text-white">Subtotal: {{ number_format($album->price, 2) }}</p>
                </div>

                <div class="mt-6">
                    <button type="submit" class="w-full flex justify-center rounded-md bg-green-400 px-4 py-2 text-sm font-semibold text-black shadow-sm hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Complete Purchase
                        <svg class="w-4 h-4 ml-auto" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2 10h16M10 2l6 8-6 8"/>
                        </svg>
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>

<script>
    const price = parseFloat("{{ $album->price }}");
    const stock = parseInt("{{ $album->stock }}");
    const quantityInput = document.getElementById('jumlah');
    const subtotalElement = document.getElementById('subtotal');

    quantityInput.addEventListener('input', function () {
        let quantity = parseInt(quantityInput.value);
        
        if (quantity > stock) {
            quantity = stock;
            quantityInput.value = stock;
        }

        const subtotal = price * quantity;
        subtotalElement.textContent = `Subtotal: $${subtotal.toFixed(2)}`;
    });

    quantityInput.setAttribute('max', stock);
</script>

@endsection
