@extends('layouts.admin')

@section('title', 'Media Sosial')

@section('page-header-left')
    <div class="text-secondary" style="font-size:.9rem">{{ $medias->total() }} media sosial</div>
@endsection

@section('page-actions')
    <a href="{{ route('admin.media-sosial.create') }}" class="btn btn-sm text-white" style="background:var(--brand-green)">
        <i class="ti ti-plus me-1"></i>
        Tambah Media Sosial
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
                            <th>Platform</th>
                            <th>URL</th>
                            <th>Urutan</th>
                            <th>Status</th>
                            <th class="w-1">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($medias as $media)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @php
                                        $platformColors = [
                                            'WhatsApp' => 'bg-success',
                                            'Instagram' => 'bg-info',
                                            'YouTube' => 'bg-danger',
                                            'Facebook' => 'bg-primary',
                                            'TikTok' => 'bg-dark',
                                            'Twitter' => 'bg-info',
                                        ];
                                        $color = $platformColors[$media->platform] ?? 'bg-secondary';
                                    @endphp
                                    <span class="badge {{ $color }} text-white">{{ $media->platform }}</span>
                                </td>
                                <td>
                                    <div class="text-truncate" style="max-width: 250px;">
                                        {{ $media->url }}
                                    </div>
                                </td>
                                <td>{{ $media->urutan }}</td>
                                <td>
                                    @if ($media->is_active)
                                        <span class="badge bg-success text-white">Aktif</span>
                                    @else
                                        <span class="badge bg-secondary text-dark">Nonaktif</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.media-sosial.edit', $media) }}" class="btn btn-icon btn-sm" title="Edit">
                                            <i class="ti ti-pencil"></i>
                                        </a>
                                        <form method="POST" action="{{ route('admin.media-sosial.destroy', $media) }}" onsubmit="return confirm('Yakin ingin menghapus media sosial ini?')" class="d-inline">
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
                                <td colspan="6" class="text-center text-secondary py-4">Belum ada media sosial.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
