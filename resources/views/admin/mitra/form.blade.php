@extends('layouts.admin')

@section('title', isset($mitra) ? 'Edit Mitra' : 'Tambah Mitra')

@section('content')
    <form method="POST" action="{{ isset($mitra) ? route('admin.mitra.update', $mitra) : route('admin.mitra.store') }}">
        @csrf
        @if (isset($mitra)) @method('PUT') @endif

        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ isset($mitra) ? 'Edit Mitra' : 'Tambah Mitra' }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label required">Nama Mitra</label>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                                value="{{ old('nama', $mitra->nama ?? '') }}" required placeholder="Contoh: Gapoktan Dieng">
                            @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Urutan</label>
                            <input type="number" name="urutan" class="form-control @error('urutan') is-invalid @enderror"
                                value="{{ old('urutan', $mitra->urutan ?? '') }}">
                            @error('urutan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Pengaturan</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-check">
                                <input type="checkbox" name="is_active" class="form-check-input" value="1"
                                    {{ old('is_active', $mitra->is_active ?? true) ? 'checked' : '' }}>
                                <span class="form-check-label">Aktif</span>
                            </label>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                {{ isset($mitra) ? 'Simpan Perubahan' : 'Simpan' }}
                            </button>
                            <a href="{{ route('admin.mitra.index') }}" class="btn btn-outline-secondary">Batal</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
