<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') — Band Website</title>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --black: #0a0a0a;
            --dark: #111111;
            --dark2: #1a1a1a;
            --dark3: #222222;
            --gold: #c9a84c;
            --gold-light: #e8c97e;
            --white: #ffffff;
            --gray: #888888;
            --gray-light: #cccccc;
            --sidebar-w: 260px;
            --danger: #e74c3c;
            --success: #2ecc71;
            --warning: #f39c12;
            --info: #3498db;
        }

        body {
            background: var(--black);
            color: var(--white);
            font-family: 'Inter', sans-serif;
            font-weight: 300;
            min-height: 100vh;
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-w);
            height: 100vh;
            background: var(--dark);
            border-right: 1px solid rgba(255,255,255,0.06);
            display: flex;
            flex-direction: column;
            z-index: 100;
            overflow-y: auto;
        }

        .sidebar-brand {
            padding: 28px 24px;
            border-bottom: 1px solid rgba(255,255,255,0.06);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sidebar-brand-text {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 22px;
            letter-spacing: 3px;
            color: var(--gold);
        }

        .sidebar-brand-sub {
            font-size: 10px;
            letter-spacing: 2px;
            color: var(--gray);
            text-transform: uppercase;
        }

        .sidebar-nav {
            padding: 20px 0;
            flex: 1;
        }

        .sidebar-section {
            font-size: 9px;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--gray);
            padding: 16px 24px 8px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 24px;
            color: var(--gray);
            text-decoration: none;
            font-size: 13px;
            letter-spacing: 0.5px;
            transition: all 0.2s ease;
            position: relative;
        }

        .sidebar-link i {
            font-size: 16px;
            width: 20px;
            text-align: center;
            flex-shrink: 0;
        }

        .sidebar-link:hover {
            color: var(--white);
            background: rgba(255,255,255,0.04);
        }

        .sidebar-link.active {
            color: var(--gold);
            background: rgba(201,168,76,0.08);
        }

        .sidebar-link.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 3px;
            background: var(--gold);
        }

        .sidebar-badge {
            margin-left: auto;
            background: var(--danger);
            color: white;
            font-size: 10px;
            font-weight: 600;
            padding: 2px 7px;
            border-radius: 10px;
            min-width: 20px;
            text-align: center;
        }

        .sidebar-footer {
            padding: 20px 24px;
            border-top: 1px solid rgba(255,255,255,0.06);
        }

        .sidebar-user {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 14px;
        }

        .sidebar-avatar {
            width: 36px;
            height: 36px;
            background: rgba(201,168,76,0.15);
            border: 1px solid rgba(201,168,76,0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            color: var(--gold);
            flex-shrink: 0;
        }

        .sidebar-user-name {
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 2px;
        }

        .sidebar-user-role {
            font-size: 10px;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--gold);
        }

        .sidebar-logout {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--gray);
            font-size: 12px;
            letter-spacing: 1px;
            text-decoration: none;
            transition: color 0.2s;
            background: none;
            border: none;
            cursor: pointer;
            font-family: 'Inter', sans-serif;
            padding: 0;
            width: 100%;
        }

        .sidebar-logout:hover { color: var(--danger); }

        /* ===== TOPBAR ===== */
        .topbar {
            position: fixed;
            top: 0;
            left: var(--sidebar-w);
            right: 0;
            height: 64px;
            background: var(--dark);
            border-bottom: 1px solid rgba(255,255,255,0.06);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
            z-index: 99;
        }

        .topbar-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 22px;
            letter-spacing: 2px;
            color: var(--white);
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .topbar-btn {
            color: var(--gray);
            font-size: 18px;
            text-decoration: none;
            transition: color 0.2s;
            position: relative;
        }

        .topbar-btn:hover { color: var(--gold); }

        .topbar-dot {
            position: absolute;
            top: -2px;
            right: -2px;
            width: 8px;
            height: 8px;
            background: var(--danger);
            border-radius: 50%;
        }

        /* ===== MAIN CONTENT ===== */
        .admin-main {
            margin-left: var(--sidebar-w);
            padding-top: 64px;
            min-height: 100vh;
        }

        .admin-content {
            padding: 32px;
        }

        /* ===== PAGE HEADER ===== */
        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 32px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .page-header-left .page-label {
            font-size: 10px;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 4px;
        }

        .page-header-left h1 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 36px;
            letter-spacing: 2px;
        }

        /* ===== CARDS ===== */
        .card {
            background: var(--dark2);
            border: 1px solid rgba(255,255,255,0.06);
            padding: 24px;
        }

        .card-title {
            font-size: 11px;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--gray);
            margin-bottom: 16px;
        }

        /* ===== STAT CARDS ===== */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: var(--dark2);
            border: 1px solid rgba(255,255,255,0.06);
            padding: 24px;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            transition: border-color 0.3s ease;
        }

        .stat-card:hover {
            border-color: rgba(201,168,76,0.2);
        }

        .stat-value {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 42px;
            letter-spacing: 2px;
            line-height: 1;
            margin-bottom: 8px;
        }

        .stat-label {
            font-size: 11px;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--gray);
        }

        .stat-icon {
            font-size: 28px;
            opacity: 0.3;
        }

        /* ===== TABLE ===== */
        .admin-table {
            width: 100%;
            border-collapse: collapse;
        }

        .admin-table th {
            text-align: left;
            font-size: 10px;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--gray);
            padding: 12px 16px;
            border-bottom: 1px solid rgba(255,255,255,0.06);
        }

        .admin-table td {
            padding: 14px 16px;
            font-size: 13px;
            border-bottom: 1px solid rgba(255,255,255,0.04);
            vertical-align: middle;
        }

        .admin-table tr:last-child td { border-bottom: none; }
        .admin-table tr:hover td { background: rgba(255,255,255,0.02); }

        /* ===== BADGES ===== */
        .badge {
            display: inline-block;
            padding: 3px 10px;
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .badge-gold { background: rgba(201,168,76,0.15); color: var(--gold); }
        .badge-success { background: rgba(46,204,113,0.15); color: var(--success); }
        .badge-danger { background: rgba(231,76,60,0.15); color: var(--danger); }
        .badge-warning { background: rgba(243,156,18,0.15); color: var(--warning); }
        .badge-info { background: rgba(52,152,219,0.15); color: var(--info); }
        .badge-gray { background: rgba(255,255,255,0.08); color: var(--gray); }

        /* ===== BUTTONS ===== */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 9px 18px;
            font-size: 12px;
            font-weight: 500;
            letter-spacing: 1px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-family: 'Inter', sans-serif;
            transition: all 0.2s ease;
        }

        .btn-primary { background: var(--gold); color: var(--black); }
        .btn-primary:hover { background: var(--gold-light); }
        .btn-sm { padding: 6px 12px; font-size: 11px; }
        .btn-danger { background: rgba(231,76,60,0.15); color: var(--danger); border: 1px solid rgba(231,76,60,0.2); }
        .btn-danger:hover { background: var(--danger); color: white; }
        .btn-secondary { background: rgba(255,255,255,0.06); color: var(--gray-light); }
        .btn-secondary:hover { background: rgba(255,255,255,0.1); }

        /* ===== FORM ===== */
        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-bottom: 20px;
        }

        .form-label {
            font-size: 11px;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--gray);
        }

        .form-control {
            background: var(--dark3);
            border: 1px solid rgba(255,255,255,0.08);
            color: var(--white);
            padding: 12px 16px;
            font-size: 13px;
            font-family: 'Inter', sans-serif;
            outline: none;
            transition: border-color 0.2s ease;
            width: 100%;
        }

        .form-control:focus { border-color: var(--gold); }
        .form-control::placeholder { color: rgba(255,255,255,0.2); }

        select.form-control option { background: var(--dark2); }

        textarea.form-control { resize: vertical; }

        .form-hint {
            font-size: 11px;
            color: var(--gray);
            margin-top: 4px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        /* ===== ALERT ===== */
        .alert {
            padding: 14px 20px;
            font-size: 13px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-success { background: rgba(46,204,113,0.1); border-left: 3px solid var(--success); color: var(--success); }
        .alert-danger { background: rgba(231,76,60,0.1); border-left: 3px solid var(--danger); color: var(--danger); }

        /* ===== PAGINATION ===== */
        .pagination { display: flex; gap: 4px; margin-top: 24px; }
        .pagination a, .pagination span {
            padding: 8px 14px;
            font-size: 12px;
            background: var(--dark2);
            border: 1px solid rgba(255,255,255,0.06);
            color: var(--gray);
            text-decoration: none;
            transition: all 0.2s;
        }
        .pagination a:hover { border-color: var(--gold); color: var(--gold); }
        .pagination .active span { background: var(--gold); color: var(--black); border-color: var(--gold); }

        /* ===== MOBILE ===== */
        .hamburger-admin {
            display: none;
            position: fixed;
            top: 16px;
            left: 16px;
            z-index: 200;
            background: var(--dark2);
            border: 1px solid rgba(255,255,255,0.1);
            color: var(--white);
            width: 40px;
            height: 40px;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            cursor: pointer;
        }

        @media (max-width: 1024px) {
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 768px) {
            .hamburger-admin { display: flex; }
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            .sidebar.open { transform: translateX(0); }
            .admin-main { margin-left: 0; }
            .topbar { left: 0; padding: 0 16px 0 64px; }
            .admin-content { padding: 20px 16px; }
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
            .form-row { grid-template-columns: 1fr; }
        }
    </style>

    @yield('styles')
</head>
<body>

    {{-- Hamburger Mobile --}}
    <button class="hamburger-admin" onclick="toggleSidebar()" id="hamburgerAdmin">
        <i class="bi bi-list"></i>
    </button>

    {{-- SIDEBAR --}}
    <aside class="sidebar" id="adminSidebar">
        <div class="sidebar-brand">
            <div>
                <div class="sidebar-brand-text">BAND</div>
                <div class="sidebar-brand-sub">Admin Panel</div>
            </div>
        </div>

        <nav class="sidebar-nav">
            <div class="sidebar-section">Main</div>

            <a href="{{ route('admin.dashboard') }}"
               class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2"></i> Dashboard
            </a>

            <div class="sidebar-section">Konten</div>

            <a href="{{ route('admin.music.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.music.*') ? 'active' : '' }}">
                <i class="bi bi-music-note-beamed"></i> Music
            </a>

            <a href="{{ route('admin.albums.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.albums.*') ? 'active' : '' }}">
                <i class="bi bi-vinyl"></i> Albums
            </a>

            <a href="{{ route('admin.gallery.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.gallery.*') ? 'active' : '' }}">
                <i class="bi bi-images"></i> Gallery
            </a>

            <a href="{{ route('admin.merchandise.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.merchandise.*') ? 'active' : '' }}">
                <i class="bi bi-bag"></i> Merchandise
            </a>

            <div class="sidebar-section">Transaksi</div>

            <a href="{{ route('admin.orders.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                <i class="bi bi-box-seam"></i> Orders
            </a>

            <a href="{{ route('admin.contact.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.contact.*') ? 'active' : '' }}">
                <i class="bi bi-envelope"></i> Pesan Masuk
                @php $unread = \App\Models\ContactMessage::where('is_read', false)->count(); @endphp
                @if($unread > 0)
                    <span class="sidebar-badge">{{ $unread }}</span>
                @endif
            </a>

            <div class="sidebar-section">Sistem</div>

            <a href="{{ route('admin.users.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <i class="bi bi-people"></i> Users
            </a>

            <a href="{{ route('admin.settings.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                <i class="bi bi-gear"></i> Settings
            </a>

            <div class="sidebar-section">Website</div>

            <a href="{{ route('home') }}" target="_blank" class="sidebar-link">
                <i class="bi bi-box-arrow-up-right"></i> Lihat Website
            </a>
        </nav>

        <div class="sidebar-footer">
            <div class="sidebar-user">
                <div class="sidebar-avatar"><i class="bi bi-person"></i></div>
                <div>
                    <div class="sidebar-user-name">{{ auth()->user()->name }}</div>
                    <div class="sidebar-user-role">{{ auth()->user()->role }}</div>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="sidebar-logout">
                    <i class="bi bi-box-arrow-left"></i> Logout
                </button>
            </form>
        </div>
    </aside>

    {{-- TOPBAR --}}
    <header class="topbar">
        <div class="topbar-title">@yield('title', 'Dashboard')</div>
        <div class="topbar-right">
            <a href="{{ route('admin.contact.index') }}" class="topbar-btn" title="Pesan Masuk">
                <i class="bi bi-envelope"></i>
                @if($unread > 0)
                    <span class="topbar-dot"></span>
                @endif
            </a>
            <a href="{{ route('home') }}" target="_blank" class="topbar-btn" title="Lihat Website">
                <i class="bi bi-globe"></i>
            </a>
        </div>
    </header>

    {{-- MAIN --}}
    <main class="admin-main">
        <div class="admin-content">

            {{-- Alert Global --}}
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">
                    <i class="bi bi-exclamation-circle-fill"></i> {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <script>
        function toggleSidebar() {
            document.getElementById('adminSidebar').classList.toggle('open');
        }

        // Close sidebar kalau klik di luar (mobile)
        document.addEventListener('click', function(e) {
            const sidebar = document.getElementById('adminSidebar');
            const hamburger = document.getElementById('hamburgerAdmin');
            if (window.innerWidth <= 768 &&
                !sidebar.contains(e.target) &&
                !hamburger.contains(e.target)) {
                sidebar.classList.remove('open');
            }
        });
    </script>

    @yield('scripts')
</body>
</html>