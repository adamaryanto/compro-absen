@extends('admin.layout')

@section('title', 'Tampilan')
@section('page_label', 'Halaman')
@section('page_name', 'Tampilan & warna')

@section('content')
    <div class="page-heading">
        <h1>Tampilan &amp; warna</h1>
        <p>Palet dipakai sebagai variabel CSS di seluruh halaman publik. Pilih warna yang tetap kontras dengan teks putih dan aksen biru.</p>
    </div>

    <form method="POST" action="{{ route('admin.appearance.update') }}" enctype="multipart/form-data" novalidate>
        @csrf

        <div class="appearance-grid">
            <div>
                <div class="card" style="margin-bottom:20px">
                    <div class="card-head">
                        <div>
                            <h2>Logo</h2>
                            <p>Ditampilkan di header, footer, dan panel admin.</p>
                        </div>
                    </div>

                    <div class="logo-row">
                        <div class="logo-preview">
                            <img src="{{ cmedia(csetting('logo_path')) }}" alt="Logo saat ini" width="76" height="76">
                        </div>
                        <div class="logo-copy">
                            <p>PNG, JPG, WEBP, atau SVG. Maksimal 2 MB. Rasio persegi paling aman.</p>
                            <label class="file-input">
                                <x-icon name="image" />
                                Pilih file logo
                                <input type="file" name="logo" accept="image/png,image/jpeg,image/webp,image/svg+xml">
                            </label>
                            @error('logo')
                                <p class="field-error">{{ $message }}</p>
                            @enderror
                            <label class="check-inline">
                                <input type="checkbox" name="remove_logo" value="1">
                                Hapus logo, kembali ke bawaan
                            </label>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-head">
                        <div>
                            <h2>Warna</h2>
                            <p>Tujuh token warna mengatur seluruh halaman.</p>
                        </div>
                    </div>

                    <div class="color-rows">
                        @foreach ($palette as $key => $color)
                            <div class="color-row" data-color-row>
                                <label for="color-{{ $key }}">{{ $color['label'] }}</label>
                                <input id="color-{{ $key }}" type="color" value="{{ csetting($key, $color['default']) }}"
                                       data-color-input data-target="hex-{{ $key }}">
                                <input id="hex-{{ $key }}" type="text" name="{{ $key }}" value="{{ strtoupper(csetting($key, $color['default'])) }}"
                                       maxlength="7" pattern="^#[0-9A-Fa-f]{6}$" data-color-hex data-preview="{{ $key }}" aria-label="Kode hex {{ $color['label'] }}">
                            </div>
                            @error($key)
                                <p class="field-error" style="margin:-4px 0 8px">{{ $message }}</p>
                            @enderror
                        @endforeach
                    </div>
                </div>
            </div>

            <aside class="card preview">
                <div class="card-head">
                    <h2>Pratinjau langsung</h2>
                </div>
                <div class="preview-toolbar">
                    <div class="preview-sizes" role="group" aria-label="Ukuran pratinjau">
                        <button type="button" class="preview-size is-active" data-preview-size="desktop" aria-pressed="true">Desktop</button>
                        <button type="button" class="preview-size" data-preview-size="mobile" aria-pressed="false">Ponsel</button>
                    </div>
                    <button type="button" class="btn btn--ghost btn--sm" id="previewReload">Muat ulang</button>
                </div>
                <div class="preview-frame">
                    <iframe id="sitePreview" src="{{ route('home') }}" title="Pratinjau halaman publik"></iframe>
                </div>
                <div class="preview-caption">Ini halaman publik yang sebenarnya. Perubahan warna langsung terlihat; klik <strong>Simpan tampilan</strong> untuk menyimpannya.</div>
            </aside>
        </div>

        <div class="form-actions" style="margin-top:20px;border:1px solid var(--a-line);border-radius:8px">
            <span class="helper">Unggah logo baru akan menggantikan logo lama.</span>
            <a class="btn btn--ghost" href="{{ route('home') }}" target="_blank" rel="noopener">
                <x-icon name="eye" />
                Pratinjau
            </a>
            <button class="btn btn--primary" type="submit">
                <x-icon name="save" />
                Simpan tampilan
            </button>
        </div>
    </form>
@endsection
