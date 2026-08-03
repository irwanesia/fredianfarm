@extends('layouts.admin')

@section('title', isset($artikel) ? 'Edit Artikel' : 'Tambah Artikel')

@section('content')
    @php
        $aiEnabled = app(\App\Services\GeminiService::class)->isConfigured()
            || app(\App\Services\GroqService::class)->isConfigured();
    @endphp

    <form method="POST" action="{{ isset($artikel) ? route('admin.artikel.update', $artikel) : route('admin.artikel.store') }}">
        @csrf
        @if (isset($artikel)) @method('PUT') @endif
        <input type="hidden" name="ai_generated" value="0">

        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Informasi Artikel</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label required">Judul Artikel</label>
                            <input type="text" name="judul" id="judul" class="form-control @error('judul') is-invalid @enderror"
                                value="{{ old('judul', $artikel->judul ?? '') }}" required>
                            @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label required">Kategori</label>
                            <select name="kategori_id" class="form-control @error('kategori_id') is-invalid @enderror" required>
                                <option value="">Pilih Kategori</option>
                                @foreach ($kategoris as $k)
                                    <option value="{{ $k->id }}" @selected(old('kategori_id', $artikel->kategori_id ?? '') == $k->id)>
                                        {{ $k->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kategori_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Konten</label>
                            <textarea name="konten" class="form-control editor-tinymce @error('konten') is-invalid @enderror" rows="15">{{ old('konten', $artikel->konten ?? '') }}</textarea>
                            @error('konten') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Excerpt (ringkasan)</label>
                            <textarea name="excerpt" rows="3" class="form-control @error('excerpt') is-invalid @enderror">{{ old('excerpt', $artikel->excerpt ?? '') }}</textarea>
                            @error('excerpt') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">SEO Settings</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Meta Title</label>
                            <input type="text" name="meta_title" class="form-control @error('meta_title') is-invalid @enderror"
                                value="{{ old('meta_title', $artikel->meta_title ?? '') }}">
                            @error('meta_title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Meta Description</label>
                            <textarea name="meta_description" rows="3" class="form-control @error('meta_description') is-invalid @enderror">{{ old('meta_description', $artikel->meta_description ?? '') }}</textarea>
                            @error('meta_description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">URL Gambar</label>
                            <input type="text" name="gambar" class="form-control @error('gambar') is-invalid @enderror"
                                value="{{ old('gambar', $artikel->gambar ?? '') }}" placeholder="/storage/artikel/...">
                            @error('gambar') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
                                <input type="checkbox" name="is_published" class="form-check-input" value="1"
                                    {{ old('is_published', $artikel->is_published ?? false) ? 'checked' : '' }}>
                                <span class="form-check-label">Publikasikan</span>
                            </label>
                        </div>

                        @if (isset($artikel) && $artikel->published_at)
                            <div class="mb-3 text-secondary small">
                                Dipublikasikan: {{ $artikel->published_at->format('d M Y H:i') }}
                            </div>
                        @endif

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                {{ isset($artikel) ? 'Simpan Perubahan' : 'Simpan' }}
                            </button>
                            <a href="{{ route('admin.artikel.index') }}" class="btn btn-outline-secondary">Batal</a>
                        </div>
                    </div>
                </div>

                @if ($aiEnabled)
                <div class="card mt-3">
                    <div class="card-header">
                        <h3 class="card-title">Generator AI</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Kata Kunci / Topik</label>
                            <input type="text" id="ai-keyword" class="form-control" placeholder="Contoh: cara tanam kentang">
                        </div>

                        <div class="d-grid gap-2 mb-3">
                            <button type="button" id="btn-generate-titles" class="btn btn-outline-primary" onclick="generateTitles()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="me-1"><polygon points="23 7 16 12 23 17 23 7"/><rect x="1" y="5" width="15" height="14" rx="2" ry="2"/></svg>
                                Generate Judul
                            </button>
                        </div>

                        <div id="titles-container" class="mb-3" style="display:none;">
                            <label class="form-label">Pilih Judul:</label>
                            <div id="titles-list" class="list-group list-group-flush"></div>
                        </div>

                        <div id="ai-loading" class="text-center py-3" style="display:none;">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Memproses...</span>
                            </div>
                            <div class="text-secondary small mt-2">Memproses permintaan...</div>
                        </div>

                        <div class="d-grid">
                            <button type="button" id="btn-generate-content" class="btn btn-outline-success" onclick="generateArticle()" disabled>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="me-1"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
                                Generate Konten
                            </button>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </form>
@endsection

@push('scripts')
@if ($aiEnabled)
<script>
const csrfToken = '{{ csrf_token() }}';

function generateTitles() {
    const keyword = document.getElementById('ai-keyword').value.trim();
    if (!keyword) {
        alert('Masukkan kata kunci terlebih dahulu.');
        return;
    }

    const btn = document.getElementById('btn-generate-titles');
    const container = document.getElementById('titles-container');
    const list = document.getElementById('titles-list');
    const loading = document.getElementById('ai-loading');

    btn.disabled = true;
    container.style.display = 'none';
    loading.style.display = 'block';

    fetch('{{ route("admin.ai-artikel", "titles") }}', {
        method: 'POST',
        headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken},
        body: JSON.stringify({ keyword }),
    })
    .then(r => r.json())
    .then(data => {
        loading.style.display = 'none';
        btn.disabled = false;

        if (data.error) {
            alert(data.error);
            return;
        }

        list.innerHTML = '';
        data.titles.forEach((title, i) => {
            const a = document.createElement('a');
            a.href = '#';
            a.className = 'list-group-item list-group-item-action py-2 small';
            a.textContent = `${i + 1}. ${title}`;
            a.onclick = (e) => {
                e.preventDefault();
                document.getElementById('judul').value = title;
                document.querySelectorAll('#titles-list a').forEach(el => el.classList.remove('active'));
                a.classList.add('active');
                document.getElementById('btn-generate-content').disabled = false;
            };
            list.appendChild(a);
        });
        container.style.display = 'block';
    })
    .catch(() => {
        loading.style.display = 'none';
        btn.disabled = false;
        alert('Gagal terhubung ke server.');
    });
}

function generateArticle() {
    const judul = document.getElementById('judul').value.trim();
    const keyword = document.getElementById('ai-keyword').value.trim();
    if (!judul) {
        alert('Pilih judul terlebih dahulu.');
        return;
    }

    const btn = document.getElementById('btn-generate-content');
    const loading = document.getElementById('ai-loading');

    btn.disabled = true;
    loading.style.display = 'block';

    fetch('{{ route("admin.ai-artikel", "article") }}', {
        method: 'POST',
        headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken},
        body: JSON.stringify({ judul, keyword }),
    })
    .then(r => r.json())
    .then(data => {
        loading.style.display = 'none';
        btn.disabled = false;

        if (data.error) {
            alert(data.error);
            return;
        }

        if (typeof tinymce !== 'undefined' && tinymce.activeEditor) {
            tinymce.activeEditor.setContent(data.konten);
        } else {
            document.querySelector('.editor-tinymce').value = data.konten;
        }

        document.querySelector('textarea[name="excerpt"]').value = data.excerpt || '';
        document.querySelector('input[name="meta_title"]').value = data.meta_title || '';
        document.querySelector('textarea[name="meta_description"]').value = data.meta_description || '';

        document.querySelector('input[name="ai_generated"]').value = '1';
        alert('Konten berhasil digenerate! Silakan review dan edit jika perlu.');
    })
    .catch(() => {
        loading.style.display = 'none';
        btn.disabled = false;
        alert('Gagal terhubung ke server.');
    });
}
</script>
@endif
@endpush
