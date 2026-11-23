@extends('admin.layout')

@section('title', ($item->exists ? 'Edit ' : 'Tambah ') . $definition['singular'])
@section('page_label', 'Konten · ' . $definition['label'])
@section('page_name', ($item->exists ? 'Edit ' : 'Tambah ') . $definition['singular'])

@section('content')
    <div class="page-heading">
        <h1>{{ $item->exists ? 'Edit' : 'Tambah' }} {{ $definition['singular'] }}</h1>
        <p><a href="{{ route('admin.collection.index', $type) }}">Kembali ke daftar {{ $definition['label'] }}</a></p>
    </div>

    <form method="POST" action="{{ $item->exists ? route('admin.collection.update', [$type, $item->id]) : route('admin.collection.store', $type) }}" novalidate>
        @csrf
        @if ($item->exists)
            @method('PUT')
        @endif

        <div class="card">
            <div class="form-grid">
                @foreach ($definition['fields'] as $fieldName => $field)
                    @include('admin.partials.field', [
                        'name' => $fieldName,
                        'field' => $field,
                        'value' => $item->{$fieldName},
                    ])
                @endforeach
            </div>

            <div class="form-actions">
                <span class="helper">Field bertanda * wajib diisi.</span>
                <a class="btn btn--ghost" href="{{ route('admin.collection.index', $type) }}">Batal</a>
                <button class="btn btn--primary" type="submit">
                    <x-icon name="save" />
                    {{ $item->exists ? 'Simpan perubahan' : 'Tambah data' }}
                </button>
            </div>
        </div>
    </form>
@endsection
