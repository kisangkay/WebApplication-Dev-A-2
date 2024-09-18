@extends('layouts.root')
@section('menu')
<nav class="navbar navbar-expand-lg bg-body-tertiary rounded">
    <div class="container-fluid">
        <a class="px-5 d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
            <a href="{{ route('home') }}"  class="bi bi-bicycle fs-1"  style="margin-right: 6px"></a>
            <span class="fs-4" style="margin-right: 10px">YesBike</span>
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
                    <a href="{{ route('home') }}" class="nav-link active">
                        <i class="bi bi-bicycle fs-4 me-2"></i>
                        Bikes
                    </a>
                </li>
                <li>
                    <a href="{{ route('all-manufacturers') }}" class="nav-link link-body-emphasis">
                        <i class="bi bi-house-gear fs-4 me-2"></i>
                        Manufacturers
                    </a>
                </li>
                <li>
                    <a href="{{route('create-a-new-item')}}"  class="nav-link link-body-emphasis">
                        <i class="bi bi-plus-circle fs-4 me-2"></i>
                        Create New Item
                    </a>
                </li>
            </ul>

            @if(Route::currentRouteName() != 'login' and Route::currentRouteName() != 'signup' and Route::currentRouteName() != 'signup_action')
            <div class="dropdown">
                <a class="d-flex align-items-center link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person fs-4 me-1" style="margin-left: 10px;"></i>
                    <strong>Welcome {{session('username')}}</strong>
                </a>

                <ul class="dropdown-menu">
                    <li>
                    <a class="dropdown-item" href="{{route('logout_action')}}">Sign out</a>
                    </li>
                </ul>
            </div>
            @endif
        </div>
    </div>
</nav>
@endsection
