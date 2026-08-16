@extends('layouts.admin')

@section('title', isset($banner) ? 'Edit Banner' : 'Tambah Banner')

@section('content')
    <form method="POST" action="{{ isset($banner) ? route('admin.banner.update', $banner) : route('admin.banner.store') }}" enctype="multipart/form-data">
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
                            <label class="form-label">Media Banner</label>
                            <div class="alert alert-info py-2" style="font-size:12px">
                                Pilih salah satu: <strong>gambar</strong> atau <strong>video</strong>. Saat satu dipilih, yang lain otomatis dinonaktifkan.
                            </div>

                            @if (isset($banner) && $banner->url)
                            <div class="mb-3">
                                <label class="form-label">Media Saat Ini</label>
                                @if ($banner->media_type === 'video')
                                <video src="{{ $banner->url }}" muted controls style="max-width:100%;max-height:180px;border-radius:8px;display:block"></video>
                                @else
                                <img src="{{ $banner->url }}" alt="{{ $banner->judul }}" style="max-width:100%;max-height:160px;border-radius:8px;display:block">
                                @endif
                                <label class="form-check mt-2">
                                    <input type="checkbox" name="hapus_media" value="1" class="form-check-input">
                                    <span class="form-check-label">Hapus media ini</span>
                                </label>
                            </div>
                            @endif

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Upload Gambar</label>
                                    <input type="file" name="foto" id="bannerFoto" class="form-control @error('foto') is-invalid @enderror"
                                        accept="image/webp,image/jpeg,image/png">
                                    <small class="form-hint">JPG/PNG/WebP, maks 8MB. Otomatis jadi WebP & lebar maks 1920px (aspek dijaga).</small>
                                    @error('foto') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Upload Video</label>
                                    <input type="file" name="video" id="bannerVideo" class="form-control @error('video') is-invalid @enderror"
                                        accept="video/mp4">
                                    <small class="form-hint">MP4 (H.264) 1080p, tanpa audio, loop 10–15 dtk, maks 25MB. Untuk background hero, bisa juga mulai dari kualitas 720p agar file lebih ringan.</small>
                                    @error('video') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            @error('media') <div class="text-danger" style="font-size:12.5px">{{ $message }}</div> @enderror
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

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  var foto = document.getElementById('bannerFoto');
  var video = document.getElementById('bannerVideo');
  if (!foto || !video) return;

  foto.addEventListener('change', function () {
    if (this.files.length) {
      video.value = '';
      video.disabled = true;
    } else {
      video.disabled = false;
    }
  });

  video.addEventListener('change', function () {
    if (this.files.length) {
      foto.value = '';
      foto.disabled = true;
    } else {
      foto.disabled = false;
    }
  });
});
</script>
@endpush
