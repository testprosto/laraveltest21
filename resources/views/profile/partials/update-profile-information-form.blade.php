<style>
    #imageInput {
        display: none;
    }
</style>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('messages.profile_information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{__('messages.update_your_account') }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!-- Name Input -->
        <div>
            <x-input-label for="name" :value="__('messages.name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)"
                required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- Email Input -->
        <div>
            <x-input-label for="email" :value="__('messages.email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            <!-- Email Verification -->
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('messages.your_email_address') }}

                        <button form="send-verification"
                            class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('messages.click_re_send_verification') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('messages.a_new_verification_link') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Save Button -->
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('messages.save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400">{{ __('messages.saved') }}</p>
            @endif
        </div>
    </form>


    <form method="POST" action="{{ route('profile.updateavatar', ['id' => Auth::id()]) }}"
        enctype="multipart/form-data">
        @csrf

        <h2 style="left: 60%; top: 215px;  position: absolute; color: white; text-align: center;">
            {{ __('messages.avatar') }}
            <div>
                <div>
                    <img id="avatarImg" style="width: 300px; border-radius: 50%; height: 300px" src="/{{ Auth::user()->avatar }}"
                        alt="Avatar">

                    <div class="max-w-xl">
                        <label style="cursor: pointer;" for="imageInput"
                            id="chooseFileLabel">{{ __('messages.choose_image') }}</label>
                        <input type="file" id="imageInput" name="img" onchange="showFileName()">
                        <button type="submit" id="uploadButton"
                            style="display: none;">{{ __('messages.upload_image') }}</button>
                        <div id="fileNameDisplay"></div>
                    </div>
                </div>

        </h2>
    </form>
</section>

<script>
    function showFileName() {
        var fileInput = document.getElementById('imageInput');
        var fileNameDisplay = document.getElementById('fileNameDisplay');
        var chooseFileLabel = document.getElementById('chooseFileLabel');
        var uploadButton = document.getElementById('uploadButton');
        var imgElement = document.getElementById('avatarImg');

        if (fileInput.files.length > 0) {
            chooseFileLabel.style.display = 'none';
            uploadButton.style.display = 'inline';

            var reader = new FileReader();
            reader.onload = function (e) {
                imgElement.src = e.target.result;
            };
            reader.readAsDataURL(fileInput.files[0]);
        } else {
            fileNameDisplay.textContent = "";
            chooseFileLabel.style.display = 'inline';
            uploadButton.style.display = 'none';
        }
    }

    document.getElementById('imageInput').addEventListener('change', showFileName);
</script>