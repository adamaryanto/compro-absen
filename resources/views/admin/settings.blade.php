@extends('admin.layout')

@section('title', 'Konten halaman')
@section('page_label', 'Halaman')
@section('page_name', 'Konten halaman')

@section('content')
    <div class="page-heading">
        <h1>Konten halaman</h1>
        <p>Teks di halaman publik. Setiap tab mewakili satu bagian; perubahan berlaku setelah tombol simpan ditekan.</p>
    </div>

    <form method="POST" action="{{ route('admin.settings.update') }}" novalidate>
        @csrf

        <div class="tabs" role="tablist" aria-label="Bagian konten">
            @foreach ($groups as $groupKey => $group)
                <button class="tab {{ $loop->first ? 'is-active' : '' }}" type="button" role="tab"
                        data-tab="{{ $groupKey }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                    {{ $group['label'] }}
                </button>
            @endforeach
        </div>

        @foreach ($groups as $groupKey => $group)
            <section class="card tab-panel {{ $loop->first ? 'is-active' : '' }}" data-panel="{{ $groupKey }}" role="tabpanel">
                <div class="tab-panel-head">
                    <h2>{{ $group['label'] }}</h2>
                    <p>{{ $group['hint'] }}</p>
                </div>

                <div class="form-grid">
                    @foreach ($group['fields'] as $key => $field)
                        @include('admin.partials.field', [
                            'name' => $key,
                            'field' => $field,
                            'value' => csetting($key),
                        ])
                    @endforeach
                </div>
            </section>
        @endforeach

        <div class="form-actions" style="margin-top:20px;border:1px solid var(--a-line);border-radius:8px">
            <span class="helper">Konten disimpan ke basis data. Halaman publik langsung memakai nilai terbaru.</span>
            <a class="btn btn--ghost" href="{{ route('home') }}" target="_blank" rel="noopener">
                <x-icon name="eye" />
                Pratinjau
            </a>
            <button class="btn btn--primary" type="submit">
                <x-icon name="save" />
                Simpan konten
            </button>
        </div>
    </form>
@endsection
