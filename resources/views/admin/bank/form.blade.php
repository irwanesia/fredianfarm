@extends('layouts.admin')
@section('title', isset($bank) ? 'Edit Bank' : 'Tambah Bank')
@section('page-header-left')
  <h3 style="margin:0;font-size:1.2rem">{{ isset($bank) ? 'Edit Bank' : 'Tambah Bank' }}</h3>
@endsection
@section('content')
<div class="row">
  <div class="col-md-6">
    <div class="card">
      <div class="card-body">
        <form method="POST" action="{{ isset($bank) ? route('admin.banks.update', $bank) : route('admin.banks.store') }}">
          @csrf
          @if(isset($bank)) @method('PUT') @endif

          <div class="mb-3">
            <label class="form-label">Nama Bank <span class="text-danger">*</span></label>
            <input type="text" name="bank_name" class="form-control @error('bank_name') is-invalid @enderror"
              value="{{ old('bank_name', $bank->bank_name ?? '') }}" placeholder="BCA / BRI / Mandiri" required>
            @error('bank_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="mb-3">
            <label class="form-label">Nomor Rekening <span class="text-danger">*</span></label>
            <input type="text" name="account_number" class="form-control @error('account_number') is-invalid @enderror"
              value="{{ old('account_number', $bank->account_number ?? '') }}" placeholder="1234 5678 90" required>
            @error('account_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="mb-3">
            <label class="form-label">Atas Nama <span class="text-danger">*</span></label>
            <input type="text" name="account_holder" class="form-control @error('account_holder') is-invalid @enderror"
              value="{{ old('account_holder', $bank->account_holder ?? '') }}" placeholder="Nama Pemilik Rekening" required>
            @error('account_holder') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="row g-2 mb-3">
            <div class="col-6">
              <label class="form-label">Ikon</label>
              <input type="text" name="icon" class="form-control @error('icon') is-invalid @enderror"
                value="{{ old('icon', $bank->icon ?? '🏦') }}" placeholder="🏦">
            </div>
            <div class="col-6">
              <label class="form-label">Warna Latar</label>
              <input type="text" name="bg_color" class="form-control @error('bg_color') is-invalid @enderror"
                value="{{ old('bg_color', $bank->bg_color ?? '#DBEAFE') }}" placeholder="#DBEAFE">
            </div>
          </div>

          <div class="mb-4">
            <label class="form-check">
              <input type="checkbox" name="is_active" class="form-check-input" value="1"
                {{ old('is_active', $bank->is_active ?? true) ? 'checked' : '' }}>
              <span class="form-check-label">Aktif</span>
            </label>
          </div>

          <div style="display:flex;gap:8px">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.banks.index') }}" class="btn btn-ghost">Batal</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
