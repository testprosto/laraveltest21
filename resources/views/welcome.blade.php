<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/test.css') }}" rel="stylesheet">

    <title>Laravel</title>
</head>

<body>
    <h1 class="test">
aaa
    </h1>
    @if (Route::has('login'))
        <div class="d1">
            <a href="{{ route('login') }}">Log in</a>
            @if (Route::has('register'))
            <br>
                <a href="{{ route('register') }}">Register</a>
            @endif
        </div>
    @endif
</body>

</html>
