<nav class="nav">
  <div class="nav-inner">
    <a href="{{ route('home') }}" class="logo">
      <img src="{{ asset('images/logo.png') }}" alt="Fredian Farm" class="logo-img">
    </a>
    <ul class="nav-links">
      <li><a href="{{ route('home') }}" @if(($active ?? '') === 'home' || Request::routeIs('home')) class="active" @endif>Beranda</a></li>
      <li><a href="{{ route('produk.index') }}" @if(($active ?? '') === 'produk' || Request::routeIs('produk.*')) class="active" @endif>Produk</a></li>
      <li><a href="{{ route('blog.index') }}" @if(($active ?? '') === 'blog' || Request::routeIs('blog.*')) class="active" @endif>Blog</a></li>
      <li class="nav-dropdown">
        <a class="nav-dropdown-toggle" href="javascript:void(0)" onclick="toggleInfoMenu(event)" @if(in_array($active ?? '', ['tentang','cara-pesan','galeri','testimoni']) || Request::routeIs('about') || Request::routeIs('cara-pesan') || Request::routeIs('galeri') || Request::routeIs('testimoni')) class="active" @endif>
          Info <span class="arrow">▾</span>
        </a>
        <div class="nav-dropdown-menu" id="infoMenu">
          <a href="{{ route('about') }}" @if(Request::routeIs('about')) class="active" @endif>Tentang Kami</a>
          <a href="{{ route('cara-pesan') }}" @if(Request::routeIs('cara-pesan')) class="active" @endif>Cara Pesan</a>
          <a href="{{ route('galeri') }}" @if(Request::routeIs('galeri')) class="active" @endif>Galeri</a>
          <a href="{{ route('testimoni') }}" @if(Request::routeIs('testimoni')) class="active" @endif>Testimoni</a>
        </div>
      </li>
      <li><a href="{{ route('faq') }}" @if(($active ?? '') === 'faq' || Request::routeIs('faq')) class="active" @endif>FAQ</a></li>
      <li><a href="{{ route('kontak') }}" @if(($active ?? '') === 'kontak' || Request::routeIs('kontak')) class="active" @endif>Kontak</a></li>
      <li class="nav-mobile-extra"><a href="#" onclick="openCart();return false">🛒 Keranjang</a></li>
      <li class="nav-mobile-extra"><a href="#" onclick="openTrack();return false">📦 Lacak Pesanan</a></li>
    </ul>
    <div class="nav-cta">
      <a class="nav-icon-link" href="{{ route('cari') }}" title="Cari">🔍</a>
      <a class="nav-icon-link" href="#" onclick="openTrack();return false" title="Lacak Pesanan">📦</a>
      <a class="nav-icon-link" href="#" onclick="openCart();return false" title="Keranjang">
        🛒
        <span class="cart-badge">0</span>
      </a>
      <a class="btn btn-primary btn-sm" href="https://wa.me/{{ preg_replace('/[^0-9]/', '', \App\Models\Setting::getValue('NOMOR_WA', '6281234567890')) }}" target="_blank" rel="noopener">Chat Admin</a>
      <button class="burger"><span></span><span></span><span></span></button>
    </div>
  </div>
</nav>
