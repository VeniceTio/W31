
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
            <h1>@yield('titre')</h1>
        @show
        @include('../shared/message')
    </main>
    @include('footer')
</body>
</html>
