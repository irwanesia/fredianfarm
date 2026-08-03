@extends('layouts.admin')

@section('title', 'Artikel')

@section('page-header-left')
    <div class="text-secondary" style="font-size:.9rem">{{ $artikels->total() }} artikel</div>
@endsection

@section('page-actions')
    <a href="{{ route('admin.artikel.create') }}" class="btn btn-sm text-white" style="background:var(--brand-green)">
        <i class="ti ti-plus me-1"></i>
        Tambah Artikel
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
                            <th>Penulis</th>
                            <th>Status</th>
                            <th>AI</th>
                            <th>Tanggal</th>
                            <th class="w-1">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($artikels as $artikel)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <div class="fw-semibold">{{ $artikel->judul }}</div>
                                    <div class="text-secondary text-truncate" style="max-width: 250px;">
                                        <code>{{ $artikel->slug }}</code>
                                    </div>
                                </td>
                                <td>{{ $artikel->kategori->nama ?? '-' }}</td>
                                <td>{{ $artikel->user->name ?? '-' }}</td>
                                <td>
                                    @if ($artikel->is_published)
                                        <span class="badge bg-success text-white">Published</span>
                                    @else
                                        <span class="badge bg-secondary text-dark">Draft</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($artikel->ai_generated)
                                        <span class="badge bg-info text-dark">AI</span>
                                    @else
                                        <span class="badge bg-secondary text-white">Manual</span>
                                    @endif
                                </td>
                                <td>{{ $artikel->published_at ? $artikel->published_at->format('d M Y') : '-' }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.artikel.edit', $artikel) }}" class="btn btn-icon btn-sm" title="Edit">
                                            <i class="ti ti-pencil"></i>
                                        </a>
                                        <form method="POST" action="{{ route('admin.artikel.destroy', $artikel) }}" onsubmit="return confirm('Yakin ingin menghapus artikel ini?')" class="d-inline">
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
                                <td colspan="8" class="text-center text-secondary py-4">Belum ada artikel.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if ($artikels->hasPages())
            <div class="card-footer">
                {{ $artikels->links() }}
            </div>
        @endif
    </div>
@endsection
