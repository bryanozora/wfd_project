<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Store</title>
    @Vite('resources/css/app.css')
</head>
<body class="bg-gray-900 font-raleway flex flex-col min-h-screen">
    <div class="flex-grow">
        @include('includes.navbar')
        <div>
            @yield('content')
        </div>
    </div>
    @include('includes.footer')
</body>
</html>
