@extends('layouts.admin')

@section('title', isset($kategoriArtikel) ? 'Edit Kategori Artikel' : 'Tambah Kategori Artikel')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ isset($kategoriArtikel) ? route('admin.kategori-artikel.update', $kategoriArtikel) : route('admin.kategori-artikel.store') }}">
                        @csrf
                        @if (isset($kategoriArtikel)) @method('PUT') @endif

                        <div class="mb-3">
                            <label class="form-label required">Nama Kategori</label>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                                value="{{ old('nama', $kategoriArtikel->nama ?? '') }}" required>
                            @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" rows="3" class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $kategoriArtikel->deskripsi ?? '') }}</textarea>
                            @error('deskripsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Urutan</label>
                            <input type="number" name="urutan" class="form-control @error('urutan') is-invalid @enderror"
                                value="{{ old('urutan', $kategoriArtikel->urutan ?? '') }}">
                            @error('urutan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-check">
                                <input type="checkbox" name="is_active" class="form-check-input" value="1"
                                    {{ old('is_active', $kategoriArtikel->is_active ?? true) ? 'checked' : '' }}>
                                <span class="form-check-label">Aktif</span>
                            </label>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                {{ isset($kategoriArtikel) ? 'Simpan Perubahan' : 'Simpan' }}
                            </button>
                            <a href="{{ route('admin.kategori-artikel.index') }}" class="btn btn-outline-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
