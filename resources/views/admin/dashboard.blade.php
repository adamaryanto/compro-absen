@extends('admin.layout')

@section('title', 'Ringkasan')
@section('page_label', 'Panel admin')
@section('page_name', 'Ringkasan')

@section('content')
    <div class="page-heading">
        <h1>Selamat datang, {{ auth()->user()->name }}.</h1>
        <p>Semua konten halaman publik dikelola dari panel ini. Perubahan disimpan ke database dan langsung terlihat saat halaman dimuat ulang.</p>
    </div>

    <div class="dash-grid">
        @php
            $cards = [
                ['key' => 'keunggulan', 'label' => 'Keunggulan', 'desc' => 'Kartu benefit di halaman', 'icon' => 'layers'],
                ['key' => 'modul', 'label' => 'Modul', 'desc' => 'Daftar modul sistem', 'icon' => 'layers'],
                ['key' => 'langkah', 'label' => 'Langkah', 'desc' => 'Alur kerja di halaman', 'icon' => 'clock'],
                ['key' => 'faq', 'label' => 'FAQ', 'desc' => 'Pertanyaan & jawaban', 'icon' => 'help-circle'],
                ['key' => 'statistik', 'label' => 'Statistik', 'desc' => 'Angka ringkas di halaman', 'icon' => 'chart'],
            ];
        @endphp

        @foreach ($cards as $card)
            <a class="dash-card" href="{{ route('admin.collection.index', $card['key']) }}">
                <div class="dash-card-top">
                    <span>{{ $card['label'] }}</span>
                    <x-icon :name="$card['icon']" />
                </div>
                <span class="dash-value">{{ $counts[$card['key']] }}</span>
                <p>{{ $card['desc'] }}</p>
            </a>
        @endforeach
    </div>

    <div class="dash-panels">
        <div class="card">
            <div class="card-head">
                <div>
                    <h2>Konten halaman</h2>
                    <p>Bagian yang bisa diubah tanpa menyentuh kode.</p>
                </div>
            </div>
            <div class="dash-list">
                <a href="{{ route('admin.settings.edit') }}">
                    <strong>Teks hero &amp; identitas</strong>
                    <span>Buka</span>
                </a>
                <a href="{{ route('admin.settings.edit') }}">
                    <strong>Judul setiap bagian</strong>
                    <span>Buka</span>
                </a>
                <a href="{{ route('admin.appearance.edit') }}">
                    <strong>Warna &amp; logo</strong>
                    <span>Buka</span>
                </a>
                <a href="{{ route('admin.account.edit') }}">
                    <strong>Kata sandi akun</strong>
                    <span>Buka</span>
                </a>
            </div>
        </div>

        <div class="card">
            <div class="card-head">
                <h2>Status situs</h2>
            </div>
            <div class="dash-meta">
                <dl>
                    <dt>Alamat publik</dt>
                    <dd><a href="{{ route('home') }}" target="_blank" rel="noopener">{{ route('home') }}</a></dd>

                    <dt>Terakhir diubah</dt>
                    <dd>{{ $updatedAt ? \Illuminate\Support\Carbon::parse($updatedAt)->translatedFormat('d M Y, H:i') : 'Belum ada perubahan' }}</dd>

                    <dt>Palet aktif</dt>
                    <dd>
                        <div class="palette-chips">
                            <span style="background: {{ csetting('color_primary') }}" title="Primer"></span>
                            <span style="background: {{ csetting('color_primary_dark') }}" title="Gelap"></span>
                            <span style="background: {{ csetting('color_accent') }}" title="Aksen"></span>
                            <span style="background: {{ csetting('color_ink') }}" title="Tinta"></span>
                            <span style="background: {{ csetting('color_paper') }}" title="Latar"></span>
                        </div>
                    </dd>

                    <dt>URL aplikasi absen (referensi)</dt>
                    <dd>{{ csetting('app_url') }}</dd>
                </dl>
            </div>
        </div>
    </div>
@endsection
