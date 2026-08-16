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
                                <label class="form-label">Jenis (Kelas Bibit)</label>
                                <input type="text" name="jenis" list="jenisList" class="form-control @error('jenis') is-invalid @enderror"
                                    placeholder="cth: G-0, G-2" value="{{ old('jenis', $produk->jenis ?? '') }}">
                                <datalist id="jenisList">
                                    @foreach ($jenisList as $j)
                                        <option value="{{ $j }}"></option>
                                    @endforeach
                                </datalist>
                                @error('jenis') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Varietas</label>
                                <input type="text" name="varietas" list="varietasList" class="form-control @error('varietas') is-invalid @enderror"
                                    placeholder="cth: Agria, MZ, Granola" value="{{ old('varietas', $produk->varietas ?? '') }}">
                                <datalist id="varietasList">
                                    @foreach ($varietasList as $v)
                                        <option value="{{ $v }}"></option>
                                    @endforeach
                                </datalist>
                                @error('varietas') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
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
                            <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="8">{{ old('deskripsi', $produk->deskripsi ?? '') }}</textarea>
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
                                    <option value="pre_order" @selected(old('stok_status', $produk->stok_status ?? '') == 'pre_order')>Pre-order</option>
                                </select>
                                @error('stok_status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h3 class="card-title mb-0">Varian Ukuran</h3>
                        <button type="button" class="btn btn-sm btn-outline-primary" onclick="tambahBarisVarian()">
                            <i class="ti ti-plus me-1"></i>
                            Tambah Ukuran
                        </button>
                    </div>
                    <div class="card-body">
                        <p class="text-secondary" style="font-size:12px;margin-bottom:14px">
                            Harga yang tampil di website dihitung sebagai rentang harga dari ukuran-ukuran ini. Kosongkan bila produk tanpa pilihan ukuran.
                        </p>
                        <div id="varianRows">
                            @php $varIdx = 0; @endphp
                            @forelse (isset($produk) ? $produk->variants : [] as $v)
                                <div class="row g-2 varian-row align-items-end mb-2">
                                    <div class="col-md-3">
                                        <label class="form-label">Ukuran</label>
                                        <input type="text" name="variants[{{ $varIdx }}][nama]" class="form-control" placeholder="cth: 10 Kg"
                                            value="{{ old('variants.' . $varIdx . '.nama', $v->nama) }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Harga (Rp)</label>
                                        <input type="number" name="variants[{{ $varIdx }}][harga]" class="form-control" step="1000" min="0"
                                            value="{{ old('variants.' . $varIdx . '.harga', $v->harga) }}">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Berat (kg)</label>
                                        <input type="number" name="variants[{{ $varIdx }}][berat]" class="form-control" step="0.01" min="0"
                                            value="{{ old('variants.' . $varIdx . '.berat', $v->berat) }}">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Stok</label>
                                        <select name="variants[{{ $varIdx }}][stok_status]" class="form-control">
                                            <option value="tersedia" @selected($v->stok_status == 'tersedia')>Tersedia</option>
                                            <option value="terbatas" @selected($v->stok_status == 'terbatas')>Terbatas</option>
                                            <option value="pre_order" @selected($v->stok_status == 'pre_order')>Pre-order</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 d-flex align-items-center gap-2">
                                        <input type="hidden" name="variants[{{ $varIdx }}][id]" value="{{ $v->id }}">
                                        <input type="number" name="variants[{{ $varIdx }}][urutan]" class="form-control" placeholder="Urut" title="Urutan"
                                            value="{{ $v->urutan }}">
                                        <label class="form-check mb-0" title="Hapus ukuran ini">
                                            <input type="checkbox" name="variants[{{ $varIdx }}][hapus]" value="1" class="form-check-input">
                                            <span class="form-check-label">Hapus</span>
                                        </label>
                                    </div>
                                </div>
                                @php $varIdx++; @endphp
                            @empty
                                <div class="varian-row" data-varian-row="kosong">
                                    <div class="text-secondary" style="font-size:13px">Belum ada ukuran. Klik "Tambah Ukuran" untuk menambahkan.</div>
                                </div>
                            @endforelse
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

@push('scripts')
<script>
function tambahBarisVarian() {
  const rows = document.getElementById('varianRows');
  const kosong = rows.querySelector('[data-varian-row="kosong"]');
  if (kosong) kosong.remove();
  const idx = rows.querySelectorAll('.varian-row').length;
  const row = document.createElement('div');
  row.className = 'row g-2 varian-row align-items-end mb-2';
  row.innerHTML = `
    <div class="col-md-3">
      <label class="form-label">Ukuran</label>
      <input type="text" name="variants[${idx}][nama]" class="form-control" placeholder="cth: 10 Kg">
    </div>
    <div class="col-md-3">
      <label class="form-label">Harga (Rp)</label>
      <input type="number" name="variants[${idx}][harga]" class="form-control" step="1000" min="0">
    </div>
    <div class="col-md-2">
      <label class="form-label">Berat (kg)</label>
      <input type="number" name="variants[${idx}][berat]" class="form-control" step="0.01" min="0">
    </div>
    <div class="col-md-2">
      <label class="form-label">Stok</label>
      <select name="variants[${idx}][stok_status]" class="form-control">
        <option value="tersedia">Tersedia</option>
        <option value="terbatas">Terbatas</option>
        <option value="pre_order">Pre-order</option>
      </select>
    </div>
    <div class="col-md-2 d-flex align-items-center gap-2">
      <input type="number" name="variants[${idx}][urutan]" class="form-control" placeholder="Urut" title="Urutan">
      <button type="button" class="btn btn-sm btn-outline-danger" onclick="this.closest('.varian-row').remove()">
        <i class="ti ti-trash"></i>
      </button>
    </div>`;
  rows.appendChild(row);
  row.querySelector('input[name$="[nama]"]').focus();
}
</script>
@endpush
