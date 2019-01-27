<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'WebmaniaBR')</title>
</head>
<body>
    <!-- Navbar -->
    <div class="container col-7">
        @if (session('msg_error'))
            <div class="alert alert-warning" role="alert">
                <strong>{{session('msg_error')}}</strong>
            </div>
        @endif
        @component('_layout.navbar')
        @endcomponent
    </div>

    <!--Conteudo -->
    @yield('content')

    <!-- Javascript -->
    <script src="{{asset('js/app.js')}}" type="text/javascript"></script>

    @hasSection ('javascript')
        <script type="text/javascript">
            @yield('javascript')
        </script>
    @endif
</body>
</html>