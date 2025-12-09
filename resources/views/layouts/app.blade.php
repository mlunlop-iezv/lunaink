<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>LunaInk</title>
    <link rel="icon" href="{{asset('img/icon.ico')}}"> 
</head>

<body>
    <header class="site-header">
        <div class="logo"><a href="{{ route('main.home') }}">LUNAINK</a></div>

        <nav class="navbar">
            <a href="{{ route('main.home') }}" class="nav-link {{ request()->routeIs('main.home') ? 'active' : '' }}">HOME</a>
            <a href="{{ route('tattoos.index') }}" class="nav-link {{ request()->routeIs('tattoos.*') ? 'active' : '' }}">TATTOOS</a>
            <a href="{{ route('artists.index') }}"class="nav-link {{ request()->routeIs('artists.*') ? 'active' : '' }}">ARTISTS</a>
            <a href="{{ route('styles.index') }}"class="nav-link {{ request()->routeIs('styles.*') ? 'active' : '' }}">STYLES</a>
        </nav>
        <a href="{{ route('tattoos.create') }}" class="btn-book">+ ADD A TATTOO</a>
    </header>
    <main>
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @yield('content')
    </main>
    <footer class="site-footer">
        <div class="footer-container">

            <div class="footer-col brand-col">
                <h3 class="footer-logo">LUNAINK</h3>
                <p class="footer-desc">
                    Where art meets skin. Premium tattoo artistry in the heart of the city, crafting timeless pieces
                    since 2019.
                </p>
            </div>

            <div class="footer-col nav-col">
                <h4>NAVIGATE</h4>
                <ul>
                    <li><a href="{{ route('main.home') }}" class="nav-link">HOME</a></li>
                    <li><a href="{{ route('tattoos.index') }}" class="nav-link">TATTOOS</a></li>
                    <li><a href="{{ route('artists.index') }}" class="nav-link">ARTISTS</a></li>
                    <li><a href="{{ route('styles.index') }}" class="nav-link">STYLES</a></li>
                </ul>
            </div>

            <div class="footer-col contact-col">
                <h4>CONNECT</h4>
                <div class="contact-info">
                    <p>Av. de Dílar, 85 (Local 2)</p>
                    <p>Zaidín, 18007 Granada</p>

                    <a href="mailto:hello@lunaink.studio" class="footer-email">hello@lunaink.studio</a>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="footer-bottom-content">
                <p class="copyright">© 2025 Mario Luna Lopez / Lunaink Studio. All rights reserved.</p>

                <div class="legal-links">
                    <a href="#">Privacy Policy</a>
                    <a href="#">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>