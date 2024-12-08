<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-900">

<div class="mt-10">
    <div class="container mx-auto my-10 max-w-lg px-6 py-8 bg-gray-700 shadow-lg rounded-lg">
    <h1 class="text-3xl font-rubik_mono_one text-green-400 mb-6 text-center">Music Store</h1>
    <form action="{{ route('signUp.post') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="space-y-4">
            <div>
                <label for="name" class="ml-3 block text-sm font-semibold text-white">Name</label>
                <input type="text" name="name" id="name" 
                    class="@error('name') is-invalid @enderror px-3 py-3 mt-2 block w-full rounded-md border-gray-300 focus:ring-green-500 focus:border-green-500 shadow-sm sm:text-sm" 
                    placeholder="Enter your name" required>
            </div>

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

            <div>
                <label for="telephone" class="ml-3 block text-sm font-semibold text-white">Telephone</label>
                <input type="text" name="telephone" id="telephone" 
                    class="@error('telephone') is-invalid @enderror px-3 py-3 mt-2 block w-full rounded-md border-gray-300 focus:ring-green-500 focus:border-green-500 shadow-sm sm:text-sm" 
                    placeholder="Enter your telephone" required>
            </div>

            <div>
                <label for="birthdate" class="ml-3 block text-sm font-semibold text-white">Birth Date</label>
                <input type="date" name="birthdate" id="birthdate" 
                    class="@error('birthdate') is-invalid @enderror px-3 py-3 mt-2 block w-full rounded-md border-gray-300 focus:ring-green-500 focus:border-green-500 shadow-sm sm:text-sm" 
                    required>
            </div>

            <div>
                <label for="roleId" class="ml-3 block text-sm font-semibold text-white">Sign Up As?</label>
                <select name="roleId" id="roleId" 
                    class="@error('roleId') is-invalid @enderror px-3 py-3 mt-2 block w-full rounded-md border-gray-300 focus:ring-green-500 focus:border-green-500 shadow-sm sm:text-sm" 
                    required>
                    <option value="" disabled selected>Select your role</option>
                    <option value="1">User</option>
                    <option value="3">Artist</option>
                </select>
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
                Sign Up
            </button>
        </div>

        <div class="mt-6 text-center">
            <p class="text-sm font-raleway text-gray-300">
                Have an account already? 
                <a href="/login" class="text-green-400 font-raleway font-semibold hover:underline">Log In</a>
        </div>
    </form>
</div>
</div>

</body>
</html>
