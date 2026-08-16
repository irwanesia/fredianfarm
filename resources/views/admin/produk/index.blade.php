@extends('layouts.admin')

@section('title', 'Produk')

@section('page-header-left')
    <div class="text-secondary" style="font-size:.9rem">{{ $produks->total() }} produk terdaftar</div>
@endsection

@section('page-actions')
    <a href="{{ route('admin.produk.create') }}" class="btn btn-sm text-white" style="background:var(--brand-green)">
        <i class="ti ti-plus me-1"></i>
        Tambah Produk
    </a>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-vcenter card-table">
                    <thead>
                        <tr>
                            <th class="w-1">No</th>
                            <th>Nama</th>
                            <th>Jenis</th>
                            <th>Varietas</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Status</th>
                            <th class="w-1">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($produks as $produk)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <div class="fw-semibold">{{ $produk->nama }}</div>
                                    <div class="text-secondary text-truncate" style="max-width: 250px;">
                                        <code>{{ $produk->slug }}</code>
                                    </div>
                                </td>
                                <td>
                                    @if ($produk->jenis)
                                        <span class="badge bg-azure-lt">{{ $produk->jenis }}</span>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if ($produk->varietas)
                                        <span class="badge bg-indigo-lt">{{ $produk->varietas }}</span>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ $produk->kategori->nama ?? '-' }}</td>
                                <td>{{ $produk->harga ? 'Rp ' . number_format($produk->harga, 0, ',', '.') : '-' }}</td>
                                <td>
                                    @switch($produk->stok_status)
                                        @case('tersedia') <span class="badge bg-success text-dark">Tersedia</span> @break
                                        @case('terbatas') <span class="badge bg-warning text-white">Terbatas</span> @break
                                        @case('habis') <span class="badge bg-danger text-white">Habis</span> @break
                                        @default <span class="badge bg-secondary text-white">-</span>
                                    @endswitch
                                </td>
                                <td>
                                    @if ($produk->is_active)
                                        <span class="badge bg-success text-white">Aktif</span>
                                    @else
                                        <span class="badge bg-secondary text-dark">Nonaktif</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.produk.edit', $produk) }}" class="btn btn-icon btn-sm" title="Edit">
                                            <i class="ti ti-pencil"></i>
                                        </a>
                                        <form method="POST" action="{{ route('admin.produk.destroy', $produk) }}" onsubmit="return confirm('Yakin ingin menghapus produk ini?')" class="d-inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-icon btn-sm text-danger" title="Hapus">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-secondary py-4">Belum ada produk.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if ($produks->hasPages())
            <div class="card-footer">
                {{ $produks->links() }}
            </div>
        @endif
    </div>
@endsection
