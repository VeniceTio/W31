
<!doctype html>
<html>
<head>
    <title>@yield('titre')</title>
</head>
<body>
    <main>

        @section('content')
            <h1>@yield('titre')</h1>
        @show
        @include('../shared/message')
    </main>
</body>
</html>
