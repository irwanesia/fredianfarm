@extends('layouts.admin')

@section('title', isset($mediaSosial) ? 'Edit Media Sosial' : 'Tambah Media Sosial')

@section('content')
    <form method="POST" action="{{ isset($mediaSosial) ? route('admin.media-sosial.update', $mediaSosial) : route('admin.media-sosial.store') }}">
        @csrf
        @if (isset($mediaSosial)) @method('PUT') @endif

        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ isset($mediaSosial) ? 'Edit Media Sosial' : 'Tambah Media Sosial' }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label required">Platform</label>
                            <select name="platform" class="form-control @error('platform') is-invalid @enderror" required>
                                <option value="">Pilih Platform</option>
                                @foreach (['WhatsApp', 'Instagram', 'Facebook', 'YouTube', 'TikTok', 'Twitter'] as $platform)
                                    <option value="{{ $platform }}" @selected(old('platform', $mediaSosial->platform ?? '') == $platform)>
                                        {{ $platform }}
                                    </option>
                                @endforeach
                            </select>
                            @error('platform') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label required">URL</label>
                            <input type="text" name="url" class="form-control @error('url') is-invalid @enderror"
                                value="{{ old('url', $mediaSosial->url ?? '') }}" required placeholder="https://...">
                            @error('url') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Icon</label>
                            <input type="text" name="icon" class="form-control @error('icon') is-invalid @enderror"
                                value="{{ old('icon', $mediaSosial->icon ?? '') }}" placeholder="Font Awesome class atau SVG path">
                            <small class="form-hint">Contoh: fab fa-whatsapp atau path SVG</small>
                            @error('icon') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Urutan</label>
                            <input type="number" name="urutan" class="form-control @error('urutan') is-invalid @enderror"
                                value="{{ old('urutan', $mediaSosial->urutan ?? '') }}">
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
                                    {{ old('is_active', $mediaSosial->is_active ?? false) ? 'checked' : '' }}>
                                <span class="form-check-label">Aktif</span>
                            </label>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                {{ isset($mediaSosial) ? 'Simpan Perubahan' : 'Simpan' }}
                            </button>
                            <a href="{{ route('admin.media-sosial.index') }}" class="btn btn-outline-secondary">Batal</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
