@extends('layouts.root')

@extends('layouts.root')

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
<div class="container form-signin mt-5">
<div class="container form-signin mt-5">
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <h1 class="bi bi-people text-center mt-5"> Welcome to Peer Reviews Manager</h1>
        </div>
        <div>
            <h1 class="bi bi-people text-center mt-5"> Welcome to Peer Reviews Manager</h1>
        </div>
        <div>
            <label for="user_number">Student/Teacher Number</label>
            <input id="user_number" class="form-control" type="number" name="user_number" :value="old('user_number')" autofocus autocomplete="user_number" />

            <div>
                @if($errors->get('user_number'))
                    <div class="text-danger mt-2">
                        @foreach ($errors->get('user_number') as $message)
                            {{ $message }}<br>
                        @endforeach
                    </div>
                @endif
            </div>


            <label for="user_number">Student/Teacher Number</label>
            <input id="user_number" class="form-control" type="number" name="user_number" :value="old('user_number')" autofocus autocomplete="user_number" />

            <div>
                @if($errors->get('user_number'))
                    <div class="text-danger mt-2">
                        @foreach ($errors->get('user_number') as $message)
                            {{ $message }}<br>
                        @endforeach
                    </div>
                @endif
            </div>


        </div>

        <!-- Password -->
        <div class="mt-4">
            <label for="password">Password</label>
            <input class="form-control " id="password" class="block mt-1 w-full"
            <label for="password">Password</label>
            <input class="form-control " id="password" class="block mt-1 w-full"
                            type="password"
                            name="password" autocomplete="current-password" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                <span class="text-light">Remember me</span>
                <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                <span class="text-light">Remember me</span>
            </label>
        </div>
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary">Log in</button><br>
        </div>
        <div class="d-flex justify-content-center  mt-4">
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary">Log in</button><br>
        </div>
        <div class="d-flex justify-content-center  mt-4">
            @if (Route::has('password.request'))
                <a class="px-2 text-decoration-none" href="{{ route('password.request') }}">Forgot your password?</a>
                <a class="px-2 text-decoration-none" href="{{ route('password.request') }}">Forgot your password?</a>
            @endif
            <a class="text-sm text-decoration-none" href="{{ route('register') }}">Register</a>
            <a class="text-sm text-decoration-none" href="{{ route('register') }}">Register</a>
        </div>




    </form>
</div>
</div>

