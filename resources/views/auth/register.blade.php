@extends('layouts.root')
@section('content')
<div class="container form-signin mt-5">
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <h1 class="h1 bi bi-people text-center mt-5"> Welcome to Peer Reviews Manager</h1>
        </div>

        <h5 class="text-center">Student Registration</h5>

        <!-- Student number -->
        <div>
            <label for="user_number">Student Number</label>
            <input class="form-control" id="user_number" type="text" name="user_number" value="{{old('user_number')}}" autofocus autocomplete="user_number"/>
        </div>
        <div>
            <x-input-error :messages="$errors->get('user_number')"/>
        </div>

        <!-- Fullname -->
        <div>
            <label for="fullname">Fullname</label>
            <input id="fullname" class="form-control" type="text" name="fullname" :value="old('fullname')" autofocus autocomplete="fullname"/>
        </div>
        <x-input-error :messages="$errors->get('fullname')"/>

        <!-- Email Address -->
        <div class="mt-4">
            <label for="email">Email</label>
            <input id="email" class="form-control" type="email" name="email" :value="old('email')" autocomplete="username"/>
        </div>
        <x-input-error :messages="$errors->get('email')"/>

        <!-- Password -->
        <div class="mt-4">
            <label for="password">Password</label>
            <input id="password" class="form-control"
                   type="password"
                   name="password" autocomplete="new-password"/>
        </div>
        <x-input-error :messages="$errors->get('password')"/>

        <!-- Confirm Password -->
        <div class="mt-4">
            <label for="password_confirmation" style="background-color:#1d34583b">Confirm Password</label>

            <input id="password_confirmation" class="form-control"
                   type="password"
                   name="password_confirmation" autocomplete="new-password"/>
            <x-input-error :messages="$errors->get('password_confirmation')"/>
        </div>

        <div class="d-flex justify-content-center mt-3">
            <button type="submit" class="btn btn-primary">Register</button><br>
        </div>

        <div class="d-flex justify-content-center  mt-4">
            <a class="text-sm text-decoration-none" href="{{ route('login') }}">Already registered?</a>
        </div>
    </form>
</div>

@endsection
