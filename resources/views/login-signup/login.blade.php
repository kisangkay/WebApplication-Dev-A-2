@extends('layouts.menu-logged-in')
@section('content')
{{--This is to show the username you entered in the signup page    --}}
        @if(session('lastentry'))
            <div class=" h6 alert alert-success border-bottom text-center text-light" role="alert">
                {{ session('lastentry') }}
{{--                the value of the session name called lastentry in route--}}
            </div>
        @elseif(session('loginerrormessage'))
            <div class=" h6 alert alert-info border-bottom text-center" role="alert">
                {{ session('loginerrormessage') }}
            </div>
{{--If logged out when accessing admin page            --}}
        @elseif(session('whyloggedout'))
            <div class=" h6 alert alert-danger border-bottom text-center text-light" role="alert">
                {{ session('whyloggedout') }}
            </div>
        @endif
<main class="form-signin w-100 m-auto">
    <form method="post" action="{{url("checkifusername_exists_action")}}">
        @csrf
        <img class="mb-4" src="./images/bike.png" alt="" width="72" height="57" style="display: block; margin: 0 auto;">
        <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

{{--show validation message        --}}
        @if(session('validationerror'))
            <p class="text-danger text-center fw-bold">{{session('validationerror')}}</p>
        @endif

        <div class="form-floating">
            <input type="text" name = "username"  class="form-control" id="floatingInput" placeholder="Username" required>
            <label>Username</label>
        </div>

        <button class="btn btn-primary w-100 py-2 mt-3" type="submit">Sign in</button>
    </form>

    <a href="{{ route('signup') }}" class="btn btn-outline-success w-100 py-2 mt-3">Register</a>



</main>
@endsection

