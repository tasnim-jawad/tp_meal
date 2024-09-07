<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Planing Software</title>
    {{-- <link rel="stylesheet" href="{{ asset('css/uniflex_style.css')}}"> --}}
    @vite('resources/sass/app.scss')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/custom/custom.css')}}">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" ></script>
    <script src="{{ asset('js//sweet_alert.js')}}" defer></script>
    @vite('resources/js/app.js')
</head>
<body>
    <div id="app">
        <app></app>
    </div>
    {{-- <form id="logout-form" action="{{ route('auth_logout') }}" method="POST" class="d-none">
        @csrf
    </form> --}}
</body>
</html>
