<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-900">

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

<div class="mt-40">
    <div class="container mx-auto my-10 max-w-lg px-6 py-8 bg-gray-700 shadow-lg rounded-lg">
        <a href="{{ route('home') }}">
            <h1 class="text-3xl font-rubik_mono_one text-green-400 mb-6 text-center">Music Store</h1>
        </a>
        <form action="{{ route('login.post') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="space-y-4">
                <div>
                    <label for="email" class="ml-3 block text-sm font-semibold text-white">Email</label>
                    <input type="text" name="email" id="email" value="{{ old('email') }}" 
                        class="@error('email') is-invalid @enderror px-3 py-3 mt-2 block w-full rounded-md border-gray-300 focus:ring-green-500 focus:border-green-500 shadow-sm sm:text-sm" 
                        placeholder="Enter your email" required>
                    @error('email')
                        <div class="border border-red-500 text-red-500 text-xs italic">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label for="password" class="ml-3 block text-sm font-semibold text-white">Password</label>
                    <input type="password" name="password" id="password" 
                        class="@error('password') is-invalid @enderror px-3 py-3 mt-2 block w-full rounded-md border-gray-300 focus:ring-green-500 focus:border-green-500 shadow-sm sm:text-sm" 
                        placeholder="Enter your password" required>
                </div>
            </div>
            @if(session('error'))
                <p class="font-xs mt-4 text-red-500 italic"> {{ session('error') }} </p>
            @else
                <br class="mt-4">
            @endif
            <div class="mt-6">
                <button type="submit" 
                    class="w-full flex justify-center rounded-md bg-green-400 px-4 py-2 text-sm font-semibold text-black shadow-sm hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    Login
                </button>
            </div>
            <div class="mt-6 text-center">
                <p class="text-sm font-raleway text-gray-300">
                    Don't have an account? 
                    <a href="/signUp" class="text-green-400 font-raleway font-semibold hover:underline">Sign Up</a>
                </p>
            </div>
        </form>
    </div>
</div>

</body>
</html>
