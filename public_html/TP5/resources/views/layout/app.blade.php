
<!doctype html>
<html>
<head>
    <title>@yield('titre')</title>
    <link rel="stylesheet" href="{{ URL::asset('css/global.css') }}">
</head>
<body>
    @include('header')
    <main>

        @section('content')
            <h1 style="margin: 4vh;">@yield('titre')</h1>
        @show

    </main>
    @include('footer')
</body>
</html>
