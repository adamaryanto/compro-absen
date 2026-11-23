<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>Masuk · {{ csetting('brand_name') }}</title>
    <link rel="icon" href="{{ cmedia(csetting('logo_path')) }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
    <div class="login-shell">
        <section class="login-art">
            <a class="login-brand" href="{{ route('home') }}">
                <img src="{{ cmedia(csetting('logo_path')) }}" alt="">
                <span>{{ csetting('brand_name') }}</span>
            </a>

            <div class="login-art-copy">
                <p class="login-eyebrow">Panel admin</p>
                <h1>Kelola tim dan presensi dengan cara yang lebih rapi.</h1>
                <p>Masuk untuk mengatur konten, warna, dan modul {{ csetting('brand_name') }} dalam satu alur yang rapi.</p>
            </div>

            <div class="login-art-foot">&copy; {{ date('Y') }} {{ csetting('company_name') }}</div>
        </section>

        <section class="login-panel">
            <div class="login-card">
                <div class="login-card-top">
                    <span class="login-card-mark"><img src="{{ cmedia(csetting('logo_path')) }}" alt=""></span>
                    <h2>Masuk ke {{ csetting('brand_name') }}</h2>
                    <p>Selamat datang kembali. Masuk untuk melanjutkan.</p>
                </div>

                <form class="login-form" method="POST" action="{{ route('admin.login.store') }}">
                    @csrf

                    <div class="field">
                        <label for="email">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" autocomplete="username" required autofocus placeholder="nama@perusahaan.com">
                        @error('email')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="password">Kata sandi</label>
                        <input id="password" type="password" name="password" autocomplete="current-password" required placeholder="••••••••">
                        @error('password')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <label class="login-remember">
                        <input type="checkbox" name="remember" value="1" @checked(old('remember'))>
                        Ingat saya di perangkat ini
                    </label>

                    <button class="login-submit" type="submit">
                        Masuk
                        <x-icon name="arrow-right" width="15" height="15" />
                    </button>
                </form>

                <div class="login-card-foot">
                    <p>Belum punya akun? <a href="{{ route('register') }}">Daftar</a></p>
                </div>
            </div>

            <a class="login-back" href="{{ route('home') }}">Kembali ke halaman publik</a>
        </section>
    </div>
</body>
</html>
