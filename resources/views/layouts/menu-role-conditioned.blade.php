@extends('layouts.root')
@section('menu-role-conditioned')
    <nav class="navbar navbar-expand-lg bg-body-tertiary rounded">
        <div class="container-fluid">
            <a class="px-5 d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                <a class="bi bi-people fs-1"  style="margin-right: 6px"></a>
                <span class="fs-4 text-light" style="margin-right: 10px">PRManager</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbtoggle" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>


            <div class="collapse navbar-collapse" id="navbtoggle">
                <ul class="nav-pills navbar-nav me-auto mb-2 mb-lg-0">
 {{-- If logged in on top reviewers page, will see home button --}}
                    @if(auth()->user())
                        <li class="me-4">
                            <a href="{{ url('/') }}" class="nav-link active">
                                <i class="bi bi-house fs-4 me-2"></i>
                                Home
                            </a>
                        </li>
                    @else
{{-- If not logged in on top reviewers page, will see login buttons instead of home --}}
                        <li>
                            <a href="{{ route('login') }}" class="nav-link active">
                                <i class="bi bi-lock fs-4 me-2"></i>
                                Login
                            </a>
                        </li>
                    @endif
                </ul>

                @if(Route::currentRouteName() != 'login' and Route::currentRouteName() != 'signup' and Route::currentRouteName() != 'signup_action' and Route::currentRouteName() != 'top-reviewers')
{{-- THEN IT MEANS YOU ARE LOGGED IN SO GET THE ROLE DISPLAYED BEFORE NAME --}}
                    <div class="dropdown">

{{-- Condition to display the relevant role before name --}}

                        @if(auth()->user() and auth()->user()->user_role === 'teacher')
                            <a class="d-flex align-items-center link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person fs-4 me-1" style="margin-left: 10px;"></i>
                                <strong>Teacher {{ Auth::user()->fullname }}</strong>
                            </a>
                        @elseif(auth()->user() and auth()->user()->user_role === 'student')
                            <a class="d-flex align-items-center link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person fs-4 me-1" style="margin-left: 10px;"></i>
                                <strong>Student {{ Auth::user()->fullname }}</strong>
                            </a>
                        @endif

                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{route('profile.edit')}}">Profile</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <a class="dropdown-item" href="{{route('logout')}}"
                                       onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </nav>
@endsection
