<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/comments.css')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>


</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="container">
        <div class="content">
            <div class="row  justify-content-center align-items-center">
                @yield('home')
                @yield('comments')
            </div>
        </div>
    </div>
</div>
<div id="overlay"></div>
<script src="{{ URL::asset('js/my.js') }}"></script>
</body>
</html>
