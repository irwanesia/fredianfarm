@extends('layouts.admin')

@section('title', 'Galeri')

@section('page-header-left')
    <div class="text-secondary" style="font-size:.9rem">{{ $galeris->total() }} foto</div>
@endsection

@section('page-actions')
    <a href="{{ route('admin.galeri.create') }}" class="btn btn-sm text-white" style="background:var(--brand-green)">
        <i class="ti ti-plus me-1"></i>
        Tambah Galeri
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
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Gambar</th>
                            <th>Urutan</th>
                            <th>Status</th>
                            <th class="w-1">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($galeris as $galeri)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $galeri->judul }}</td>
                                <td>{{ $galeri->kategori ?? '-' }}</td>
                                <td>
                                    @if ($galeri->url)
                                        <img src="{{ $galeri->url }}" alt="{{ $galeri->judul }}" class="img-thumbnail" style="max-height: 50px;">
                                    @else
                                        <span class="text-secondary">-</span>
                                    @endif
                                </td>
                                <td>{{ $galeri->urutan }}</td>
                                <td>
                                    @if ($galeri->is_active)
                                        <span class="badge bg-success text-white">Aktif</span>
                                    @else
                                        <span class="badge bg-secondary text-dark">Nonaktif</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.galeri.edit', $galeri) }}" class="btn btn-icon btn-sm" title="Edit">
                                            <i class="ti ti-pencil"></i>
                                        </a>
                                        <form method="POST" action="{{ route('admin.galeri.destroy', $galeri) }}" onsubmit="return confirm('Yakin ingin menghapus galeri ini?')" class="d-inline">
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
                                <td colspan="7" class="text-center text-secondary py-4">Belum ada galeri.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
