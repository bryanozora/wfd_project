@extends('base.baseArtist')

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

<h1 class="text-green-400 text-center font-raleway font-bold text-3xl my-10">
    Songs in Album: {{ $album->name }}
</h1>

<div class="text-center my-6">
    <a href="{{ route('artist.addSong', ['album' => $album->id]) }}" 
       class="inline-block px-8 py-3 bg-green-500 text-white font-medium rounded-lg shadow-md hover:bg-green-600 focus:outline-none focus:ring-4 focus:ring-green-300 transform transition-all duration-200 hover:scale-105">
        Add New Song
    </a>
</div>

@if ($album->song->count() != 0)
<div class="overflow-x-auto font-raleway text-white max-w-4xl mx-auto my-10">
    <table class="min-w-full bg-transparent border-collapse">
        <thead>
            <tr class="text-white">
                <th class="py-2 px-4 border-b text-sm text-left">#</th>
                <th class="py-2 px-4 border-b text-sm text-left">Name</th>
                <th class="py-2 px-4 border-b text-sm text-right">Duration</th>
                <th class="py-2 px-4 border-b text-sm text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($album->song as $index => $song)
                @php
                    $formattedDuration = \Carbon\Carbon::parse($song->duration)->format('i:s');
                @endphp
                <tr class="cursor-pointer transition-colors duration-300 hover:bg-gray-700 hover:bg-opacity-80">
                    <td class="py-2 px-4 text-sm text-left">
                        <a href="{{ route('artist.song', ['song' => $song->id]) }}" class="block w-full h-full">{{ $index + 1 }}</a>
                    </td>
                    <td class="py-2 px-4 text-sm">
                        <a href="{{ route('artist.song', ['song' => $song->id]) }}" class="block w-full h-full">{{ $song->name }}</a>
                    </td>
                    <td class="py-2 px-4 text-sm text-right">
                        <a href="{{ route('artist.song', ['song' => $song->id]) }}" class="block w-full h-full">{{ $formattedDuration }}</a>
                    </td>
                    <td class="py-2 px-4 text-sm text-center flex justify-center gap-2">
                        <a href="{{ route('artist.editSong', ['song' => $song->id]) }}" 
                           class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                           Edit
                        </a>

                        <form action=" {{ route('artist.deleteSong', ['song' => $song->id]) }} " method="POST" onsubmit="return confirm('Are you sure you want to delete this song?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@else
    <h1 class="text-white text-center font-raleway italic text-lg my-8">No Songs Found</h1>
@endif

@endsection
