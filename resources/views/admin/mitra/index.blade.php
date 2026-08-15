@extends('layouts.admin')

@section('title', 'Mitra')

@section('page-header-left')
    <div class="text-secondary" style="font-size:.9rem">{{ $mitras->total() }} mitra</div>
@endsection

@section('page-actions')
    <a href="{{ route('admin.mitra.create') }}" class="btn btn-sm text-white" style="background:var(--brand-green)">
        <i class="ti ti-plus me-1"></i>
        Tambah Mitra
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
                            <th>Urutan</th>
                            <th>Status</th>
                            <th class="w-1">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($mitras as $mitra)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $mitra->nama }}</td>
                                <td>{{ $mitra->urutan }}</td>
                                <td>
                                    @if ($mitra->is_active)
                                        <span class="badge bg-success text-white">Aktif</span>
                                    @else
                                        <span class="badge bg-secondary text-dark">Nonaktif</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.mitra.edit', $mitra) }}" class="btn btn-icon btn-sm" title="Edit">
                                            <i class="ti ti-pencil"></i>
                                        </a>
                                        <form method="POST" action="{{ route('admin.mitra.destroy', $mitra) }}" onsubmit="return confirm('Yakin ingin menghapus mitra ini?')" class="d-inline">
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
                                <td colspan="5" class="text-center text-secondary py-4">Belum ada mitra.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $mitras->links() }}
            </div>
        </div>
    </div>
@endsection
