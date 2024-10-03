@extends('layouts.root')
@section('content')

<!-- Session Status -->
<x-auth-session-status class="mb-4" :status="session('status')" />
<div class="container form-signin mt-5">
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <h1 class="h1 bi bi-people text-center mt-5"> Welcome to Peer Reviews Manager</h1>
        </div>
        <div>
            <label for="user_number">Student/Teacher Number</label>
            <input id="user_number" class="form-control" type="text" name="user_number" value="{{old('user_number')}}" autofocus autocomplete="user_number" />
            <x-input-error :messages="$errors->get('user_number')" class="mt-2 text-red-500" />

        </div>

        <!-- Password -->
        <div class="mt-4">
            <label for="password">Password</label>
            <input class="form-control " id="password" class="block mt-1 w-full"
                   type="password"
                   value="{{ old('password') }}"
                   name="password" autocomplete="current-password">
        </div>
        <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500" />

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                <span class="text-light">Remember me</span>
            </label>
        </div>
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary">Log in</button><br>
        </div>
        <div class="d-flex justify-content-center  mt-4">
            @if (Route::has('password.request'))
                <a class="px-2 text-decoration-none text-info" href="{{ route('password.request') }}">Forgot your password?</a>
            @endif
            <a class="text text-decoration-none text-success" href="{{ route('register') }}">Register</a>
        </div>


    </form>
</div>
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
@endsection
