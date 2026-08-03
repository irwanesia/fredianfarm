@extends('layouts.admin')
@section('title', 'Bank Transfer')
@section('page-header-left')
  <h3 style="margin:0;font-size:1.2rem">Bank Transfer</h3>
@endsection
@section('page-actions')
  <a href="{{ route('admin.banks.create') }}" class="btn btn-primary btn-sm">+ Tambah Bank</a>
@endsection
@section('content')
<div class="card">
  <div class="table-responsive">
    <table class="table table-vcenter card-table">
      <thead>
        <tr>
          <th>Bank</th>
          <th>Nomor Rekening</th>
          <th>Atas Nama</th>
          <th>Status</th>
          <th class="w-1"></th>
        </tr>
      </thead>
      <tbody>
        @forelse($banks as $b)
        <tr>
          <td>
            <div style="display:flex;align-items:center;gap:10px">
              <span style="font-size:24px">{{ $b->icon }}</span>
              <strong>{{ $b->bank_name }}</strong>
            </div>
          </td>
          <td style="font-family:monospace;font-size:14px">{{ $b->account_number }}</td>
          <td>{{ $b->account_holder }}</td>
          <td>
            <span class="badge {{ $b->is_active ? 'bg-green-lt' : 'bg-secondary-lt' }}">
              {{ $b->is_active ? 'Aktif' : 'Nonaktif' }}
            </span>
          </td>
          <td>
            <div class="btn-group btn-group-sm">
              <a href="{{ route('admin.banks.edit', $b) }}" class="btn btn-icon btn-sm" title="Edit">
                <i class="ti ti-pencil"></i>
              </a>
              <form method="POST" action="{{ route('admin.banks.destroy', $b) }}" onsubmit="return confirm('Yakin ingin menghapus bank {{ $b->bank_name }}?')" class="d-inline">
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
          <td colspan="5">
            <div style="text-align:center;padding:60px 0;color:var(--tblr-secondary)">
              <div style="font-size:40px;margin-bottom:12px">🏦</div>
              <div style="font-weight:600;margin-bottom:4px">Belum ada bank</div>
              <div style="font-size:13px">Tambahkan rekening untuk konfirmasi pembayaran via WA.</div>
            </div>
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
