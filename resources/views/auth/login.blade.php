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
            <x-input-error :messages="$errors->get('user_number')"/>

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

@endsection
