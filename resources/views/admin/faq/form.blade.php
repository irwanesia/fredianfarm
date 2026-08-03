@extends('layouts.admin')

@section('title', isset($faq) ? 'Edit FAQ' : 'Tambah FAQ')

@section('content')
    <form method="POST" action="{{ isset($faq) ? route('admin.faq.update', $faq) : route('admin.faq.store') }}">
        @csrf
        @if (isset($faq)) @method('PUT') @endif

        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ isset($faq) ? 'Edit FAQ' : 'Tambah FAQ' }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label required">Pertanyaan</label>
                            <input type="text" name="pertanyaan" class="form-control @error('pertanyaan') is-invalid @enderror"
                                value="{{ old('pertanyaan', $faq->pertanyaan ?? '') }}" required>
                            @error('pertanyaan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jawaban</label>
                            <textarea name="jawaban" class="form-control @error('jawaban') is-invalid @enderror" rows="10">{{ old('jawaban', $faq->jawaban ?? '') }}</textarea>
                            @error('jawaban') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Urutan</label>
                            <input type="number" name="urutan" class="form-control @error('urutan') is-invalid @enderror"
                                value="{{ old('urutan', $faq->urutan ?? '') }}">
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
                                    {{ old('is_active', $faq->is_active ?? false) ? 'checked' : '' }}>
                                <span class="form-check-label">Aktif</span>
                            </label>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                {{ isset($faq) ? 'Simpan Perubahan' : 'Simpan' }}
                            </button>
                            <a href="{{ route('admin.faq.index') }}" class="btn btn-outline-secondary">Batal</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
