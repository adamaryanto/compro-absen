<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>@yield('title', 'Admin') · {{ csetting('brand_name') }}</title>
    <link rel="icon" href="{{ cmedia(csetting('logo_path')) }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <script>document.documentElement.classList.add('has-js');</script>
</head>
<body>
    @php
        $routeType = request()->route('type');
        $isCollection = request()->routeIs('admin.collection.*');
    @endphp

    <div class="admin-shell" id="adminShell">
        <aside class="admin-sidebar" id="adminSidebar">
            <button type="button" class="admin-sidebar-close" id="adminSidebarClose" aria-label="Tutup menu">
                <x-icon name="x" />
            </button>

            <a class="admin-brand" href="{{ route('admin.dashboard') }}">
                <span class="admin-brand-mark">
                    <img src="{{ cmedia(csetting('logo_path')) }}" alt="" width="40" height="40">
                </span>
                <span>
                    <span class="admin-brand-name">{{ csetting('brand_name') }}</span>
                    <span class="admin-brand-sub">Panel admin</span>
                </span>
            </a>

            <nav class="admin-nav" aria-label="Navigasi admin">
                <div class="admin-nav-group">
                    <p class="admin-nav-label">Utama</p>
                    <a href="{{ route('admin.dashboard') }}" @class(['is-active' => request()->routeIs('admin.dashboard')])>
                        <x-icon name="grid" />
                        Ringkasan
                    </a>
                </div>

                <div class="admin-nav-group">
                    <p class="admin-nav-label">Halaman</p>
                    <a href="{{ route('admin.settings.edit') }}" @class(['is-active' => request()->routeIs('admin.settings.*')])>
                        <x-icon name="file-text" />
                        Konten halaman
                    </a>
                    <a href="{{ route('admin.appearance.edit') }}" @class(['is-active' => request()->routeIs('admin.appearance.*')])>
                        <x-icon name="palette" />
                        Tampilan & warna
                    </a>
                </div>

                <div class="admin-nav-group">
                    <p class="admin-nav-label">Konten</p>
                    @foreach (config('compro.collections') as $key => $collection)
                        <a href="{{ route('admin.collection.index', $key) }}" @class(['is-active' => $isCollection && $routeType === $key])>
                            @switch($key)
                                @case('keunggulan') <x-icon name="layers" /> @break
                                @case('modul') <x-icon name="layers" /> @break
                                @case('langkah') <x-icon name="clock" /> @break
                                @case('faq') <x-icon name="help-circle" /> @break
                                @case('statistik') <x-icon name="chart" /> @break
                            @endswitch
                            {{ $collection['label'] }}
                        </a>
                    @endforeach
                </div>

                <div class="admin-nav-group">
                    <p class="admin-nav-label">Akun</p>
                    <a href="{{ route('admin.account.edit') }}" @class(['is-active' => request()->routeIs('admin.account.*')])>
                        <x-icon name="user" />
                        Akun saya
                    </a>
                </div>
            </nav>

            <div class="admin-sidebar-foot">
                <a href="{{ route('home') }}" target="_blank" rel="noopener">
                    <x-icon name="external" />
                    Lihat halaman publik
                </a>
            </div>
        </aside>

        <div class="admin-overlay" id="adminOverlay" aria-hidden="true"></div>

        <div class="admin-main">
            <header class="admin-topbar">
                <div class="admin-topbar-left" style="display:flex;align-items:center;gap:14px">
                    <button class="admin-menu-btn" type="button" id="adminMenuBtn" aria-label="Buka menu" aria-expanded="false" aria-controls="adminSidebar">
                        <x-icon name="menu" />
                    </button>
                    <div>
                        <div class="admin-page-label">@yield('page_label', 'Panel admin')</div>
                        <h1 class="admin-page-name">@yield('page_name', 'Ringkasan')</h1>
                    </div>
                </div>

                <div class="admin-topbar-actions">
                    <a class="btn btn--ghost btn--sm admin-view-site" href="{{ route('home') }}" target="_blank" rel="noopener">
                        <x-icon name="eye" />
                        Lihat situs
                    </a>
                    <div class="admin-user">
                        <span class="admin-user-mark">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}</span>
                        <span>{{ auth()->user()->name ?? 'Admin' }}</span>
                    </div>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button class="btn btn--ghost btn--sm" type="submit">
                            <x-icon name="log-out" />
                            Keluar
                        </button>
                    </form>
                </div>
            </header>

            <div class="admin-content">
                @if (session('status'))
                    <div class="flash" role="status">
                        <x-icon name="check" />
                        {{ session('status') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <script src="{{ asset('js/admin.js') }}" defer></script>
</body>
</html>
