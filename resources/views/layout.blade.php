<!doctype html>
<html lang="en" style="width: 100%; height: 100%;">
<head >
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>

<body style="width: 100%; height: 100%;">
    <nav class="navbar sticky-top navbar-dark bg-dark">
        <div class="container d-flex flex-column flex-md-row justify-content-between">
            <a class="py-2" href="#" style="color: #dddddd">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="d-block mx-auto"><circle cx="12" cy="12" r="10"></circle><line x1="14.31" y1="8" x2="20.05" y2="17.94"></line><line x1="9.69" y1="8" x2="21.17" y2="8"></line><line x1="7.38" y1="12" x2="13.12" y2="2.06"></line><line x1="9.69" y1="16" x2="3.95" y2="6.06"></line><line x1="14.31" y1="16" x2="2.83" y2="16"></line><line x1="16.62" y1="12" x2="10.88" y2="21.94"></line></svg>
            </a>
            <a class="py-2 d-none d-md-inline-block" style="color: #dddddd" href="{{route('home')}}">Home</a>
            <a class="py-2 d-none d-md-inline-block" style="color: #dddddd" href="{{route('users.list')}}">Users</a>
            <a class="py-2 d-none d-md-inline-block" style="color: #dddddd" href="{{route('chat')}}">Chat</a>
            <a class="py-2 d-none d-md-inline-block" style="color: #dddddd" href="{{route('logout')}}">Logout</a>
        </div>
    </nav>

    <div id="app" style="min-width: 100%; min-height: 100%; position: relative;">
        @yield('content')
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
