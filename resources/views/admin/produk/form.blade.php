@extends('layouts.admin')

@section('title', isset($produk) ? 'Edit Produk' : 'Tambah Produk')

@section('content')
    <form method="POST" action="{{ isset($produk) ? route('admin.produk.update', $produk) : route('admin.produk.store') }}" enctype="multipart/form-data">
        @csrf
        @if (isset($produk)) @method('PUT') @endif

        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Informasi Produk</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label required">Nama Produk</label>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                                value="{{ old('nama', $produk->nama ?? '') }}" required>
                            @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Jenis Wadah</label>
                                <input type="text" name="jenis_wadah" class="form-control @error('jenis_wadah') is-invalid @enderror"
                                    placeholder="contoh: Kardus, Bubble wrap, Toples" value="{{ old('jenis_wadah', $produk->jenis_wadah ?? '') }}">
                                @error('jenis_wadah') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Umur Simpan</label>
                                <input type="text" name="umur_simpan" class="form-control @error('umur_simpan') is-invalid @enderror"
                                    placeholder="contoh: 3 bulan" value="{{ old('umur_simpan', $produk->umur_simpan ?? '') }}">
                                @error('umur_simpan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control editor-tinymce @error('deskripsi') is-invalid @enderror" rows="10">{{ old('deskripsi', $produk->deskripsi ?? '') }}</textarea>
                            @error('deskripsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Harga (Rp)</label>
                                <input type="number" name="harga" step="0.01" class="form-control @error('harga') is-invalid @enderror"
                                    value="{{ old('harga', $produk->harga ?? '') }}">
                                @error('harga') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Berat (kg)</label>
                                <input type="number" name="berat" step="0.01" class="form-control @error('berat') is-invalid @enderror"
                                    value="{{ old('berat', $produk->berat ?? '') }}">
                                @error('berat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Status Stok</label>
                                <select name="stok_status" class="form-control @error('stok_status') is-invalid @enderror">
                                    <option value="">Pilih</option>
                                    <option value="tersedia" @selected(old('stok_status', $produk->stok_status ?? '') == 'tersedia')>Tersedia</option>
                                    <option value="terbatas" @selected(old('stok_status', $produk->stok_status ?? '') == 'terbatas')>Terbatas</option>
                                    <option value="habis" @selected(old('stok_status', $produk->stok_status ?? '') == 'habis')>Habis</option>
                                </select>
                                @error('stok_status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Foto Produk</h3>
                    </div>
                    <div class="card-body">
                        @if (isset($produk) && $produk->gambar->count())
                        <div class="mb-3">
                            <label class="form-label">Foto Saat Ini</label>
                            <div class="row g-2">
                                @foreach ($produk->gambar as $g)
                                <div class="col-6">
                                    <div style="border:1px solid var(--tblr-border-color);border-radius:8px;padding:6px;position:relative">
                                        <img src="{{ $g->url }}" alt="Foto produk" style="width:100%;height:70px;object-fit:cover;border-radius:4px;display:block">
                                        <label class="form-check" style="margin:6px 0 0">
                                            <input type="checkbox" name="hapus_foto[]" value="{{ $g->id }}" class="form-check-input">
                                            <span class="form-check-label" style="font-size:11px">Hapus</span>
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                        <div class="mb-3">
                            <label class="form-label">{{ isset($produk) && $produk->gambar->count() ? 'Tambah Foto Baru' : 'Upload Foto' }}</label>
                            <input type="file" name="foto[]" class="form-control" multiple accept="image/jpeg,image/png,image/webp">
                            <div class="form-hint">Format JPG/PNG/WebP, maks 2MB per file. Bisa pilih lebih dari satu.</div>
                            @error('foto.*') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tautan Marketplace</h3>
                    </div>
                    <div class="card-body">
                        <p style="font-size:12px;color:var(--tblr-secondary);margin-bottom:12px">Opsional. Isi agar tombol "Pesan via TikTok / Shopee" tampil di halaman produk ini.</p>
                        <div class="mb-3">
                            <label class="form-label">Link TikTok</label>
                            <input type="url" name="link_tiktok" class="form-control @error('link_tiktok') is-invalid @enderror" placeholder="https://www.tiktok.com/@..." value="{{ old('link_tiktok', $produk->link_tiktok ?? '') }}">
                            @error('link_tiktok') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Link Shopee</label>
                            <input type="url" name="link_shopee" class="form-control @error('link_shopee') is-invalid @enderror" placeholder="https://shopee.co.id/..." value="{{ old('link_shopee', $produk->link_shopee ?? '') }}">
                            @error('link_shopee') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Pengaturan</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label required">Kategori</label>
                            <select name="kategori_id" class="form-control @error('kategori_id') is-invalid @enderror" required>
                                <option value="">Pilih Kategori</option>
                                @foreach ($kategoris as $k)
                                    <option value="{{ $k->id }}" @selected(old('kategori_id', $produk->kategori_id ?? '') == $k->id)>
                                        {{ $k->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kategori_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-check">
                                <input type="checkbox" name="is_active" class="form-check-input" value="1"
                                    {{ old('is_active', $produk->is_active ?? true) ? 'checked' : '' }}>
                                <span class="form-check-label">Produk Aktif</span>
                            </label>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                {{ isset($produk) ? 'Simpan Perubahan' : 'Simpan' }}
                            </button>
                            <a href="{{ route('admin.produk.index') }}" class="btn btn-outline-secondary">Batal</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
