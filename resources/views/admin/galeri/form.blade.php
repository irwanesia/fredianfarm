@extends('layouts.admin')

@section('title', isset($galeri) ? 'Edit Galeri' : 'Tambah Galeri')

@section('content')
    <form method="POST" action="{{ isset($galeri) ? route('admin.galeri.update', $galeri) : route('admin.galeri.store') }}" enctype="multipart/form-data">
        @csrf
        @if (isset($galeri)) @method('PUT') @endif

        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ isset($galeri) ? 'Edit Galeri' : 'Tambah Galeri' }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label required">Judul</label>
                            <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror"
                                value="{{ old('judul', $galeri->judul ?? '') }}" required>
                            @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" rows="3" class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $galeri->deskripsi ?? '') }}</textarea>
                            @error('deskripsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kategori</label>
                            <select name="kategori" class="form-select @error('kategori') is-invalid @enderror">
                                <option value="foto_produk" {{ old('kategori', $galeri->kategori ?? 'foto_produk') == 'foto_produk' ? 'selected' : '' }}>Foto Produk</option>
                                <option value="foto_kegiatan" {{ old('kategori', $galeri->kategori ?? 'foto_produk') == 'foto_kegiatan' ? 'selected' : '' }}>Foto Kegiatan</option>
                                <option value="foto_lahan" {{ old('kategori', $galeri->kategori ?? 'foto_produk') == 'foto_lahan' ? 'selected' : '' }}>Foto Lahan</option>
                                <option value="tim" {{ old('kategori', $galeri->kategori ?? 'foto_produk') == 'tim' ? 'selected' : '' }}>Tim</option>
                                <option value="lainnya" {{ old('kategori', $galeri->kategori ?? 'foto_produk') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            <small class="form-hint">Kategori dipakai untuk filter & ikon di halaman galeri.</small>
                            @error('kategori') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Upload Gambar</label>
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"
                                accept="image/jpeg,image/png,image/webp">
                            <small class="form-hint">Pilih file gambar (JPG/PNG/WebP, maks 2MB). Gambar otomatis dikonversi ke WebP.</small>
                            @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            @if (isset($galeri) && $galeri->url)
                                <div class="mt-2">
                                    <img src="{{ $galeri->url }}" alt="{{ $galeri->judul }}" class="img-thumbnail" style="max-height:120px;">
                                    <div class="form-hint mt-1">Gambar saat ini. Upload gambar baru untuk menggantinya.</div>
                                </div>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label class="form-label">atau URL Gambar (opsional)</label>
                            <input type="text" name="url" class="form-control @error('url') is-invalid @enderror"
                                value="{{ old('url', isset($galeri) ? ($galeri->url ?? '') : '') }}" placeholder="/storage/...">
                            <small class="form-hint">Kosongkan jika sudah mengupload file gambar. Hanya untuk gambar dari URL eksternal.</small>
                            @error('url') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Urutan</label>
                            <input type="number" name="urutan" class="form-control @error('urutan') is-invalid @enderror"
                                value="{{ old('urutan', $galeri->urutan ?? '') }}">
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
                                    {{ old('is_active', $galeri->is_active ?? false) ? 'checked' : '' }}>
                                <span class="form-check-label">Aktif</span>
                            </label>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                {{ isset($galeri) ? 'Simpan Perubahan' : 'Simpan' }}
                            </button>
                            <a href="{{ route('admin.galeri.index') }}" class="btn btn-outline-secondary">Batal</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
