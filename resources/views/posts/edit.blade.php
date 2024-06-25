<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/editpost.css') }}">
    <title>Document</title>
</head>

<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('messages.edit_post') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                    <a href="{{ route('posts.index') }}" class="mb-4 text-blue-500 block" style="color: yellow;"><--- {{ __('messages.go_back') }}</a>
                            <form action="{{ route('posts.update', $post->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="image-container">
                                    <img src="{{ asset($post->img) }}" alt="{{ $post->title }} Image" class="post-img">
                                </div>
                                <div class="mb-4">
                                    <label for="title"
                                        class="block text-gray-700 dark:text-gray-300 font-bold mb-2">{{ __('messages.title') }}</label>
                                    <input type="text" id="title" name="title" value="{{ $post->title }}"
                                        class="border rounded-md p-2 w-full dark:bg-gray-700 dark:text-white">
                                </div>
                                <div class="mb-4">
                                    <label for="content"
                                        class="block text-gray-700 dark:text-gray-300 font-bold mb-2">{{ __('messages.content') }}</label>
                                    <textarea id="content" name="content"
                                        class="border rounded-md p-2 w-full dark:bg-gray-700 dark:text-white">{{ $post->content }}</textarea>
                                </div>
                                <div class="mb-4">
                                    <label for="price"
                                        class="block text-gray-700 dark:text-gray-300 font-bold mb-2">{{ __('messages.price') }}</label>
                                    <input type="number" id="price" name="price" value="{{ $post->price }}"
                                        class="border rounded-md p-2 w-full dark:bg-gray-700 dark:text-white">
                                </div>
                                <div class="mb-4">
                                    <label for="quantity"
                                        class="block text-gray-700 dark:text-gray-300 font-bold mb-2">{{ __('messages.quantity') }}:</label>
                                    <input type="number" id="quantity" name="quantity" value="{{ $post->quantity }}"
                                        class="border rounded-md p-2 w-full dark:bg-gray-700 dark:text-white">
                                </div>
                                <div class="mb-4">
                                    <label for="bought"
                                        class="block text-gray-700 dark:text-gray-300 font-bold mb-2">{{ __('messages.bought') }}</label>
                                    <input type="text" id="bought" name="bought" value="{{ $post->bought }}" readonly
                                        class="border rounded-md p-2 w-full dark:bg-gray-700 dark:text-white">
                                </div>
                                <div class="button-container">
                                    <button type="submit"
                                        style="background-color: darkgreen; color: white; border-radius: 12%; width: 200px; height: 40px;"
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        {{ __('messages.update') }}
                                    </button>
                                </div>
                            </form>
                </div>
            </div>
        </div>
    </x-app-layout>
</body>

</html>