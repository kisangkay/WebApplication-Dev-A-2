@extends('layouts.root')
<div class="container form-signin mt-5">
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <h1 class="bi bi-people text-center mt-5"> Welcome to Peer Reviews Manager</h1>
        </div>

        <h5 class="text-center">Register</h5>

        <!-- Student number -->
        <div>
            <label for="user_number">Student Number</label>
            <input class="form-control" id="user_number" type="number" name="user_number" :value="old('user_number')" autofocus autocomplete="user_number"/>
        </div>
{{--  Error message      --}}
        <div>
            @if($errors->get('user_number'))
                <div class="text-danger mt-2">
                    @foreach ($errors->get('user_number') as $message)
                        {{ $message }}<br>
                    @endforeach
                        @foreach ($errors->get('fullname') as $message)
                            {{ $message }}<br>
                        @endforeach
                        @foreach ($errors->get('email') as $message)
                            {{ $message }}<br>
                        @endforeach
                        @foreach ($errors->get('password') as $message)
                            {{ $message }}<br>
                        @endforeach
                        @foreach ($errors->get('password_confirmation') as $message)
                            {{ $message }}<br>
                        @endforeach
                </div>
            @endif
        </div>

        <!-- Fullname -->
        <div>
            <label for="fullname">Fullname</label>
            <input id="fullname" class="form-control" type="text" name="fullname" :value="old('fullname')" autofocus autocomplete="fullname"/>
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <label for="email">Email</label>
            <input id="email" class="form-control" type="email" name="email" :value="old('email')" autocomplete="username"/>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label for="password">Password</label>
            <input id="password" class="form-control"
                            type="password"
                            name="password" autocomplete="new-password"/>
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <label for="password_confirmation" style="background-color:#1d34583b">Confirm Password</label>

            <input id="password_confirmation" class="form-control"
                            type="password"
                            name="password_confirmation" autocomplete="new-password"/>
        </div>

        <div class="d-flex justify-content-center mt-3">
            <button type="submit" class="btn btn-primary">Register</button><br>
        </div>

        <div class="d-flex justify-content-center  mt-4">
            <a class="text-sm text-decoration-none" href="{{ route('login') }}">Already registered?</a>
        </div>
    </form>
</div>
