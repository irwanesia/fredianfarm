@extends('layouts.public')
@section('title', 'Hasil Pencarian — Fredian Farm')
@section('content')
@include('public._nav', ['active' => ''])
<section class="section-tight tinted">
  <div class="container">
    <div class="breadcrumb"><a href="{{ route('home') }}">Beranda</a><span>/</span><span>Pencarian</span></div>
    <div class="eyebrow">Cari di Fredian Farm</div>
    <h1>Cari produk & artikel</h1>
  </div>
</section>
<section>
  <div class="container">
    <form method="GET" action="{{ route('cari') }}" class="filter-bar">
      <input type="text" name="q" value="{{ $q }}" placeholder="Ketik kata kunci… mis. kentang, agria" style="flex:1">
      <button type="submit" class="btn btn-primary">Cari</button>
    </form>

    @if($q === '')
      <div style="text-align:center;padding:60px 0;color:var(--text-soft)">Masukkan kata kunci untuk mencari produk atau artikel.</div>
    @else
      <p style="font-size:13.5px;margin:22px 0 18px">Hasil untuk "<strong>{{ $q }}</strong>": {{ $produks->count() + $artikels->count() }} ditemukan</p>

      @if($produks->count())
      <div class="eyebrow" style="margin:8px 0 16px">Produk ({{ $produks->count() }})</div>
      <div class="grid grid-products" style="margin-bottom:36px">
        @foreach ($produks as $p)
        @php
          $firstVar = $p->variants->first();
          $cartHarga = $firstVar->harga ?? $p->harga;
          $cartVarId = $firstVar->id ?? null;
          $cartVarNama = $firstVar->nama ?? '';
          $cartBerat = $firstVar->berat ?? $p->berat;
          $cartStok = $firstVar->stok_status ?? $p->stok_status;
        @endphp
        <div class="prod-card" style="cursor:pointer">
          <div onclick="window.location='{{ route('produk.show', $p->slug) }}'" style="cursor:pointer">
            <div class="prod-media" style="background:var(--green-soft)">
              <span class="prod-tag {{ 'stok-'.$p->stok_status }}">{{ ucfirst(str_replace('_', ' ', $p->stok_status)) }}</span>
              @if ($p->fotoUtama)
              <img src="{{ $p->fotoUtama }}" alt="{{ $p->nama }}" loading="lazy">
              @else
              <svg viewBox="0 0 100 100" style="width:56%;height:56%"><ellipse cx="50" cy="55" rx="30" ry="24" fill="#F9A825"/><ellipse cx="40" cy="46" rx="4" ry="3" fill="#1F3D22" opacity=".22"/><circle cx="50" cy="30" r="6" fill="#5CB962"/></svg>
              @endif
            </div>
            <div class="prod-body">
              <h4>{{ $p->nama }}</h4>
              <p class="desc-clamp">{{ $p->deskripsi ? strip_tags($p->deskripsi) : 'Bibit unggul berkualitas.' }}</p>
              <div class="prod-harga">Rp {{ number_format($cartHarga, 0, ',', '.') }}</div>
            </div>
          </div>
          <div class="prod-foot" style="padding:0 20px 18px;display:flex;gap:8px;flex-wrap:wrap">
            <a class="btn btn-primary btn-sm" href="{{ route('produk.show', $p->slug) }}" style="flex:1;text-align:center">Detail</a>
          </div>
        </div>
        @endforeach
      </div>
      @endif

      @if($artikels->count())
      <div class="eyebrow" style="margin:8px 0 16px">Artikel ({{ $artikels->count() }})</div>
      <div class="grid grid-articles" style="margin-bottom:36px">
        @foreach ($artikels as $a)
        <a href="{{ route('blog.show', $a->slug) }}" class="article-card">
          <div class="article-media" style="background:var(--green-soft)">
            @if ($a->image)
            <img src="{{ $a->image }}" alt="{{ $a->judul }}" loading="lazy">
            @else
            <svg viewBox="0 0 100 100" style="width:40%"><rect x="25" y="20" width="50" height="60" rx="4" fill="#F9A825" opacity=".5"/><line x1="35" y1="35" x2="65" y2="35" stroke="#1F3D22" stroke-width="2" opacity=".3"/><line x1="35" y1="45" x2="60" y2="45" stroke="#1F3D22" stroke-width="2" opacity=".3"/><line x1="35" y1="55" x2="55" y2="55" stroke="#1F3D22" stroke-width="2" opacity=".3"/></svg>
            @endif
          </div>
          <div class="article-body">
            <span class="badge-kat">{{ $a->kategori->nama ?? 'Umum' }}</span>
            <h4>{{ $a->judul }}</h4>
            <p>{{ $a->excerpt ?? $a->judul }}</p>
            <div class="article-meta">{{ $a->published_at ? $a->published_at->format('d M Y') : '' }}</div>
          </div>
        </a>
        @endforeach
      </div>
      @endif

      @if(!$produks->count() && !$artikels->count())
      <div style="text-align:center;padding:60px 0;color:var(--text-soft)">Tidak ada hasil untuk "{{ $q }}". Coba kata kunci lain.</div>
      @endif
    @endif
  </div>
</section>
@endsection
