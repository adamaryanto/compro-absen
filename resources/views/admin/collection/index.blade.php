@extends('admin.layout')

@section('title', $definition['label'])
@section('page_label', 'Konten')
@section('page_name', $definition['label'])

@section('content')
    <div class="page-heading" style="display:flex;justify-content:space-between;align-items:flex-end;gap:20px;flex-wrap:wrap">
        <div>
            <h1>{{ $definition['label'] }}</h1>
            <p>Urutkan dengan angka kecil ke besar. Hanya data berstatus tampil yang muncul di halaman publik.</p>
        </div>
        <a class="btn btn--primary" href="{{ route('admin.collection.create', $type) }}">
            <x-icon name="plus" />
            Tambah {{ $definition['singular'] }}
        </a>
    </div>

    <div class="card">
        @if ($items->isEmpty())
            <div class="empty">
                <strong>Belum ada data.</strong>
                Tambahkan {{ $definition['singular'] }} pertama untuk ditampilkan di halaman.
            </div>
        @else
            <div class="table-wrap">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th class="col-order">Urut</th>
                            <th>{{ $definition['fields'][array_key_first($definition['fields'])]['label'] }}</th>
                            <th>Status</th>
                            <th class="col-actions">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td class="col-order">{{ str_pad($item->sort_order, 2, '0', STR_PAD_LEFT) }}</td>
                                <td>
                                    @if ($type === 'keunggulan')
                                        <span class="row-title">{{ $item->title }}</span>
                                        <span class="row-sub">{{ $item->description }}</span>
                                    @elseif ($type === 'modul')
                                        <span class="row-title">{{ $item->name }}</span>
                                        <span class="row-sub">{{ $item->description }}</span>
                                    @elseif ($type === 'langkah')
                                        <span class="row-title">{{ $item->phase }}. {{ $item->title }}</span>
                                        <span class="row-sub">{{ $item->description }}</span>
                                    @elseif ($type === 'faq')
                                        <span class="row-title">{{ $item->question }}</span>
                                        <span class="row-sub">{{ $item->answer }}</span>
                                    @else
                                        <span class="row-title">{{ $item->value }}</span>
                                        <span class="row-sub">{{ $item->label }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->is_active)
                                        <span class="badge badge--on">Tampil</span>
                                    @else
                                        <span class="badge badge--off">Disembunyikan</span>
                                    @endif
                                </td>
                                <td class="col-actions">
                                    <div class="actions">
                                        <a class="btn btn--ghost btn--sm btn--icon" href="{{ route('admin.collection.edit', [$type, $item->id]) }}" aria-label="Edit {{ $definition['singular'] }}">
                                            <x-icon name="edit" />
                                        </a>
                                        <form method="POST" action="{{ route('admin.collection.destroy', [$type, $item->id]) }}"
                                              data-confirm="Hapus data ini? Tindakan tidak bisa dibatalkan.">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn--danger btn--sm btn--icon" type="submit" aria-label="Hapus {{ $definition['singular'] }}">
                                                <x-icon name="trash" />
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
