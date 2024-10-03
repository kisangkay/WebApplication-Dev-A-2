<section>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
{{--    The model css and js  uses this --}}
    <header>
        <h2 class="text-lg font-medium text-white">Profile Information</h2>

        <p class="mt-1 text-sm text-gray-400">Update your account's profile</p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <label for="user_number"class="text-white">Usernumber (Unchangeable)</label>
            <input id="user_number" name="user_number" type="number" class="form-control" value="{{old('user_number', $user->user_number)}}" disabled autofocus autocomplete="usernumber" />
        </div>

        <div>
            <label for="fullname" class="text-white">Fullname</label>
            <input id="fullname" name="fullname" type="text" class="form-control" value="{{old('fullname', $user->fullname)}}" autofocus autocomplete="fullname" />
{{--            <x-input-error class="mt-2 text-red-500" :messages="$errors->get('fullname')" />--}}
            <li class="mt-2 text-danger list-unstyled">{{$errors->first('fullname')}}</li>
        </div>

        <div>
            <label for="email" class="text-white">Email</label>
            <input id="email" name="email" type="email" class="form-control" value="{{old('email', $user->email)}}" autocomplete="username" />
            <li class="mt-2 text-danger list-unstyled">{{$errors->first('email')}}</li>

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-300">
                    <p class="text-sm mt-2 text-gray-300">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-400 hover:text-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <button form="send-verification" class="underline text-sm text-gray-400 hover:text-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-400">
                        <p class="mt-2 font-medium text-sm text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <button class="btn btn-success my-2">Save</button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-400"
                    class="text-sm text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>

<style>
    .form-control {
        display: block;
        width: 100%;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: var(--bs-body-color);
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        background-color: var(--bs-body-bg);
        background-clip: padding-box;
        border: var(--bs-border-width) solid var(--bs-border-color);
        border-radius: var(--bs-border-radius);
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
    @media (prefers-reduced-motion: reduce) {
        .form-control {
            transition: none;
        }
    }
    .form-control[type=file] {
        overflow: hidden;
    }
    .form-control[type=file]:not(:disabled):not([readonly]) {
        cursor: pointer;
    }
    .form-control:focus {
        color: var(--bs-body-color);
        background-color: var(--bs-body-bg);
        border-color: #86b7fe;
        outline: 0;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }
    .form-control::-webkit-date-and-time-value {
        min-width: 85px;
        height: 1.5em;
        margin: 0;
    }
    .form-control::-webkit-datetime-edit {
        display: block;
        padding: 0;
    }
    .form-control::-moz-placeholder {
        color: var(--bs-secondary-color);
        opacity: 1;
    }
    .form-control::placeholder {
        color: var(--bs-secondary-color);
        opacity: 1;
    }
    .form-control:disabled {
        background-color: var(--bs-secondary-bg);
        opacity: 1;
    }
    .form-control::-webkit-file-upload-button {
        padding: 0.375rem 0.75rem;
        margin: -0.375rem -0.75rem;
        -webkit-margin-end: 0.75rem;
        margin-inline-end: 0.75rem;
        color: var(--bs-body-color);
        background-color: var(--bs-tertiary-bg);
        pointer-events: none;
        border-color: inherit;
        border-style: solid;
        border-width: 0;
        border-inline-end-width: var(--bs-border-width);
        border-radius: 0;
        -webkit-transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
    .form-control::file-selector-button {
        padding: 0.375rem 0.75rem;
        margin: -0.375rem -0.75rem;
        -webkit-margin-end: 0.75rem;
        margin-inline-end: 0.75rem;
        color: var(--bs-body-color);
        background-color: var(--bs-tertiary-bg);
        pointer-events: none;
        border-color: inherit;
        border-style: solid;
        border-width: 0;
        border-inline-end-width: var(--bs-border-width);
        border-radius: 0;
        transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
    @media (prefers-reduced-motion: reduce) {
        .form-control::-webkit-file-upload-button {
            -webkit-transition: none;
            transition: none;
        }
        .form-control::file-selector-button {
            transition: none;
        }
    }
    .form-control:hover:not(:disabled):not([readonly])::-webkit-file-upload-button {
        background-color: var(--bs-secondary-bg);
    }
    .form-control:hover:not(:disabled):not([readonly])::file-selector-button {
        background-color: var(--bs-secondary-bg);
    }

    .form-control-plaintext {
        display: block;
        width: 100%;
        padding: 0.375rem 0;
        margin-bottom: 0;
        line-height: 1.5;
        color: var(--bs-body-color);
        background-color: transparent;
        border: solid transparent;
        border-width: var(--bs-border-width) 0;
    }
    .form-control-plaintext:focus {
        outline: 0;
    }
    .form-control-plaintext.form-control-sm, .form-control-plaintext.form-control-lg {
        padding-right: 0;
        padding-left: 0;
    }

    .form-control-sm {
        min-height: calc(1.5em + 0.5rem + calc(var(--bs-border-width) * 2));
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
        border-radius: var(--bs-border-radius-sm);
    }
    .form-control-sm::-webkit-file-upload-button {
        padding: 0.25rem 0.5rem;
        margin: -0.25rem -0.5rem;
        -webkit-margin-end: 0.5rem;
        margin-inline-end: 0.5rem;
    }
    .form-control-sm::file-selector-button {
        padding: 0.25rem 0.5rem;
        margin: -0.25rem -0.5rem;
        -webkit-margin-end: 0.5rem;
        margin-inline-end: 0.5rem;
    }

    .form-control-lg {
        min-height: calc(1.5em + 1rem + calc(var(--bs-border-width) * 2));
        padding: 0.5rem 1rem;
        font-size: 1.25rem;
        border-radius: var(--bs-border-radius-lg);
    }
    .form-control-lg::-webkit-file-upload-button {
        padding: 0.5rem 1rem;
        margin: -0.5rem -1rem;
        -webkit-margin-end: 1rem;
        margin-inline-end: 1rem;
    }
    .form-control-lg::file-selector-button {
        padding: 0.5rem 1rem;
        margin: -0.5rem -1rem;
        -webkit-margin-end: 1rem;
        margin-inline-end: 1rem;
    }

    textarea.form-control {
        min-height: calc(1.5em + 0.75rem + calc(var(--bs-border-width) * 2));
    }
    textarea.form-control-sm {
        min-height: calc(1.5em + 0.5rem + calc(var(--bs-border-width) * 2));
    }
    textarea.form-control-lg {
        min-height: calc(1.5em + 1rem + calc(var(--bs-border-width) * 2));
    }

    .form-control-color {
        width: 3rem;
        height: calc(1.5em + 0.75rem + calc(var(--bs-border-width) * 2));
        padding: 0.375rem;
    }
    .form-control-color:not(:disabled):not([readonly]) {
        cursor: pointer;
    }
    .form-control-color::-moz-color-swatch {
        border: 0 !important;
        border-radius: var(--bs-border-radius);
    }
    .form-control-color::-webkit-color-swatch {
        border: 0 !important;
        border-radius: var(--bs-border-radius);
    }
    .form-control-color.form-control-sm {
        height: calc(1.5em + 0.5rem + calc(var(--bs-border-width) * 2));
    }
    .form-control-color.form-control-lg {
        height: calc(1.5em + 1rem + calc(var(--bs-border-width) * 2));
    }
</style>

