<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/usershow.css') }}" rel="stylesheet">

    <title>User</title>
    </head>

<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('messages.user') }}
            </h2>
        </x-slot>

        <br>
        <div class="user">
            <img style="width: 250px; height: 250px;" src="/{{ $user->avatar }}" alt="Avatar">
            <h1>User Information</h1>
            <p>Name: {{ $user->name }}</p>
            <p>Email: {{ $user->email }}</p>
            <h2>Posts for User ID: {{ $user->id }}</h2>
        </div>

        <br>

        <div class="posts">

            @if($user->posts)
                @if($user->posts->count() > 0)
                    <ul>
                        @foreach($user->posts as $post)
                            <div class="post">
                                <a href="{{ route('posts.show', $post->id) }}">
                                    <h2>{{ $post->title }}</h2>
                                    <br>
                                    <img style="width: 500px; height: 500px;" src="{{ asset($post->img)}}" alt="{{ $post->title }}">
                                </a>
                            </div>
                        @endforeach


                    </ul>
                @else
                    <p>No posts found for this user.</p>
                @endif
            @else
                <p>No posts found for this user.</p>
            @endif

        </div>
        <br>
        <br>
    </x-app-layout>

</body>

</html>