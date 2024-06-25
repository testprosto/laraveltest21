<style>
    .post-img {
        transition: transform 0.3s ease;
    }

    .post-img:hover {
        transform: scale(1.05);
    }
</style>

<x-app-layout>
    <x-slot name="header" style="display: flex; justify-content: center;">
        <ul class="flex" style="gap: 60px; justify-content: space-around;">
            <li>
                <a href="{{ route('posts.allposts') }}">
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        {{ __('messages.all_posts') }}
                    </h2>
                    <hr>
                </a>
            </li>
            <li>
                <a href="{{ route('posts.categorias.fashion') }}">
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        {{ __('messages.all_fashion') }}
                    </h2>
                </a>
            </li>
            <li>
                <a href="{{ route('posts.categorias.toys_and_hobbies') }}">
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        {{ __('messages.toys_and_hobbies') }}
                    </h2>
                </a>

            </li>
            <li>
                <a href="{{ route('posts.categorias.electronics') }}">
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        {{ __('messages.electric') }}
                    </h2>
                </a>
            </li>
        </ul>
    </x-slot>



    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div style="height: 100vh; display: flex;" class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100" style="display: flex; flex-direction: column;">
                    <form method="POST" action="{{ route('posts.buy') }}" enctype="multipart/form-data">
                        @csrf
                        <ul
                            style="max-width: 100%; overflow-x: hidden; list-style: none; padding: 0; margin: 0; display: flex; flex-wrap: wrap;">
                            @foreach($allPosts as $post)
                                <li id="post_{{ $post->id }}" class="mb-4" style="flex: 0 0 auto; margin-right: 30px;">
                                    <h3><a href="{{ route('posts.show', $post->id) }}">{{ __('messages.title') }}
                                            {{ $post->title }}</h3>
                                    <img src="{{ asset($post->img) }}" alt="{{ $post->title }} Image" class="post-img"
                                        style="width: 200px; height: 250px;">
                                    </a>
                                    <p>{{ __('messages.content') }} {{ $post->content }}</p>
                                    <p>{{ __('messages.price') }} {{ $post->price }}$</p>
                                    <p>{{ __('messages.quantity') }} {{ $post->quantity }}</p>
                                    <p>{{ __('messages.bought') }} {{ $post->bought }}</p>

                                    @if($post->quantity > 0)
                                        <button
                                            style="background-color: darkgreen; color: white; border-radius: 12%; width: 200px; height: 40px;"
                                            type="submit" name="buy" value="{{ $post->id }}">Buy</button>
                                    @else
                                        <button
                                            style="background-color: darkred; color: white; border-radius: 12%; width: 200px; height: 40px;"
                                            type="button" disabled>Out of Stock</button>
                                    @endif

                                    <br><br>
                                </li>
                            @endforeach
                        </ul>
                    </form>


                    <form method="POST" action="{{ route('posts.add') }}">
    @csrf 
    <input type="hidden" name="post_id" value="{{ $post->id }}">
    <button
        style="background-color: darkgreen; color: white; border-radius: 12%; width: 200px; height: 40px;"
        type="submit" name="add">Add To Cart</button>
</form>



                </div>
            </div>
        </div>
    </div>
</x-app-layout>