@extends('base.base')

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

<div class="my-10 flex justify-center">
    <img src="{{ URL::asset('images/albums/' . $album['photo']) }}" alt="Item Image" class="h-72 w-72 object-cover">
</div>

<div class="py-10 px-6 md:px-20">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-rubik_mono_one text-center text-white mb-4"> {{ $album['name'] }} </h1>
        <h2 class="text-2xl font-raleway text-center text-white mb-4">{{ $album->user->name }}</h2>
        <p class="text-lg font-raleway text-white mb-4">
            @if ($album['price'] !== null)
                Price: {{ number_format($album['price'], 2) }}
            @endif
        </p>

        <p class="text-lg font-raleway text-white mb-4">
            Stock: {{ $album['stock'] }}
        </p>
        <p class="text-lg font-raleway text-white mb-4">
            Status: {{ $album['status'] == 1 ? 'Available' : 'Unavailable' }}
        </p>
        <p class="text-lg font-raleway text-white mb-4">
            {{ $album['description'] }}
        </p>
        <p class="text-lg font-raleway text-white mb-4">
            {{ $album->genre->pluck('name')->join(', ') }}
        </p>

        @php
        use Carbon\Carbon;
        $songs = $album->song;
        $comments = $album->comment()->orderBy('updated_at', 'desc')->get();
        @endphp
        
        @if ($songs->count() != 0)
        <hr class="mt-6">
        
        <p class="text-3xl text-center font-bold mt-10 font-raleway text-white mb-4">
            Songs
        </p>

        <div class="overflow-x-auto font-raleway text-white">
            <table class="min-w-full bg-transparent border-collapse">
                <thead>
                    <tr class="text-white">
                        <th class="py-2 px-4 border-b text-sm text-left">#</th>
                        <th class="py-2 px-4 border-b text-sm text-left">Name</th>
                        <th class="py-2 px-4 border-b text-sm text-right">Duration</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($songs as $index => $song)
                        @php
                            $duration = $song['duration'];
                            $formattedDuration = \Carbon\Carbon::parse($duration)->format('i:s');
                        @endphp
                        <tr class="cursor-pointer transition-colors duration-300 hover:bg-gray-700 hover:bg-opacity-80">
                            <td class="py-2 px-4 text-sm text-left">
                                <a href="{{ route('song', ['song' => $song->id]) }}" class="block w-full h-full">{{ $index + 1 }}</a>
                            </td>
                            <td class="py-2 px-4 text-sm">
                                <a href="{{ route('song', ['song' => $song->id]) }}" class="block w-full h-full">{{ $song['name'] }}</a>
                            </td>
                            <td class="py-2 px-4 text-sm text-right">
                                <a href="{{ route('song', ['song' => $song->id]) }}" class="block w-full h-full">{{ $formattedDuration }}</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
            <h1 class="text-white text-center font-raleway italic text-m my-8">No Songs Found</h1>
        @endif


        
        @if ($comments->count() != 0)
            <hr class="mt-6">
            
            <p class="text-3xl text-center font-bold mt-10 font-raleway text-white mb-4">
                Comments
            </p>

            @if(Auth::check())
                <form action="{{ route('comment', ['album' => $album['id']]) }}" method="POST" class="bg-gray-800 p-4 mb-6 rounded-md shadow-md">
                    @csrf
                    <div class="mb-4">
                        <label for="comment" class="text-white text-lg font-semibold">Leave a Comment:</label>
                        <textarea name="comment" id="comment" rows="4" class="w-full px-4 py-2 mt-2 rounded-md bg-gray-700 text-white focus:outline-none" placeholder="Your comment here..."></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="px-6 py-2 bg-green-400 text-black font-semibold rounded-md hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">Submit Comment</button>
                    </div>
                </form>
            @endif

            @foreach ($comments as $comment)
            <div class="bg-gray-800 font-raleway p-4 mb-4 rounded-md shadow-md">
                <div class="flex items-center mb-2">
                    <p class="text-lg font-semibold text-white">{{ $comment->user->name }}</p>
                </div>
                <hr>
                <p class="text-white text-sm my-2">{{ $comment->comment }}</p>
            </div>
            @endforeach
        
        @else
        
        @if(Auth::check())
                <form action="{{ route('comment', ['album' => $album['id']]) }}" method="POST" class="bg-gray-800 p-4 mb-6 rounded-md shadow-md">
                    @csrf
                    <div class="mb-4">
                        <label for="comment" class="text-white text-lg font-semibold">Leave a Comment:</label>
                        <textarea name="comment" id="comment" rows="4" class="w-full px-4 py-2 mt-2 rounded-md bg-gray-700 text-white focus:outline-none" placeholder="Your comment here..."></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="px-6 py-2 bg-green-400 text-black font-semibold rounded-md hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">Submit Comment</button>
                    </div>
                </form>
            @endif

        <h1 class="text-white text-center font-raleway italic text-m my-8">No Comments Found</h1>
        
        @endif
        
    </div>
</div>

@endsection
