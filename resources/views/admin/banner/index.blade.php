@extends('layouts.admin')

@section('title', 'Banner')

@section('page-header-left')
    <div class="text-secondary" style="font-size:.9rem">{{ $banners->total() }} banner hero</div>
@stop

@section('page-actions')
    <a href="{{ route('admin.banner.create') }}" class="btn btn-sm text-white" style="background:var(--brand-green)">
        <i class="ti ti-plus me-1"></i>
        Tambah Banner
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
                            <th>Gambar</th>
                            <th>Link URL</th>
                            <th>Urutan</th>
                            <th>Status</th>
                            <th class="w-1">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($banners as $banner)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $banner->judul }}</td>
                                <td>
                                    @if ($banner->media_type === 'video' && $banner->url)
                                        <span class="badge bg-purple-lt me-1">Video</span>
                                        <video src="{{ $banner->url }}" muted controls style="max-height:50px;border-radius:6px;display:block;margin-top:4px"></video>
                                    @elseif ($banner->url)
                                        <span class="badge bg-green-lt me-1">Gambar</span>
                                        <img src="{{ $banner->url }}" alt="{{ $banner->judul }}" class="img-thumbnail" style="max-height:50px;margin-top:4px">
                                    @else
                                        <span class="text-secondary">-</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="text-truncate" style="max-width: 200px;">
                                        {{ $banner->link_url ?? '-' }}
                                    </div>
                                </td>
                                <td>{{ $banner->urutan }}</td>
                                <td>
                                    @if ($banner->is_active)
                                        <span class="badge bg-success text-white">Aktif</span>
                                    @else
                                        <span class="badge bg-secondary text-dark">Nonaktif</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.banner.edit', $banner) }}" class="btn btn-icon btn-sm" title="Edit">
                                            <i class="ti ti-pencil"></i>
                                        </a>
                                        <form method="POST" action="{{ route('admin.banner.destroy', $banner) }}" onsubmit="return confirm('Yakin ingin menghapus banner ini?')" class="d-inline">
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
                                <td colspan="7" class="text-center text-secondary py-4">Belum ada banner.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
