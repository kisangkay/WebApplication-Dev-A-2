<!DOCTYPE html>
<html data-bs-theme="dark">
<head>
    <meta charset="utf-8">
    <title>PRManager</title>
    <link rel="icon" class="img-fluid" type="image/x-icon" href="{{asset('./images/logo.png')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-icons.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">

    <meta name="csrf-token" content="{{ csrf_token() }}">

{{--    css and js for the delete account button--}}
</head>

<body>
@yield('menu-teacher')
@yield('menu-student')
@yield('menu-role-conditioned')
@yield('content')

<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
