<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Band Website')</title>

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --black: #0a0a0a;
            --dark: #111111;
            --dark2: #1a1a1a;
            --gold: #c9a84c;
            --gold-light: #e8c97e;
            --white: #ffffff;
            --gray: #888888;
            --gray-light: #cccccc;
        }

        body {
            background-color: var(--black);
            color: var(--white);
            font-family: 'Inter', sans-serif;
            font-weight: 300;
        }

        /* ===== NAVBAR ===== */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 999;
            padding: 20px 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: linear-gradient(to bottom, rgba(0,0,0,0.9), transparent);
            transition: all 0.3s ease;
        }

        .navbar.scrolled {
            background: rgba(10, 10, 10, 0.97);
            padding: 14px 60px;
            border-bottom: 1px solid rgba(201, 168, 76, 0.2);
        }

        .navbar-brand {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 28px;
            letter-spacing: 4px;
            color: var(--gold);
            text-decoration: none;
        }

        .navbar-nav {
            display: flex;
            align-items: center;
            gap: 40px;
            list-style: none;
        }

        .navbar-nav a {
            color: var(--gray-light);
            text-decoration: none;
            font-size: 12px;
            letter-spacing: 2px;
            text-transform: uppercase;
            transition: color 0.3s ease;
        }

        .navbar-nav a:hover,
        .navbar-nav a.active {
            color: var(--gold);
        }

        .navbar-nav .btn-nav {
            background: var(--gold);
            color: var(--black);
            padding: 8px 20px;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .navbar-nav .btn-nav:hover {
            background: var(--gold-light);
            color: var(--black);
        }

        /* Hamburger */
        .hamburger {
            display: none;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
            background: none;
            border: none;
            padding: 5px;
        }

        .hamburger span {
            display: block;
            width: 24px;
            height: 2px;
            background: var(--white);
            transition: all 0.3s ease;
        }

        /* Mobile Nav */
        .mobile-nav {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background: var(--black);
            z-index: 998;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 32px;
        }

        .mobile-nav.open {
            display: flex;
        }

        .mobile-nav a {
            color: var(--white);
            text-decoration: none;
            font-family: 'Bebas Neue', sans-serif;
            font-size: 36px;
            letter-spacing: 4px;
            transition: color 0.3s;
        }

        .mobile-nav a:hover {
            color: var(--gold);
        }

        /* ===== FOOTER ===== */
        footer {
            background: var(--dark);
            border-top: 1px solid rgba(201, 168, 76, 0.15);
            padding: 60px;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 60px;
            margin-bottom: 40px;
        }

        .footer-brand {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 32px;
            letter-spacing: 4px;
            color: var(--gold);
            margin-bottom: 16px;
        }

        .footer-desc {
            color: var(--gray);
            font-size: 13px;
            line-height: 1.8;
            max-width: 280px;
        }

        .footer-title {
            font-size: 11px;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 20px;
        }

        .footer-links {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .footer-links a {
            color: var(--gray);
            text-decoration: none;
            font-size: 13px;
            transition: color 0.3s;
        }

        .footer-links a:hover {
            color: var(--gold);
        }

        .footer-socials {
            display: flex;
            gap: 16px;
            margin-top: 20px;
        }

        .footer-socials a {
            width: 38px;
            height: 38px;
            border: 1px solid rgba(201, 168, 76, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gray);
            text-decoration: none;
            font-size: 16px;
            transition: all 0.3s;
        }

        .footer-socials a:hover {
            border-color: var(--gold);
            color: var(--gold);
        }

        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.06);
            padding-top: 30px;
            text-align: center;
            color: var(--gray);
            font-size: 12px;
            letter-spacing: 1px;
        }

        /* ===== UTILITIES ===== */
        .section {
            padding: 100px 60px;
        }

        .section-label {
            font-size: 11px;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 16px;
        }

        .section-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 56px;
            letter-spacing: 2px;
            line-height: 1;
            margin-bottom: 20px;
        }

        .section-desc {
            color: var(--gray);
            font-size: 14px;
            line-height: 1.8;
            max-width: 500px;
        }

        .btn-gold {
            display: inline-block;
            background: var(--gold);
            color: var(--black);
            padding: 14px 36px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-gold:hover {
            background: var(--gold-light);
        }

        .btn-outline {
            display: inline-block;
            border: 1px solid var(--gold);
            color: var(--gold);
            padding: 13px 36px;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 3px;
            text-transform: uppercase;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-outline:hover {
            background: var(--gold);
            color: var(--black);
        }

        /* Page content offset untuk navbar fixed */
        .page-content {
            padding-top: 80px;
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 20px 24px;
            }
            .navbar.scrolled {
                padding: 14px 24px;
            }
            .navbar-nav {
                display: none;
            }
            .hamburger {
                display: flex;
            }
            .section {
                padding: 60px 24px;
            }
            .section-title {
                font-size: 36px;
            }
            footer {
                padding: 40px 24px;
            }
            .footer-grid {
                grid-template-columns: 1fr;
                gap: 32px;
            }
        }
    </style>

    @yield('styles')
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar" id="navbar">
        <a href="{{ route('home') }}" class="navbar-brand">THE KACRUT</a>

        <ul class="navbar-nav">
            <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
            <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a></li>
            <li><a href="{{ route('music') }}" class="{{ request()->routeIs('music') ? 'active' : '' }}">Music</a></li>
            <li><a href="{{ route('gallery') }}" class="{{ request()->routeIs('gallery') ? 'active' : '' }}">Gallery</a></li>
            <li><a href="{{ route('merchandise') }}" class="{{ request()->routeIs('merchandise') ? 'active' : '' }}">Merch</a></li>
            <li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a></li>
            @auth
                @if(auth()->user()->isAdmin())
                    <li><a href="{{ route('admin.dashboard') }}" class="btn-nav">Admin Panel</a></li>
                @endif
                <li>
                    <form method="POST" action="{{ route('logout') }}" style="display:inline">
                        @csrf
                        <button type="submit" style="background:none;border:none;color:var(--gray-light);font-size:12px;letter-spacing:2px;text-transform:uppercase;cursor:pointer;">Logout</button>
                    </form>
                </li>
            @else
                <li><a href="{{ route('login') }}" class="btn-nav">Login</a></li>
            @endauth
        </ul>

        <!-- Hamburger Mobile -->
        <button class="hamburger" onclick="toggleMobileNav()" id="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </nav>

    <!-- MOBILE NAV -->
    <div class="mobile-nav" id="mobileNav">
        <a href="{{ route('home') }}" onclick="toggleMobileNav()">Home</a>
        <a href="{{ route('about') }}" onclick="toggleMobileNav()">About</a>
        <a href="{{ route('music') }}" onclick="toggleMobileNav()">Music</a>
        <a href="{{ route('gallery') }}" onclick="toggleMobileNav()">Gallery</a>
        <a href="{{ route('merchandise') }}" onclick="toggleMobileNav()">Merch</a>
        <a href="{{ route('contact') }}" onclick="toggleMobileNav()">Contact</a>
        @auth
            @if(auth()->user()->isAdmin())
                <a href="{{ route('admin.dashboard') }}" onclick="toggleMobileNav()">Admin Panel</a>
            @endif
        @else
            <a href="{{ route('login') }}" onclick="toggleMobileNav()">Login</a>
        @endauth
    </div>

    <!-- MAIN CONTENT -->
    <main>
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer>
        <div class="footer-grid">
            <div>
                <div class="footer-brand">BAND</div>
                <p class="footer-desc">Musik adalah bahasa jiwa. Kami hadir untuk menyampaikan cerita lewat setiap nada dan lirik.</p>
                <div class="footer-socials">
                    <a href="#"><i class="bi bi-instagram"></i></a>
                    <a href="#"><i class="bi bi-facebook"></i></a>
                    <a href="#"><i class="bi bi-youtube"></i></a>
                    <a href="#"><i class="bi bi-spotify"></i></a>
                </div>
            </div>
            <div>
                <div class="footer-title">Menu</div>
                <ul class="footer-links">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('about') }}">About</a></li>
                    <li><a href="{{ route('music') }}">Music</a></li>
                    <li><a href="{{ route('gallery') }}">Gallery</a></li>
                    <li><a href="{{ route('merchandise') }}">Merchandise</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </div>
            <div>
                <div class="footer-title">Kontak</div>
                <ul class="footer-links">
                    <li><a href="#">info@bandwebsite.com</a></li>
                    <li><a href="#">+62 812 3456 7890</a></li>
                    <li><a href="#">Bandung, Jawa Barat</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            © 2025 Band Website. All Rights Reserved.
        </div>
    </footer>

    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Mobile nav toggle
        function toggleMobileNav() {
            const nav = document.getElementById('mobileNav');
            nav.classList.toggle('open');
        }
    </script>

    @yield('scripts')
</body>
</html>