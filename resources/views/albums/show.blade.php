@extends('layout')

@section('content')
<div class="grid grid-cols-2 gap-0 px-8 py-16">
    <div class="flex justify-center">
        <img class="w-80 h-80 rounded-xl shadow-md" src="{{ $album->album_cover ? asset('storage/' . $album->album_cover) : asset('/images/noimage.png') }}">
    </div>
    <div class="flex flex-col justify-center">
        <div>
            <p class="text-5xl font-bold mb-4">{{ $album->title }}</p>
            <p class="text-xl mb-2">{{ $album->artist }} | {{ $album->release_year }}</p>
            <p class="w-auto text-xl text-slate-500 mb-4">{{ $album->description }}</p>
            @if (!$album->hasBeenPurchased())
                <p class="text-xl text-orange-600 mb-4">{{ $album->price }}$</p>
            @endif
            <!-- Purchase button and Album rating field -->
            <div class="flex items-center"> <!-- Flex container for purchase button and rating field -->
                @auth
                    @if (!$album->hasBeenPurchased())
                        <div class="mt-4 mr-4">
                            <form action="{{ route('purchase') }}" method="post">
                                @csrf
                                <input type="hidden" name="album_id" value="{{ $album->id }}">
                                <input type="hidden" name="purchase_price" value="{{ $album->price }}">
                                <button type="submit" class="px-6 py-4 bg-red-500 text-xl text-white rounded-lg shadow-md hover:bg-red-600 transition duration-200">Purchase</button>
                            </form>
                        </div>
                    @endif
                @else
                    <div class="mt-4 mr-4">
                        <p class="text-lg">Please <a href="/login" class="text-blue-500 hover:underline">login</a> to purchase this album.</p>
                    </div>
                @endauth
                @auth
                    @if (!$assignedMood)
                        <form method="post" action="/albums/rate" class="flex items-center mt-4">
                            @csrf
                            <input type="hidden" name="album_id" value="{{ $album->id }}">
                            <label for="mood_id" class="mr-2 text-lg font-semibold">Rate this album:</label>
                            <select name="mood_id" id="mood_id" class="border-2 border-gray-300 rounded-lg p-2 w-48 mr-4">
                                @foreach ($moods as $mood)
                                    <option value="{{ $mood->id }}">{{ $mood->name }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="px-6 py-2 bg-amber-600 text-white rounded-lg shadow hover:bg-amber-700 transition duration-200">Rate</button>
                        </form>
                    @else
                        <div class="flex justify-center mt-2">
                            <p class="text-lg font-semibold text-green-600 ml-8 mt-2">You rated this album as {{ $album->moods()->wherePivot('user_id', Auth::id())->first()->name }}.</p>
                        </div>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</div>

<hr class="border-t-2 border-gray-300 mt-8">

<div class="text-center mt-8">
    <h1 class="text-4xl font-bold">Comments</h1>
</div>

<hr class="border-t-2 border-gray-300 mt-8">

@auth
    <div class="flex justify-center mt-8">
        <form method="post" action="/albums/comment" class="flex items-center w-1/2">
            @csrf
            <input type="hidden" name="album_id" value="{{ $album->id }}">
            <textarea class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="text" placeholder="Write your comment here"></textarea>
            <button type="submit" class="p-4 bg-slate-300 rounded-xl w-52 ml-8">Post Comment</button>
        </form>
    </div>
@endauth

<div class="flex flex-col items-center mt-8">
    @foreach ($comments->reverse() as $comment)
        <div class="w-2/3 bg-gray-100 rounded-xl p-6 shadow-md mb-4">
            <p class="text-sm text-gray-500">{{ $comment->created_at->format('Y-m-d') }} - {{ $comment->user->name }}</p>
            <hr class="border-t-2 border-gray-300 mt-2 mb-4">
            <p class="text-lg">{{ $comment->text }}</p>
        </div>
    @endforeach
</div>

@endsection
