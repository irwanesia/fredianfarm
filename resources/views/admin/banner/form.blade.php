@extends('layouts.admin')

@section('title', isset($banner) ? 'Edit Banner' : 'Tambah Banner')

@section('content')
    <form method="POST" action="{{ isset($banner) ? route('admin.banner.update', $banner) : route('admin.banner.store') }}">
        @csrf
        @if (isset($banner)) @method('PUT') @endif

        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ isset($banner) ? 'Edit Banner' : 'Tambah Banner' }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label required">Judul</label>
                            <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror"
                                value="{{ old('judul', $banner->judul ?? '') }}" required>
                            @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" rows="3" class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $banner->deskripsi ?? '') }}</textarea>
                            @error('deskripsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">URL Gambar</label>
                            <input type="text" name="url" class="form-control @error('url') is-invalid @enderror"
                                value="{{ old('url', $banner->url ?? '') }}" placeholder="/storage/...">
                            <small class="form-hint">Path atau URL gambar banner. Ukuran ideal 1920×800 px (rasio 16:7). Area penting di tengah–kanan karena teks menutupi kiri.</small>
                            @error('url') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Link URL</label>
                            <input type="text" name="link_url" class="form-control @error('link_url') is-invalid @enderror"
                                value="{{ old('link_url', $banner->link_url ?? '') }}" placeholder="https://...">
                            <small class="form-hint">URL tujuan tombol utama, contoh: https://example.com</small>
                            @error('link_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Teks Tombol Utama</label>
                            <input type="text" name="link_text" class="form-control @error('link_text') is-invalid @enderror"
                                value="{{ old('link_text', $banner->link_text ?? '') }}" placeholder="Lihat Selengkapnya">
                            <small class="form-hint">Teks yang tampil di tombol utama. Kosongkan untuk default &ldquo;Lihat Selengkapnya&rdquo;.</small>
                            @error('link_text') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Link URL Tombol Kedua (opsional)</label>
                            <input type="text" name="link_url_2" class="form-control @error('link_url_2') is-invalid @enderror"
                                value="{{ old('link_url_2', $banner->link_url_2 ?? '') }}" placeholder="https://...">
                            <small class="form-hint">Tombol kedua di slider (misal Cara Pemesanan). Kosongkan jika tidak perlu.</small>
                            @error('link_url_2') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Teks Tombol Kedua</label>
                            <input type="text" name="link_text_2" class="form-control @error('link_text_2') is-invalid @enderror"
                                value="{{ old('link_text_2', $banner->link_text_2 ?? '') }}" placeholder="Cara Pemesanan">
                            @error('link_text_2') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Urutan</label>
                            <input type="number" name="urutan" class="form-control @error('urutan') is-invalid @enderror"
                                value="{{ old('urutan', $banner->urutan ?? '') }}">
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
                                    {{ old('is_active', $banner->is_active ?? false) ? 'checked' : '' }}>
                                <span class="form-check-label">Aktif</span>
                            </label>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                {{ isset($banner) ? 'Simpan Perubahan' : 'Simpan' }}
                            </button>
                            <a href="{{ route('admin.banner.index') }}" class="btn btn-outline-secondary">Batal</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
