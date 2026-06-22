<html lang="it">
<head>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name='csrf-token' content="{{ csrf_token() }}">
    <meta name='user_id' content="{{ session('user_id') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sito Brutto - @yield('title')</title>
    <link rel="stylesheet" href="{{url('css/layout.css')}}">
    @yield('pageStyle')
    <script src="{{url('js/layout.js')}}" defer></script>
    @yield('pageScript')
</head>
<body>

    <header>
        <nav id='phone-nav'>
            <button id='phone-nav-toggle'>Menu</button>
            <div id='phone-nav-list' class='hidden'>
                <a href="{{ url('/home') }}">Home</a>
                <a href="{{ url('/luoghi') }}">Luoghi</a>
                <a href="{{ url('/utenti') }}">Utenti</a>
                
                @if(session('user_id'))
                    <a href="{{ url("/profile") }}">Profilo</a>
                @else
                    <a href="{{ url('/login') }}">Accedi</a>
                @endif
            </div>
        </nav>
        <nav id="desktop-nav">
                <a href="{{ url('/home') }}">Home</a>
                <a href="{{ url('/luoghi') }}">Luoghi</a>
                <a href="{{ url('/utenti') }}">Utenti</a>
                
                @if(session('user_id'))
                    <a href="{{ url('/profile') }}">Profilo</a>
                @else
                    <a href="{{ url('/login') }}">Accedi</a>
                @endif
        </nav>

        <div class="header-content">
            @yield('header-content')
        </div>
    </header>

    <div class="content">
        @yield('content')
    </div>

    <footer>
        <p>&copy; 2026 Sito bruttissimo. Diritti inesistenti.</p>
    </footer>

</body>
</html>