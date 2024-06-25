<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="{{ asset ('css/showpost.css') }}">
    <title>Document</title>
</head>

<body>

    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('messages.showpost') }}

            </h2>
        </x-slot>

        <div class="post">
        <div class="container">
            <div class="post-detail">
                <h2>{{ __('messages.title') }} {{ $post->title }}</h2>
                <img src="{{ asset($post->img) }}" alt="{{ $post->title }} Image" class="post-img"
                    style="width: 200px; height: 250px;">

                <p>{{ __('messages.content') }} {{ $post->content }}</p>
                <p>{{ __('messages.price') }} {{ $post->price }}$</p>
                <p>{{ __('messages.quantity') }} {{ $post->quantity }}</p>
                <p>{{ __('messages.bought') }} {{ $post->bought }}</p>

                @if($post->quantity > 0)
                    <form method="POST" action="{{ route('posts.buy') }}" enctype="multipart/form-data">
                        @csrf
                        <button
                            style="background-color: darkgreen; color: white; border-radius: 12%; width: 200px; height: 40px;"
                            type="submit" name="buy" value="{{ $post->id }}">Buy</button>
                    </form>
                @else
                    <button style="background-color: darkred; color: white; border-radius: 12%; width: 200px; height: 40px;"
                        type="button" disabled>Out of Stock</button>
                @endif
            </div>
   
            <div class="related-posts mt-4">
                <h3>Related Posts</h3>
                <ul
                    style="max-width: 100%; overflow-x: hidden; list-style: none; padding: 0; margin: 0; display: flex; flex-wrap: wrap;">
                    @foreach($relatedPosts as $relatedPost)
                        <li id="post_{{ $relatedPost->id }}" class="mb-4" style="flex: 0 0 auto; margin-right: 30px;">
                        <a href="{{ route('posts.show', $relatedPost->id) }}">
                            <h4>{{ __('messages.title') }} {{ $relatedPost->title }}</h4>
                            <img src="{{ asset($relatedPost->img) }}" alt="{{ $relatedPost->title }} Image" class="post-img"
                                style="width: 200px; height: 250px;">

                            <p>{{ __('messages.price') }} {{ $relatedPost->price }}$</p>
                            <p>{{ __('messages.quantity') }} {{ $relatedPost->quantity }}</p>
                            <p>{{ __('messages.bought') }} {{ $relatedPost->bought }}</p>
</a>
                            @if($relatedPost->quantity > 0)
                                <form method="POST" action="{{ route('posts.buy') }}" enctype="multipart/form-data">
                                    @csrf
                                    <button
                                        style="background-color: darkgreen; color: white; border-radius: 12%; width: 200px; height: 40px;"
                                        type="submit" name="buy" value="{{ $relatedPost->id }}">Buy</button>
                                </form>
                            @else
                                <button
                                    style="background-color: darkred; color: white; border-radius: 12%; width: 200px; height: 40px;"
                                    type="button" disabled>Out of Stock</button>
                            @endif

                            <br><br>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        </div>


    </x-app-layout>
</body>

</html>