@extends('layouts.admin')
@section('title', 'Pengguna')
@section('page-header-left')
    <div class="text-secondary" style="font-size:.9rem">{{ $penggunas->total() }} pengguna admin</div>
@endsection
@section('page-actions')
    <a href="{{ route('admin.pengguna.create') }}" class="btn btn-sm text-white" style="background:var(--brand-green)"><i class="ti ti-plus me-1"></i>Tambah Pengguna</a>
@endsection
@section('content')
<div class="card">
    <div class="table-responsive">
        <table class="table table-vcenter card-table">
            <thead>
                <tr><th>Nama</th><th>Email</th><th>Role</th><th>Status</th><th class="w-1">Aksi</th></tr>
            </thead>
            <tbody>
                @forelse ($penggunas as $u)
                <tr>
                    <td class="d-flex align-items-center gap-2">
                        <span class="avatar avatar-sm" style="background:var(--brand-soft);color:var(--brand-green)">{{ substr($u->name, 0, 2) }}</span>
                        <span style="font-weight:600">{{ $u->name }}</span>
                    </td>
                    <td class="text-secondary">{{ $u->email }}</td>
                    <td>
                        @if ($u->isAdmin())
                            <span class="badge bg-purple-lt">Super Admin</span>
                        @else
                            <span class="badge bg-blue-lt">Editor</span>
                        @endif
                    </td>
                    <td><span class="badge bg-green-lt">Aktif</span></td>
                    <td>
                        <div class="btn-list flex-nowrap">
                            <a href="{{ route('admin.pengguna.edit', $u) }}" class="btn btn-icon btn-sm" title="Edit"><i class="ti ti-pencil"></i></a>
                            <form method="POST" action="{{ route('admin.pengguna.destroy', $u) }}" onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-icon btn-sm text-danger" title="Hapus"><i class="ti ti-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-secondary py-4">Belum ada pengguna.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if ($penggunas->hasPages())
    <div class="card-footer">{{ $penggunas->links() }}</div>
    @endif
</div>
@endsection
