<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title ?? ''}}</title>
    {{-- @yield('title') --}}
    {{-- cara 1 --}}
    {{-- <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"> --}}
    {{-- cara 2 --}}
    <link rel="stylesheet" href="/css/bootstrap.min.css">
</head>

<body>

    @include('layouts.navigation')

    <div class="py-3">
        @yield('content')
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="/js/bootstrap.min.js"></script>
</body>

</html>