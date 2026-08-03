@extends('layouts.public')
@section('title', 'Produk — Fredian Farm')
@section('content')
@include('public._nav', ['active' => 'produk'])
<section class="section-tight tinted">
  <div class="container">
    <div class="breadcrumb"><a href="{{ route('home') }}">Beranda</a><span>/</span><span>Produk</span></div>
    <div class="eyebrow">Katalog Bibit</div>
    <h1>Bibit kentang untuk setiap kebutuhan tanam</h1>
  </div>
</section>
<section>
  <div class="container">
    <form method="GET" action="{{ route('produk.index') }}" class="filter-bar">
      <div class="filter-group">
        <select name="kategori" onchange="this.form.submit()">
          <option value="">Kelas Bibit</option>
          @foreach ($kategoris as $k)
          <option value="{{ $k->slug }}" {{ request('kategori') == $k->slug ? 'selected' : '' }}>{{ $k->nama }}</option>
          @endforeach
        </select>
      </div>
      <div class="filter-group">
        <select name="stok" onchange="this.form.submit()">
          <option value="">Ketersediaan</option>
          <option value="tersedia" {{ request('stok') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
          <option value="terbatas" {{ request('stok') == 'terbatas' ? 'selected' : '' }}>Terbatas</option>
          <option value="pre_order" {{ request('stok') == 'pre_order' ? 'selected' : '' }}>Pre-order</option>
        </select>
      </div>
      <a href="{{ route('produk.index') }}" class="btn btn-ghost btn-sm">Reset</a>
    </form>

    <p style="font-size:13.5px;margin-bottom:18px">{{ $produks->count() }} produk ditemukan</p>

    @if($produks->count())
    <div class="grid grid-products">
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
          <button class="btn btn-accent btn-sm" onclick="event.stopPropagation();addToCart({{ $p->id }}, {{ $cartVarId ?? 'null' }}, '{{ addslashes($p->nama) }}', '{{ addslashes($cartVarNama) }}', {{ $cartHarga }}, '{{ $cartBerat }}', '{{ $cartStok }}');showToast('✅','{{ addslashes($p->nama) }} ditambahkan')" style="flex:1">+ Keranjang</button>
          <a class="btn btn-primary btn-sm" href="{{ route('produk.show', $p->slug) }}" style="flex:1;text-align:center">Detail</a>
        </div>
      </div>
      @endforeach
    </div>
    @else
    <div style="text-align:center;padding:60px 0;color:var(--text-soft)">Tidak ada produk yang cocok dengan filter ini. Coba ubah kata kunci atau reset filter.</div>
    @endif

    <div class="rfq-banner" style="margin-top:40px">
      <div>
        <h4 style="margin-bottom:4px">Butuh dalam jumlah besar?</h4>
        <p style="margin:0;font-size:14px">Ajukan Permintaan Penawaran (RFQ) untuk pembelian partai besar dengan harga khusus.</p>
      </div>
      <a href="{{ route('kontak') }}" class="btn btn-primary">Ajukan RFQ</a>
    </div>
  </div>
</section>
@endsection
