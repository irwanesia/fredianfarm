@extends('layouts.public')
@section('title', 'Fredian Farm — Bibit Kentang Unggul')

@section('content')
@include('public._nav', ['active' => 'home'])

<!-- HERO STATIS (dikomentari sementara, bisa dipakai lagi) -->
{{-- 
<section class="hero">
  <div class="container hero-inner">
    <div>
      <div class="eyebrow" style="color:#B9D9AF">Sejak Kebun Pertama di Dataran Tinggi Dieng</div>
      <h1>Bibit kentang yang tumbuh jadi <em>panen kepercayaan</em>.</h1>
      <p class="lead">Fredian Farm memproduksi bibit kentang kultur jaringan dan turunannya — G-0, G-0 MZ, Granola L, G-0 Plus — untuk petani, kelompok tani, dan distributor di seluruh Indonesia.</p>
      <div class="hero-actions">
        <a href="{{ route('produk.index') }}" class="btn btn-accent">Lihat Katalog Bibit</a>
        <a href="{{ route('cara-pesan') }}" class="btn btn-ghost" style="border-color:rgba(255,255,255,.3);color:#fff">Cara Pemesanan</a>
      </div>
      <div class="hero-stats">
        <div class="hero-stat"><b>12+</b><span>Tahun Beroperasi</span></div>
        <div class="hero-stat"><b>{{ $produks->count() }}</b><span>Kelas Bibit Unggul</span></div>
        <div class="hero-stat"><b>27,9rb</b><span>Pengikut TikTok</span></div>
      </div>
    </div>
    <div class="hero-art">
      <svg viewBox="0 0 400 380" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:100%;height:100%">
        <ellipse cx="200" cy="340" rx="170" ry="24" fill="#173318"/>
        <g><ellipse cx="150" cy="230" rx="70" ry="56" fill="#F9A825"/><ellipse cx="120" cy="210" rx="10" ry="7" fill="#1F3D22" opacity=".25"/><ellipse cx="175" cy="250" rx="8" ry="6" fill="#1F3D22" opacity=".25"/><ellipse cx="255" cy="255" rx="55" ry="46" fill="#e6960f"/><ellipse cx="240" cy="240" rx="7" ry="5" fill="#1F3D22" opacity=".25"/></g>
        <path d="M170 174c-10-30-45-42-70-30 20 8 28 30 32 46" stroke="#3F9A45" stroke-width="6" stroke-linecap="round" fill="none"/>
        <path d="M180 174c8-32 44-46 70-34-21 8-30 32-33 48" stroke="#5CB962" stroke-width="6" stroke-linecap="round" fill="none"/>
        <path d="M176 90 C176 140 176 160 176 174" stroke="#3F9A45" stroke-width="6" stroke-linecap="round"/>
        <ellipse cx="176" cy="80" rx="14" ry="9" fill="#5CB962"/>
      </svg>
    </div>
  </div>
  <svg class="soil-divider" viewBox="0 0 1200 46" preserveAspectRatio="none" style="width:100%;height:46px;display:block"><path d="M0 20 C 200 46 400 0 600 20 C 800 40 1000 4 1200 20 L1200 46 L0 46 Z" fill="#fff"/></svg>
</section>
--}}

<!-- HERO SLIDER -->
@if ($banners->count())
<section class="hero hero-slider" id="heroSlider">
  @foreach ($banners as $i => $b)
  <div class="hero-slide {{ $i === 0 ? 'active' : '' }}" @if ($b->media_type !== 'video' && $b->url) style="background-image:url('{{ $b->url }}')" @endif>
    @if ($b->media_type === 'video' && $b->url)
    <video class="hero-slide-video" autoplay muted loop playsinline preload="metadata">
      <source src="{{ $b->url }}" type="video/mp4">
    </video>
    @elseif (!$b->url)
    <div class="hero-slide-bg fallback"></div>
    @endif
    <div class="container hero-inner">
      <div class="hero-slide-content">
        <div class="eyebrow" style="color:#B9D9AF">Fredian Farm</div>
        <h1>{{ $b->judul }}</h1>
        @if ($b->deskripsi)
        <p class="lead">{{ $b->deskripsi }}</p>
        @endif
        <div class="hero-actions">
          @if ($b->link_url)
          <a href="{{ $b->link_url }}" class="btn btn-accent" @if (preg_match('~^https?://~i', $b->link_url)) target="_blank" rel="noopener" @endif>{{ $b->link_text ?: 'Lihat Selengkapnya' }}</a>
          @endif
          @if ($b->link_url_2)
          <a href="{{ $b->link_url_2 }}" class="btn btn-ghost" style="border-color:rgba(255,255,255,.3);color:#fff" @if (preg_match('~^https?://~i', $b->link_url_2)) target="_blank" rel="noopener" @endif>{{ $b->link_text_2 ?: 'Pelajari Lebih Lanjut' }}</a>
          @endif
        </div>
      </div>
    </div>
  </div>
  @endforeach

  @if ($banners->count() > 1)
  <button class="hero-nav prev" id="heroPrev" aria-label="Sebelumnya">&lsaquo;</button>
  <button class="hero-nav next" id="heroNext" aria-label="Berikutnya">&rsaquo;</button>
  <div class="hero-dots" id="heroDots">
    @foreach ($banners as $i => $b)
    <span class="{{ $i === 0 ? 'active' : '' }}" data-slide="{{ $i }}"></span>
    @endforeach
  </div>
  @endif
  <svg class="soil-divider" viewBox="0 0 1200 46" preserveAspectRatio="none" style="width:100%;height:46px;display:block"><path d="M0 20 C 200 46 400 0 600 20 C 800 40 1000 4 1200 20 L1200 46 L0 46 Z" fill="#fff"/></svg>
</section>
@else
<section class="hero">
  <div class="container hero-inner">
    <div>
      <div class="eyebrow" style="color:#B9D9AF">Fredian Farm</div>
      <h1>Bibit kentang unggul untuk <em>panen terbaik</em> Anda.</h1>
      <p class="lead">Fredian Farm memproduksi bibit kentang kultur jaringan dan turunannya untuk petani, kelompok tani, dan distributor di seluruh Indonesia.</p>
      <div class="hero-actions">
        <a href="{{ route('produk.index') }}" class="btn btn-accent">Lihat Katalog Bibit</a>
        <a href="{{ route('cara-pesan') }}" class="btn btn-ghost" style="border-color:rgba(255,255,255,.3);color:#fff">Cara Pemesanan</a>
      </div>
    </div>
    <div class="hero-art">
      <svg viewBox="0 0 400 380" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:100%;height:100%">
        <ellipse cx="200" cy="340" rx="170" ry="24" fill="#173318"/>
        <g><ellipse cx="150" cy="230" rx="70" ry="56" fill="#F9A825"/><ellipse cx="120" cy="210" rx="10" ry="7" fill="#1F3D22" opacity=".25"/><ellipse cx="175" cy="250" rx="8" ry="6" fill="#1F3D22" opacity=".25"/><ellipse cx="255" cy="255" rx="55" ry="46" fill="#e6960f"/><ellipse cx="240" cy="240" rx="7" ry="5" fill="#1F3D22" opacity=".25"/></g>
        <path d="M170 174c-10-30-45-42-70-30 20 8 28 30 32 46" stroke="#3F9A45" stroke-width="6" stroke-linecap="round" fill="none"/>
        <path d="M180 174c8-32 44-46 70-34-21 8-30 32-33 48" stroke="#5CB962" stroke-width="6" stroke-linecap="round" fill="none"/>
        <path d="M176 90 C176 140 176 160 176 174" stroke="#3F9A45" stroke-width="6" stroke-linecap="round"/>
        <ellipse cx="176" cy="80" rx="14" ry="9" fill="#5CB962"/>
      </svg>
    </div>
  </div>
  <svg class="soil-divider" viewBox="0 0 1200 46" preserveAspectRatio="none" style="width:100%;height:46px;display:block"><path d="M0 20 C 200 46 400 0 600 20 C 800 40 1000 4 1200 20 L1200 46 L0 46 Z" fill="#fff"/></svg>
</section>
@endif

<!-- NILAI KAMI -->
<section>
  <div class="container">
    <div class="section-head center">
      <div class="eyebrow" style="justify-content:center">Kenapa Fredian Farm</div>
      <h2>Bibit sehat dan siap tanam, dari kebun sampai ke kebun Anda</h2>
    </div>
    <div class="scroll-hint">Geser untuk lihat semua →</div>
    <div class="grid value-scroller">
      <div class="value-card">
        <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 12l2 2 4-4M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <h4>Premium</h4>
        <p>Kualitas benih pilihan yang dipersiapkan secara optimal sebelum dikirim.</p>
      </div>
      <div class="value-card">
        <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M3 12h18M3 6h18M3 18h18"/></svg>
        <h4>Grading Ketat</h4>
        <p>Disortir berdasarkan ukuran dan berat agar seragam saat ditanam serentak.</p>
      </div>
      <div class="value-card">
        <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M3 3v18h18M8 13l3 3 6-7"/></svg>
        <h4>Konsultasi Tanam</h4>
        <p>Tim kami membantu rekomendasi varietas sesuai ketinggian dan musim tanam lokasi Anda.</p>
      </div>
      <div class="value-card">
        <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M3 7l9-4 9 4-9 4-9-4zM3 7v10l9 4 9-4V7"/></svg>
        <h4>Pengiriman Aman</h4>
        <p>Dikemas dengan ventilasi khusus agar bibit tetap segar sampai tujuan.</p>
      </div>
    </div>
  </div>
</section>

<!-- PRODUK UNGGULAN -->
<section class="tinted">
  <div class="container">
    <div class="section-head" style="display:flex;justify-content:space-between;align-items:flex-end;gap:20px;flex-wrap:wrap;margin-bottom:36px">
      <div>
        <div class="eyebrow">Katalog</div>
        <h2 style="margin-bottom:0">Produk unggulan bulan ini</h2>
      </div>
      <a href="{{ route('produk.index') }}" class="btn btn-ghost btn-sm">Lihat Semua Produk →</a>
    </div>
    <div class="grid grid-products">
      @foreach ($produks->take(3) as $p)
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
            <div class="prod-harga">{{ $p->hargaRangeLabel }}</div>
          </div>
        </div>
        <div class="prod-foot" style="padding:0 20px 18px;display:flex;gap:8px;flex-wrap:wrap">
          <button class="btn btn-accent btn-sm" onclick="event.stopPropagation();addToCart({{ $p->id }}, {{ $cartVarId ?? 'null' }}, '{{ addslashes($p->nama) }}', '{{ addslashes($cartVarNama) }}', {{ $cartHarga }}, '{{ $cartBerat }}', '{{ $cartStok }}');showToast('{{ addslashes($p->nama) }} ditambahkan')" style="flex:1">+ Keranjang</button>
          <a class="btn btn-primary btn-sm" href="{{ route('produk.show', $p->slug) }}" style="flex:1;text-align:center">Detail</a>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

<!-- CARA PESAN MINI -->
<section>
  <div class="container">
    <div class="section-head center">
      <div class="eyebrow" style="justify-content:center">Alur Sederhana</div>
      <h2>Dari pilih bibit sampai bibit diterima</h2>
    </div>
    <div class="scroll-hint">Geser untuk lihat tahapan berikutnya →</div>
    <div class="flow">
      <div class="flow-step"><div class="num">1</div><h4>Pilih Produk</h4><p>Jelajahi katalog, pilih varian & jumlah, klik + Keranjang atau Beli Langsung.</p></div>
      <div class="flow-step"><div class="num">2</div><h4>Checkout</h4><p>Isi nama, nomor WA, alamat. Pilih Transfer Bank atau COD.</p></div>
      <div class="flow-step"><div class="num">3</div><h4>Konfirmasi via WA</h4><p>Pesanan otomatis terkirim. Admin akan membalas dengan rincian biaya & estimasi kirim.</p></div>
      <div class="flow-step"><div class="num">4</div><h4>Pembayaran</h4><p>Transfer ke rekening yang diberikan admin, atau bayar di tempat (COD) saat barang tiba.</p></div>
      <div class="flow-step"><div class="num">5</div><h4>Pengiriman</h4><p>Bibit dikemas & dikirim via kargo. Admin akan bagikan nomor resi untuk dilacak.</p></div>
      <div class="flow-step"><div class="num">6</div><h4>Bibit Diterima</h4><p>Bibit sampai di kebun Anda, siap ditanam. Lacak status pesanan kapan saja via menu 📦.</p></div>
    </div>
    <div style="text-align:center;margin-top:30px">
      <a href="{{ route('cara-pesan') }}" class="btn btn-primary">Pelajari Selengkapnya</a>
    </div>
  </div>
</section>

<!-- ARTIKEL TERBARU -->
<section class="tinted">
  <div class="container">
    <div class="section-head" style="display:flex;justify-content:space-between;align-items:flex-end;gap:20px;flex-wrap:wrap;margin-bottom:36px">
      <div>
        <div class="eyebrow">Blog</div>
        <h2 style="margin-bottom:0">Artikel budidaya terbaru</h2>
      </div>
      <a href="{{ route('blog.index') }}" class="btn btn-ghost btn-sm">Semua Artikel →</a>
    </div>
    <div class="grid grid-articles">
      @foreach ($artikels->take(3) as $a)
      <div class="article-card">
        <div class="article-media" style="background:var(--green-soft)">
          @if ($a->image)
          <img src="{{ $a->image }}" alt="{{ $a->judul }}" loading="lazy">
          @else
          <svg viewBox="0 0 100 100" style="width:40%"><rect x="25" y="20" width="50" height="60" rx="4" fill="#F9A825" opacity=".5"/><line x1="35" y1="35" x2="65" y2="35" stroke="#1F3D22" stroke-width="2" opacity=".3"/><line x1="35" y1="45" x2="60" y2="45" stroke="#1F3D22" stroke-width="2" opacity=".3"/><line x1="35" y1="55" x2="55" y2="55" stroke="#1F3D22" stroke-width="2" opacity=".3"/></svg>
          @endif
        </div>
        <div class="article-body">
          <h4>{{ $a->judul }}</h4>
          <p>{{ $a->excerpt }}</p>
          <div class="article-meta">{{ $a->published_at ? $a->published_at->format('d M Y') : '' }} · <span class="cat">{{ $a->kategori->nama ?? 'Umum' }}</span></div>
          <a href="{{ route('blog.show', $a->slug) }}" class="article-link">Baca selengkapnya <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M13 6l6 6-6 6"/></svg></a>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

<!-- TESTIMONI -->
<section>
  <div class="container">
    <div class="section-head center">
      <div class="eyebrow" style="justify-content:center">Testimoni</div>
      <h2>Kata petani mitra kami</h2>
    </div>
    <div class="scroll-hint">Geser untuk baca lainnya →</div>
    <div class="grid testi-scroller">
      @foreach ($testimonis->take(3) as $t)
      <div class="test-card">
        <div class="stars">★★★★★</div>
        <p class="test-quote">"{{ $t->review }}"</p>
        <div class="test-person">
          <div class="avatar">{{ substr($t->nama, 0, 2) }}</div>
          <div><b>{{ $t->nama }}</b><span>{{ $t->daerah ?? '-' }}</span></div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

<!-- PARTNER -->
@if($mitras->isNotEmpty())
<section class="section-tight tinted">
  <div class="container">
    <p style="text-align:center;font-size:13px;letter-spacing:.08em;text-transform:uppercase;font-weight:700;color:var(--text-soft);margin-bottom:26px">Mitra Kami</p>
    <div style="display:flex;justify-content:center;gap:44px;flex-wrap:wrap;opacity:.75;font-family:'Fraunces',serif;font-weight:600;font-size:16px;color:var(--brown-earth)">
      @foreach ($mitras as $mitra)
      <span>{{ $mitra->nama }}</span>
      @endforeach
    </div>
  </div>
</section>
@endif

<!-- SOSIAL MEDIA -->
<section>
  <div class="container">
    <div class="section-head center">
      <div class="eyebrow" style="justify-content:center">Konten Edukasi</div>
      <h2>Ikuti keseharian kebun & tips budidaya kami</h2>
    </div>
    <div class="grid grid-2">
      <div class="value-card" style="border-color:#000;display:flex;flex-direction:column;gap:14px">
        <div style="display:flex;align-items:center;gap:12px">
          <div style="width:44px;height:44px;border-radius:12px;background:#000;display:flex;align-items:center;justify-content:center;flex:none">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="#fff"><path d="M16.6 5.8a4.6 4.6 0 01-3.3-1.4v9.9a4.9 4.9 0 11-4.9-4.9c.3 0 .5 0 .8.1v2.5a2.4 2.4 0 102 2.4V2h2.5a4.6 4.6 0 003.3 3.9v2.5a7 7 0 01-.4-2.6z"/></svg>
          </div>
          <div><h4 style="margin-bottom:0">TikTok @fredianfarm</h4><span style="font-size:13px;color:var(--text-soft);font-weight:700">27,9rb Pengikut · Channel Utama</span></div>
        </div>
        <p style="font-size:14.5px;margin:0">"Pertanian modern, berbagi ilmu, pengalaman & cerita seputar kultur jaringan, budidaya & pembibitan kentang."</p>
        <p style="font-size:13px;margin:0;color:var(--text-soft)">Nomor pemesanan dan Toko Online (TikTok Shop) tersedia langsung di bio profil kami.</p>
        <div style="display:flex;gap:10px;flex-wrap:wrap">
          <a class="btn btn-primary btn-sm" href="https://www.tiktok.com/@fredianfarm" target="_blank" rel="noopener">Ikuti di TikTok</a>
          <a class="btn btn-ghost btn-sm" href="https://www.tiktok.com/@fredianfarm/shop" target="_blank" rel="noopener">Buka Toko Online</a>
        </div>
      </div>
      <div class="value-card" style="display:flex;flex-direction:column;gap:14px">
        <div style="display:flex;align-items:center;gap:12px">
          <div style="width:44px;height:44px;border-radius:12px;background:linear-gradient(45deg,#F9A825,#e6960f,#8D6E63);display:flex;align-items:center;justify-content:center;flex:none">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="3.5"/><circle cx="17.5" cy="6.5" r="1"/></svg>
          </div>
          <div><h4 style="margin-bottom:0">Instagram @fredianfarm</h4><span style="font-size:13px;color:var(--text-soft);font-weight:700">3.240 Pengikut</span></div>
        </div>
        <p style="font-size:14.5px;margin:0">Dokumentasi foto kebun, testimoni mitra, dan pengumuman ketersediaan bibit terbaru.</p>
        <div><a class="btn btn-ghost btn-sm" href="https://www.instagram.com/fredianfarm" target="_blank" rel="noopener">Ikuti di Instagram</a></div>
      </div>
    </div>
  </div>
</section>

<!-- LOKASI -->
@php
    $settingValue = fn (string $key, $default = null) => optional($settings->get($key))->value ?? $default;
    $mapsEmbed = $settingValue('LOKASI_MAPS_EMBED', 'https://www.google.com/maps?q=Dieng,Wonosobo,Jawa%20Tengah&output=embed');
    $mapsLink = preg_replace('/[?&]output=embed$/', '', $mapsEmbed);
@endphp
<section class="dark">
  <div class="container lokasi-grid" style="align-items:center">
    <div>
      <div class="eyebrow" style="color:#B9D9AF">Kunjungi Kebun Kami</div>
      <h2>Kebun & gudang sortir di Sumberejo, Kec. Batur, Kab. Banjarnegara, Jawa Tengah</h2>
      <p>Terbuka untuk kunjungan kelompok tani dan dinas pertanian. Hubungi kami dulu untuk menjadwalkan kunjungan.</p>
      <a href="{{ route('kontak') }}" class="btn btn-accent">Lihat Kontak Lengkap</a>
    </div>
    <div class="map-embed" style="border-radius:var(--radius);overflow:hidden;height:240px">
      <iframe src="{{ $mapsEmbed }}" style="border:0;width:100%;height:100%" loading="lazy"></iframe>
    </div>
    <div class="map-fallback" style="height:240px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.15)">
      <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.8"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
      <p style="margin:0;color:#C7D6C4;font-size:13.5px">{{ $settingValue('ALAMAT', 'Dieng, Jawa Tengah') }}</p>
      <a class="btn btn-accent btn-sm" href="{{ $mapsLink }}" target="_blank" rel="noopener">Buka di Google Maps</a>
    </div>
  </div>
</section>
@endsection
