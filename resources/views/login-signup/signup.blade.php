@extends('layouts.menu-teacher')
@section('content')
    <main class="form-signin w-100 m-auto">
        <form method="post" action="{{ route("signup_action") }}" autocomplete="off">
            @csrf
            <img class="mb-4" src="./images/logo.png" alt="" width="72" height="57"
                 style="display: block; margin: 0 auto;">
            <h1 class="h6 mt-3 fw-normal text-center">Please Register Below</h1>

            @if(session('validationerror'))
                <p class="text-danger text-center fw-bold">{{session('validationerror')}}</p>
            @endif

            {{--One input validation here and also on the server, but best to be on server but i can save resources by doingt it here        --}}
            <!-- sNo -->
            <div class="form-floating">
                <input type="text" name="snumber" class="form-control mb-4" id="floatingInput"
                       placeholder="Student Number">
                <label>Student Number</label>
            </div>

            <!-- Name -->
            <div class="form-floating">
                <input type="text" name="fullname" class="form-control mb-4" id="floatingInput" placeholder="Full Name">
                <label>Full Name</label>
            </div>

            <div class="form-floating">
                <input type="email" name="email" class="form-control mb-4" id="floatingInput" placeholder="Email">
                <label>Email</label>
            </div>

            <div class="form-floating">
                <input type="password" name="password" class="form-control mb-4" id="floatingInput"
                       placeholder="Password">
                <label>Password</label>
            </div>

            <button class="btn btn-primary w-100 py-2 mt-3" type="submit">Sign up</button>
        </form>
        <a href="{{route('login')}}" class="btn btn-outline-success w-100 py-2 mt-3">Or Login</a>
    </main>
@endsection

