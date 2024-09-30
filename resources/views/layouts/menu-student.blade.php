@extends('layouts.root')
@section('menu-student')
    <nav class="navbar navbar-expand-lg bg-body-tertiary rounded">
        <div class="container-fluid">
            <a class="px-5 d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                <a class="bi bi-people fs-1"  style="margin-right: 6px"></a>
                <span class="fs-4" style="margin-right: 10px">PRManager</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbtoggle" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbtoggle">
                <ul class="nav-pills navbar-nav me-auto mb-2 mb-lg-0">
                    @if(session('username') && session('username') == 'admin')
                        <li class="me-4">
                            <a href="{{ route('super-admin') }}" class="nav-link text-danger">
                                <i class="bi bi-person-badge fs-4 me-2"></i>
                                Admin
                            </a>
                        </li>
                    @endif
                    <li>
                        <a href="{{ url('/') }}" class="nav-link active">
                            <i class="bi bi-house fs-4 me-2"></i>
                            Home
                        </a>
                    </li>
                </ul>

                @if(Route::currentRouteName() != 'login' and Route::currentRouteName() != 'signup' and Route::currentRouteName() != 'signup_action')
                    <div class="dropdown">
                        <a class="d-flex align-items-center link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person fs-4 me-1" style="margin-left: 10px;"></i>
                            <strong>Student {{ Auth::user()->fullname }}</strong>
                        </a>

                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{route('profile.edit')}}">Profile</a>
                                {{--                    <a class="dropdown-item" href="{{ Auth::user()->name }}">Email</a>--}}
                                {{--                    <a class="dropdown-item" href="">Sign out</a>--}}
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <a class="dropdown-item" href="{{route('logout')}}"
                                       onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </a>
                                </form>
                                {{--                    <a class="dropdown-item" href="{{route('logout_action')}}">Sign out</a>--}}
                            </li>
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </nav>
@endsection
