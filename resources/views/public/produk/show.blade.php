@extends('layouts.public')
@section('title', $produk->nama . ' — Fredian Farm')
@section('meta_head')
    <meta name="description" content="{{ Str::limit(strip_tags($produk->deskripsi ?? ''), 160) ?: ($settings['META_DESCRIPTION']->value ?? 'Produsen dan distributor bibit kentang G-0, G-0 MZ, Granola L, dan G-0 Plus dari Dieng, Jawa Tengah.') }}">
    <meta name="robots" content="index, follow">
    <meta property="og:type" content="product">
    <meta property="og:site_name" content="{{ $settings['APP_NAME']->value ?? 'Fredian Farm' }}">
    <meta property="og:title" content="{{ $produk->nama }} — Fredian Farm">
    <meta property="og:description" content="{{ Str::limit(strip_tags($produk->deskripsi ?? ''), 160) ?: ($settings['META_DESCRIPTION']->value ?? '') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    @if($produk->fotoUtama)
    <meta property="og:image" content="{{ url($produk->fotoUtama) }}">
    @elseif(!empty($settings['OG_IMAGE']->value))
    <meta property="og:image" content="{{ $settings['OG_IMAGE']->value }}">
    @endif
@endsection
@php
    $availMap = ['tersedia' => 'https://schema.org/InStock', 'terbatas' => 'https://schema.org/LimitedAvailability', 'pre_order' => 'https://schema.org/PreOrder'];
    $productJson = [
        '@context' => 'https://schema.org',
        '@type' => 'Product',
        'name' => $produk->nama,
        'description' => Str::limit(strip_tags($produk->deskripsi ?? ''), 200),
        'url' => url()->current(),
        'sku' => $produk->slug,
        'brand' => ['@type' => 'Brand', 'name' => $settings['APP_NAME']->value ?? 'Fredian Farm'],
        'offers' => [
            '@type' => 'Offer',
            'url' => url()->current(),
            'priceCurrency' => 'IDR',
            'price' => (float) ($produk->variants->first()->harga ?? $produk->harga ?? 0),
            'availability' => $availMap[$produk->stok_status] ?? 'https://schema.org/InStock',
        ],
    ];
    if ($produk->fotoUtama) {
        $productJson['image'] = url($produk->fotoUtama);
    }
    $breadcrumbJson = [
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Beranda', 'item' => url('/')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Produk', 'item' => route('produk.index')],
            ['@type' => 'ListItem', 'position' => 3, 'name' => $produk->nama, 'item' => url()->current()],
        ],
    ];
@endphp
@push('schema')
<script type="application/ld+json">{!! json_encode($productJson, JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_QUOT | JSON_HEX_APOS) !!}</script>
<script type="application/ld+json">{!! json_encode($breadcrumbJson, JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_QUOT | JSON_HEX_APOS) !!}</script>
@endpush
@section('content')
@include('public._nav', ['active' => 'produk'])
<section class="section-tight">
  <div class="container">
    <div class="breadcrumb"><a href="{{ route('home') }}">Beranda</a><span>/</span><a href="{{ route('produk.index') }}">Produk</a><span>/</span><span>{{ $produk->nama }}</span></div>
    <div class="grid grid-2" style="align-items:flex-start;gap:44px">
      <div style="background:var(--green-soft);border-radius:var(--radius);aspect-ratio:1/1;position:relative;display:flex;align-items:center;justify-content:center;overflow:hidden">
        <span class="prod-tag {{ 'stok-'.$produk->stok_status }}" style="z-index:2">{{ ucfirst(str_replace('_', ' ', $produk->stok_status)) }}</span>
        @if ($produk->fotoUtama)
        <img src="{{ $produk->fotoUtama }}" alt="{{ $produk->nama }}" id="mainFoto" style="width:100%;height:100%;object-fit:cover;position:absolute;inset:0">
        @else
        <svg viewBox="0 0 100 100" style="width:60%;height:60%"><ellipse cx="50" cy="55" rx="30" ry="24" fill="#F9A825"/><ellipse cx="40" cy="46" rx="4" ry="3" fill="#1F3D22" opacity=".22"/><circle cx="50" cy="30" r="6" fill="#5CB962"/></svg>
        @endif
      </div>
      @if ($produk->gambar->count() > 1)
      <div style="display:flex;gap:8px;margin-top:12px;flex-wrap:wrap">
        @foreach ($produk->gambar as $g)
        <img src="{{ $g->url }}" alt="Foto {{ $produk->nama }}" onclick="setMainFoto(this)" style="width:64px;height:64px;object-fit:cover;border-radius:8px;cursor:pointer;border:2px solid transparent" {{ $loop->first ? 'class="thumb-active"' : '' }}>
        @endforeach
      </div>
      @endif
      <div>
        <div class="eyebrow">{{ $produk->kategori->nama ?? '-' }}</div>
        <h1 style="font-size:32px">{{ $produk->nama }}</h1>

        @if ($produk->variants->count())
        <div style="font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:var(--text-soft);margin-bottom:4px">Pilih Kemasan</div>
        <div class="variant-list" id="variantList">
          @foreach ($produk->variants as $v)
          <div class="variant-item variant-selectable" data-variant-id="{{ $v->id }}" data-harga="{{ $v->harga }}" data-berat="{{ $v->berat }}" data-nama="{{ $v->nama }}" data-stok="{{ $v->stok_status }}" onclick="selectVariant(this, {{ $v->id }})" style="cursor:pointer">
            <div class="variant-info">
              <b>{{ $v->nama }}</b>
              <span class="variant-harga">Rp {{ number_format($v->harga, 0, ',', '.') }}</span>
            </div>
            <div class="variant-meta">
              @if ($v->berat)<span class="chip">{{ $v->berat }} kg</span>@endif
              <span class="chip {{ 'stok-'.$v->stok_status }}">{{ ucfirst($v->stok_status) }}</span>
            </div>
          </div>
          @endforeach
        </div>
        @else
        <div id="noVariantData" data-harga="{{ $produk->harga }}" data-berat="{{ $produk->berat }}" data-stok="{{ $produk->stok_status }}"></div>
        @endif

        <div style="display:flex;align-items:center;gap:14px;margin-top:20px">
          <div style="font-size:13px;font-weight:700;color:var(--text-soft)">Jumlah</div>
          <div style="display:flex;align-items:center;gap:8px">
            <button class="qty-ctrl" onclick="detailQty(-1)">−</button>
            <span class="qty-val" id="detailQty">1</span>
            <button class="qty-ctrl" onclick="detailQty(1)">+</button>
          </div>
        </div>

        <div class="detail-harga" style="margin-top:16px" id="detailHarga">Rp {{ number_format($produk->harga, 0, ',', '.') }}</div>

        @if ($produk->jenis_wadah || $produk->umur_simpan)
        <div style="display:flex;gap:8px;margin-top:14px;flex-wrap:wrap">
          @if ($produk->jenis_wadah)
          <span style="display:inline-flex;align-items:center;gap:6px;font-size:12.5px;font-weight:600;background:var(--green-soft);color:var(--green-deep);padding:6px 14px;border-radius:20px">📦 {{ $produk->jenis_wadah }}</span>
          @endif
          @if ($produk->umur_simpan)
          <span style="display:inline-flex;align-items:center;gap:6px;font-size:12.5px;font-weight:600;background:var(--green-soft);color:var(--green-deep);padding:6px 14px;border-radius:20px">⏳ Umur simpan: {{ $produk->umur_simpan }}</span>
          @endif
        </div>
        @endif

        @if ($produk->deskripsi)
        <div class="produk-deskripsi" style="font-size:15px;line-height:1.75;margin-top:16px">{!! $produk->deskripsi !!}</div>
        @endif

        <div style="display:flex;gap:10px;margin-top:20px;flex-wrap:wrap">
          <button class="btn btn-primary" onclick="beliLangsung({{ $produk->id }})">🛒 Beli Langsung</button>
          <button class="btn btn-accent" onclick="keranjangDulu({{ $produk->id }})">+ Keranjang</button>
          @if ($produk->link_tiktok)
          <a href="{{ $produk->link_tiktok }}" target="_blank" rel="noopener" class="btn btn-tiktok">🛍️ Pesan via TikTok</a>
          @endif
          @if ($produk->link_shopee)
          <a href="{{ $produk->link_shopee }}" target="_blank" rel="noopener" class="btn btn-shopee">🛍️ Pesan via Shopee</a>
          @endif
          <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', \App\Models\Setting::getValue('NOMOR_WA', '6281234567890')) }}" target="_blank" class="btn btn-ghost">💬 Tanya via WA</a>
        </div>
        <a href="{{ route('kontak') }}" class="btn btn-ghost" style="margin-top:8px">Ajukan RFQ Partai Besar</a>
      </div>
    </div>
  </div>
</section>
@endsection

@push('scripts')
<script>
let selectedVariantId = {{ $produk->variants->first()->id ?? 'null' }};
let detailHarga = {{ $produk->variants->first()->harga ?? $produk->harga }};
let detailBerat = '{{ $produk->variants->first()->berat ?? $produk->berat }}';
let detailStok = '{{ $produk->variants->first()->stok_status ?? $produk->stok_status }}';
let detailNama = '{{ addslashes($produk->variants->first()->nama ?? '') }}';

function selectVariant(el, id) {
  document.querySelectorAll('.variant-selectable').forEach(x => x.classList.remove('active'));
  el.classList.add('active');
  selectedVariantId = id;
  detailHarga = parseFloat(el.dataset.harga);
  detailBerat = el.dataset.berat || '';
  detailStok = el.dataset.stok || 'tersedia';
  detailNama = el.dataset.nama || '';
  document.getElementById('detailHarga').textContent = 'Rp ' + fmt(detailHarga);
}

function getSelectedQty() {
  return parseInt(document.getElementById('detailQty').textContent) || 1;
}

function detailQty(d) {
  let qty = getSelectedQty() + d;
  if (qty < 1) qty = 1;
  document.getElementById('detailQty').textContent = qty;
}

function beliLangsung(id) {
  const qty = getSelectedQty();
  const nama = '{{ addslashes($produk->nama) }}';
  for (let i = 0; i < qty; i++) {
    addToCart(id, selectedVariantId, nama, detailNama, detailHarga, detailBerat, detailStok);
  }
  document.getElementById('detailQty').textContent = 1;
  openCheckout();
}

function keranjangDulu(id) {
  const qty = getSelectedQty();
  const nama = '{{ addslashes($produk->nama) }}';
  for (let i = 0; i < qty; i++) {
    addToCart(id, selectedVariantId, nama, detailNama, detailHarga, detailBerat, detailStok);
  }
  document.getElementById('detailQty').textContent = 1;
  showToast('✅', (detailNama || nama) + ' ×' + qty + ' ditambahkan ke keranjang');
}

function setMainFoto(el) {
  const main = document.getElementById('mainFoto');
  if (main) main.src = el.src;
  document.querySelectorAll('.thumb-active').forEach(t => t.classList.remove('thumb-active'));
  el.classList.add('thumb-active');
}

document.addEventListener('DOMContentLoaded', function() {
  const first = document.querySelector('.variant-selectable');
  if (first) first.classList.add('active');
});
</script>
@endpush
