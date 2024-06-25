<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('messages.create_post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-black dark:text-gray-100">

                    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data"
                        class="flex flex-col space-y-4">
                        @csrf
                        <div>
                            <label for="title" class="font-bold">{{ __('messages.title') }}</label>
                            <input type="text" maxlength="23" id="title" name="title" required
                                value="{{ old('title') }}"
                                class="border border-gray-300 rounded-md p-2 w-full h-10 text-black">
                            @error('title')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="content" class="font-bold">{{ __('messages.content') }}</label>
                            <textarea id="content" maxlength="14" required name="content"
                                class="border border-gray-300 rounded-md p-2 w-full h-20 text-black">{{ old('content') }}</textarea>
                            @error('content')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="img" class="font-bold">{{ __('messages.image') }}</label>
                            <input type="file" id="img" required name="img"
                                class="border border-gray-300 rounded-md p-2 w-full h-12 text-black"
                                onchange="previewImage()">
                            <img id="imgPreview" src="#" alt="Selected Image"
                                style="display: none; max-width: 250px; max-height: 250px; position: relative; left: 500px; top: 15px;">
                            @error('img')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="price" class="font-bold">{{ __('messages.price') }}</label>
                            <input type="number" id="price" required name="price" value="{{ old('price') }}"
                                class="border border-gray-300 rounded-md p-2 w-full h-10 text-black">
                            @error('price')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="quantity" class="font-bold">{{ __('messages.quantity') }}</label>
                            <input type="number" id="quantity" required name="quantity" value="{{ old('quantity') }}"
                                class="border border-gray-300 rounded-md p-2 w-full h-10 text-black">
                            @error('quantity')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <select required style="color: black;" name="categoria">
                        <option value="Fashion">Fashion</option>
                        <option value="Electronics">Electronics</option>
                        <option value="Toys and Hobbies">Toys and Hobbies</option>
                    </select >
                        <button type="submit"
                            class="bg-blue-500 text-white font-bold py-2 px-4 rounded">{{ __('messages.submit') }}</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>


<script>
    function previewImage() {
        var imgInput = document.getElementById('img');
        var imgPreview = document.getElementById('imgPreview');
        imgPreview.style.display = 'block';
        imgPreview.src = URL.createObjectURL(imgInput.files[0]);
    }
</script>