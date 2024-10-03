@extends('layouts.root')
<div class="container form-signin mt-5">
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div class="">
            <label for="email">Email</label>
                <input class="form-control" id="email" type="email" name="email" value="" autofocus>
{{--            <x-input-error :messages="$errors->get('email')" class="mt-2" />--}}

            <div>
                @if($errors->get('email'))
                    <div class="text-danger mt-2">
                        @foreach ($errors->get('email') as $message)
                            {{ $message }}<br>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>

        <div class="flex items-center justify-end mt-4">
            <button class="btn btn-primary">
                {{ __('Email Password Reset Link') }}
            </button>
        </div>
    </form>
</div>
