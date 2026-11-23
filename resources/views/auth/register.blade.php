<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>Daftar · {{ csetting('brand_name') }}</title>
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
                <p class="login-eyebrow">Pendaftaran</p>
                <h1>Kelola tim dan presensi dengan cara yang lebih rapi.</h1>
                <p>Masuk atau buat akun untuk melanjutkan pengelolaan presensi, workspace, dan operasional tim Anda dalam satu alur yang rapi.</p>
            </div>

            <div class="login-art-foot">&copy; {{ date('Y') }} {{ csetting('company_name') }}</div>
        </section>

        <section class="login-panel">
            <div class="login-card">
                <div class="login-card-top">
                    <span class="login-card-mark"><img src="{{ cmedia(csetting('logo_path')) }}" alt=""></span>
                    <h2>Buat akun {{ csetting('brand_name') }}</h2>
                    <p>Isi data di bawah untuk mengajukan akun.</p>
                </div>

                @if (session('status'))
                    <p class="form-status">{{ session('status') }}</p>
                @endif

                <form class="login-form" method="POST" action="{{ route('register.store') }}">
                    @csrf

                    <div class="field">
                        <label for="name">Nama lengkap</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" autocomplete="name" required placeholder="Nama Anda">
                        @error('name')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="email">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" autocomplete="email" required placeholder="nama@perusahaan.com">
                        @error('email')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="password">Kata sandi</label>
                        <input id="password" type="password" name="password" autocomplete="new-password" required minlength="8" placeholder="Minimal 8 karakter">
                        @error('password')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="password_confirmation">Ulangi kata sandi</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" autocomplete="new-password" required placeholder="Ulangi kata sandi">
                    </div>

                    <button class="login-submit" type="submit">
                        Daftar
                        <x-icon name="arrow-right" width="15" height="15" />
                    </button>
                </form>

                <div class="login-card-foot">
                    <p>Sudah punya akun? <a href="{{ route('admin.login') }}">Masuk</a></p>
                </div>
            </div>

            <a class="login-back" href="{{ route('home') }}">Kembali ke halaman publik</a>
        </section>
    </div>
</body>
</html>
