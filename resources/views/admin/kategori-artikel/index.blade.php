@extends('layouts.admin')

@section('title', 'Kategori Artikel')

@section('page-header-left')
    <div class="text-secondary" style="font-size:.9rem">{{ $kategoris->total() }} kategori blog</div>
@endsection

@section('page-actions')
    <a href="{{ route('admin.kategori-artikel.create') }}" class="btn btn-sm text-white" style="background:var(--brand-green)">
        <i class="ti ti-plus me-1"></i>
        Tambah Kategori
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
                            <th>Slug</th>
                            <th>Urutan</th>
                            <th>Status</th>
                            <th>Jumlah Artikel</th>
                            <th class="w-1">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kategoris as $kategori)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $kategori->nama }}</td>
                                <td><code>{{ $kategori->slug }}</code></td>
                                <td>{{ $kategori->urutan ?? '-' }}</td>
                                <td>
                                    @if ($kategori->is_active)
                                        <span class="badge bg-success text-white">Aktif</span>
                                    @else
                                        <span class="badge bg-secondary text-dark">Nonaktif</span>
                                    @endif
                                </td>
                                <td>{{ $kategori->artikels_count ?? $kategori->artikels()->count() }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.kategori-artikel.edit', $kategori) }}" class="btn btn-icon btn-sm" title="Edit">
                                            <i class="ti ti-pencil"></i>
                                        </a>
                                        <form method="POST" action="{{ route('admin.kategori-artikel.destroy', $kategori) }}" onsubmit="return confirm('Yakin ingin menghapus?')" class="d-inline">
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
                                <td colspan="7" class="text-center text-secondary py-4">Belum ada kategori artikel.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if ($kategoris->hasPages())
            <div class="card-footer">
                {{ $kategoris->links() }}
            </div>
        @endif
    </div>
@endsection
