<style>
    .post-img {
        transition: transform 0.3s ease;
    }

    .post-img:hover {
        transform: scale(1.05);
    }
</style>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('messages.my_posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div style="height: 100vh; display: flex;" class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100" style="display: flex; flex-direction: column;">
                    <ul
                        style="max-width: 100%; overflow-x: hidden; list-style: none; padding: 0; margin: 0; display: flex; flex-wrap: wrap;">
                        @foreach($userPosts as $post)
                            <li id="post_{{ $post->id }}" class="mb-4" style="flex: 0 0 auto; margin-right: 30px;">
                                <h3>{{ __('messages.title') }} {{ $post->title }}</h3>
                                <img src="{{ asset($post->img) }}" alt="{{ $post->title }} Image" class="post-img"
                                    style="width: 200px; height: 250px;">
                                <br>
                                <p>{{ __('messages.content') }} {{ $post->content}}</p>
                                <p>{{ __('messages.price') }} {{ $post->price}}$</p>
                                <p>{{ __('messages.quantity') }} {{ $post->quantity }}</p>
                                <p>{{ __('messages.bought') }} {{ $post->bought }}</p>
                                <br>
                                <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="edit-btn"
                                    style="background-color: #007bff; border-color: #007bff; color: white; border-radius: 12%; width: 200px; height: 40px; text-align: center; line-height: 40px; display: inline-block; text-decoration: none;">{{ __('messages.edit') }}</a>
                                <br>
                                <button class="delete-btn" data-post-id="{{ $post->id }}"
                                    style="background-color: darkred; border-color: darkred; color: white; border-radius: 12%; width: 200px; height: 40px;">{{ __('messages.delete') }}</button>
                            </li>
                        @endforeach

                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('.delete-btn').on('click', function () {
            var postId = $(this).data('post-id');
            var postCount = $('.delete-btn').length;
            if (postCount === 1) {
                alert('You Cant Delete Last Image.');
                return false;
            }

            if (confirm('Are you sure you want to delete this post?')) {
                $.ajax({
                    url: 'posts/' + postId,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        $('#post_' + postId).remove();
                    },
                    error: function (xhr) {
                        console.error(xhr.responseText);
                        alert('Failed to delete post. Please try again.');
                    }
                });
            }
        });
    });
</script>