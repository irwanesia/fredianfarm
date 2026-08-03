@extends('layouts.admin')
@section('title', 'Kotak Masuk')
@section('page-header-left')
    <div class="text-secondary" style="font-size:.9rem">{{ $kontaks->total() }} pesan masuk</div>
@endsection
@section('page-actions')
    <select class="form-select form-select-sm w-auto" onchange="window.location='{{ route('admin.kontak.index') }}?status='+this.value">
        <option value="">Semua Status</option>
        <option value="baru" {{ request('status') == 'baru' ? 'selected' : '' }}>Baru</option>
        <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
        <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
    </select>
@endsection
@section('content')
<div class="card">
    <div class="table-responsive">
        <table class="table table-vcenter card-table">
            <thead>
                <tr><th>Nama</th><th>Kontak</th><th>Pesan</th><th>Tanggal</th><th>Status</th><th class="w-1">Aksi</th></tr>
            </thead>
            <tbody>
                @forelse ($kontaks as $k)
                <tr>
                    <td style="font-weight:600">{{ $k->nama }}</td>
                    <td class="text-secondary">{{ $k->no_wa ?? $k->email ?? '-' }}</td>
                    <td class="text-secondary" style="max-width:240px">{{ Str::limit($k->pesan, 60) }}</td>
                    <td class="text-secondary">{{ $k->created_at->format('d M Y') }}</td>
                    <td>
                        @if(!$k->dibaca)
                            <span class="badge bg-red-lt">Baru</span>
                        @else
                            <span class="badge bg-green-lt">Selesai</span>
                        @endif
                    </td>
                    <td>
                        <div class="btn-list flex-nowrap">
                            <form method="POST" action="{{ route('admin.kontak.toggle', $k) }}" class="d-inline">
                                @csrf @method('PATCH')
                                <button type="submit" class="btn btn-icon btn-sm" title="{{ $k->dibaca ? 'Tandai Baru' : 'Tandai Selesai' }}">
                                    <i class="ti ti-{{ $k->dibaca ? 'mail' : 'mail-opened' }}"></i>
                                </button>
                            </form>
                            <form method="POST" action="{{ route('admin.kontak.destroy', $k) }}" onsubmit="return confirm('Yakin ingin menghapus?')" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-icon btn-sm text-danger" title="Hapus"><i class="ti ti-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-secondary py-4">Belum ada pesan masuk.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if ($kontaks->hasPages())
    <div class="card-footer">{{ $kontaks->appends(['status' => request('status')])->links() }}</div>
    @endif
</div>
@endsection
