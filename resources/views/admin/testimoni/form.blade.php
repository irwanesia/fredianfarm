@extends('layouts.admin')

@section('title', isset($testimoni) ? 'Edit Testimoni' : 'Tambah Testimoni')

@section('content')
    <form method="POST" action="{{ isset($testimoni) ? route('admin.testimoni.update', $testimoni) : route('admin.testimoni.store') }}">
        @csrf
        @if (isset($testimoni)) @method('PUT') @endif

        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ isset($testimoni) ? 'Edit Testimoni' : 'Tambah Testimoni' }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label required">Nama</label>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                                value="{{ old('nama', $testimoni->nama ?? '') }}" required>
                            @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Daerah</label>
                            <input type="text" name="daerah" class="form-control @error('daerah') is-invalid @enderror"
                                value="{{ old('daerah', $testimoni->daerah ?? '') }}" placeholder="Contoh: Malang, Jawa Timur">
                            @error('daerah') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Review</label>
                            <textarea name="review" rows="5" class="form-control @error('review') is-invalid @enderror">{{ old('review', $testimoni->review ?? '') }}</textarea>
                            @error('review') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Rating</label>
                            <select name="rating" class="form-control @error('rating') is-invalid @enderror">
                                <option value="">Pilih Rating</option>
                                @for ($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}" @selected(old('rating', $testimoni->rating ?? '') == $i)>
                                        {{ $i }} - {{ str_repeat('★', $i) }}{{ str_repeat('☆', 5 - $i) }}
                                    </option>
                                @endfor
                            </select>
                            @error('rating') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Foto URL</label>
                            <input type="text" name="foto_url" class="form-control @error('foto_url') is-invalid @enderror"
                                value="{{ old('foto_url', $testimoni->foto_url ?? '') }}" placeholder="/storage/...">
                            @error('foto_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Video URL</label>
                            <input type="text" name="video_url" class="form-control @error('video_url') is-invalid @enderror"
                                value="{{ old('video_url', $testimoni->video_url ?? '') }}" placeholder="https://www.youtube.com/embed/...">
                            <small class="form-hint">URL YouTube embed, contoh: https://www.youtube.com/embed/xxxx</small>
                            @error('video_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
                                    {{ old('is_active', $testimoni->is_active ?? false) ? 'checked' : '' }}>
                                <span class="form-check-label">Aktif</span>
                            </label>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                {{ isset($testimoni) ? 'Simpan Perubahan' : 'Simpan' }}
                            </button>
                            <a href="{{ route('admin.testimoni.index') }}" class="btn btn-outline-secondary">Batal</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
