@extends('admin.layout')

@section('title', 'Akun saya')
@section('page_label', 'Akun')
@section('page_name', 'Akun saya')

@section('content')
    <div class="page-heading">
        <h1>Akun saya</h1>
        <p>Ganti kata sandi panel admin. Minimal 10 karakter. Gunakan kata sandi yang tidak dipakai di layanan lain.</p>
    </div>

    <div style="display:grid;grid-template-columns:minmax(0,560px);gap:20px">
        <form method="POST" action="{{ route('admin.account.update') }}" novalidate>
            @csrf

            <div class="card" style="margin-bottom:20px">
                <div class="card-head">
                    <div>
                        <h2>Informasi akun</h2>
                        <p>{{ auth()->user()->email }}</p>
                    </div>
                </div>
                <div class="form-grid" style="grid-template-columns:1fr">
                    <div class="field">
                        <label for="account-name">Nama</label>
                        <input id="account-name" type="text" value="{{ auth()->user()->name }}" disabled>
                        <p class="field-help">Nama akun diatur saat instalasi.</p>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-head">
                    <div>
                        <h2>Ganti kata sandi</h2>
                        <p>Diperlukan verifikasi kata sandi saat ini.</p>
                    </div>
                </div>
                <div class="form-grid" style="grid-template-columns:1fr">
                    <div class="field">
                        <label for="current_password">Kata sandi saat ini <span class="req">*</span></label>
                        <input id="current_password" type="password" name="current_password" autocomplete="current-password" required>
                        @error('current_password')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="field">
                        <label for="password">Kata sandi baru <span class="req">*</span></label>
                        <input id="password" type="password" name="password" autocomplete="new-password" required>
                        <p class="field-help">Minimal 10 karakter.</p>
                        @error('password')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="field">
                        <label for="password_confirmation">Ulangi kata sandi baru <span class="req">*</span></label>
                        <input id="password_confirmation" type="password" name="password_confirmation" autocomplete="new-password" required>
                    </div>
                </div>
                <div class="form-actions">
                    <span class="helper">Setelah disimpan, sesi tetap aktif di perangkat ini.</span>
                    <button class="btn btn--primary" type="submit">
                        <x-icon name="save" />
                        Simpan kata sandi
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
