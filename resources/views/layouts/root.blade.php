<!DOCTYPE html>
<html data-bs-theme="dark">
<head>
    <meta charset="utf-8">
    <title>YesBike</title>
    <link rel="icon" type="image/x-icon" href="{{asset('./images/bike.png')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-icons.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
</head>

<body>
@yield('menu')
@yield('content')
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
