@extends('layouts.menu-logged-in')
@section('content')
<main class="form-signin w-100 m-auto">
    <form method="post" action="{{ route("signup_action") }}">
        @csrf
        <img class="mb-4" src="./images/bike.png" alt="" width="72" height="57" style="display: block; margin: 0 auto;">
        <h1 class="h6 mt-3 fw-normal">Please Register using your username</h1>

        @if(session('validationerror'))
            <p class="text-danger text-center fw-bold">{{session('validationerror')}}</p>
        @endif

{{--One input validation here and also on the server, but best to be on server but i can save resources by doingt it here        --}}
        <div class="form-floating">
            <input type="text" name = "username"  class="form-control" id="floatingInput" placeholder="Username" required>
            <label>Username</label>
        </div>

        <button class="btn btn-primary w-100 py-2 mt-3" type="submit">Sign up</button>
    </form>
    <a href="{{route('login')}}" class="btn btn-outline-success w-100 py-2 mt-3">Or Login</a>
</main>
@endsection

