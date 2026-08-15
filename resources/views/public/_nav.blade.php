<nav class="nav">
  <div class="nav-inner">
    <a href="{{ route('home') }}" class="logo">
      <img src="{{ \App\Models\Setting::getValue('LOGO_URL', asset('images/logo.png')) }}" alt="{{ \App\Models\Setting::getValue('APP_NAME', 'Fredian Farm') }}" class="logo-img">
    </a>
    <ul class="nav-links">
      <li><a href="{{ route('home') }}" @if(($active ?? '') === 'home' || Request::routeIs('home')) class="active" @endif>Beranda</a></li>
      <li><a href="{{ route('produk.index') }}" @if(($active ?? '') === 'produk' || Request::routeIs('produk.*')) class="active" @endif>Produk</a></li>
      <li><a href="{{ route('blog.index') }}" @if(($active ?? '') === 'blog' || Request::routeIs('blog.*')) class="active" @endif>Blog</a></li>
      <li class="nav-dropdown">
        <a class="nav-dropdown-toggle" href="javascript:void(0)" onclick="toggleInfoMenu(event)" @if(in_array($active ?? '', ['tentang','cara-pesan','galeri','testimoni']) || Request::routeIs('about') || Request::routeIs('about.*') || Request::routeIs('cara-pesan') || Request::routeIs('galeri') || Request::routeIs('testimoni')) class="active" @endif>
          Info <span class="arrow">▾</span>
        </a>
        <div class="nav-dropdown-menu" id="infoMenu">
          <div class="nav-sub-wrap">
            @if(Request::routeIs('about') || Request::routeIs('about.*'))
              <a href="{{ route('about') }}" class="nav-sub-head active">Tentang Kami <span class="arrow">▸</span></a>
            @else
              <a href="{{ route('about') }}" class="nav-sub-head">Tentang Kami <span class="arrow">▸</span></a>
            @endif
            <div class="nav-submenu">
              <a href="{{ route('about.sejarah') }}" @if(Request::routeIs('about.sejarah')) class="active" @endif>Sejarah Perusahaan</a>
              <a href="{{ route('about.visi-misi') }}" @if(Request::routeIs('about.visi-misi')) class="active" @endif>Visi &amp; Misi</a>
              <a href="{{ route('about.lokasi') }}" @if(Request::routeIs('about.lokasi')) class="active" @endif>Lokasi</a>
              <a href="{{ route('about.sertifikasi') }}" @if(Request::routeIs('about.sertifikasi')) class="active" @endif>Sertifikasi &amp; Legalitas</a>
            </div>
          </div>
          <a href="{{ route('cara-pesan') }}" @if(Request::routeIs('cara-pesan')) class="active" @endif>Cara Pesan</a>
          <a href="{{ route('galeri') }}" @if(Request::routeIs('galeri')) class="active" @endif>Galeri</a>
          <a href="{{ route('testimoni') }}" @if(Request::routeIs('testimoni')) class="active" @endif>Testimoni</a>
        </div>
      </li>
      <li><a href="{{ route('faq') }}" @if(($active ?? '') === 'faq' || Request::routeIs('faq')) class="active" @endif>FAQ</a></li>
      <li><a href="{{ route('kontak') }}" @if(($active ?? '') === 'kontak' || Request::routeIs('kontak')) class="active" @endif>Kontak</a></li>
      <li class="nav-mobile-extra"><a href="#" onclick="openCart();return false">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align:-3px"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.7 13.4a2 2 0 002 1.6h9.7a2 2 0 002-1.6L23 6H6"/></svg>
        Keranjang</a></li>
      <li class="nav-mobile-extra"><a href="#" onclick="openTrack();return false">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align:-3px"><path d="M21 8l-9-5-9 5v8l9 5 9-5V8z"/><path d="M3.3 8l8.7 4.9L20.7 8M12 12.9V21"/></svg>
        Lacak Pesanan</a></li>
    </ul>
    <div class="nav-cta">
      <a class="nav-icon-link" href="#" onclick="toggleSearch(event);return false" title="Cari">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3"/></svg>
      </a>
      <a class="nav-icon-link" href="#" onclick="openTrack();return false" title="Lacak Pesanan">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 8l-9-5-9 5v8l9 5 9-5V8z"/><path d="M3.3 8l8.7 4.9L20.7 8M12 12.9V21"/></svg>
      </a>
      <a class="nav-icon-link" href="#" onclick="openCart();return false" title="Keranjang">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.7 13.4a2 2 0 002 1.6h9.7a2 2 0 002-1.6L23 6H6"/></svg>
        <span class="cart-badge">0</span>
      </a>
      <a class="btn btn-primary btn-sm" href="https://wa.me/{{ preg_replace('/[^0-9]/', '', \App\Models\Setting::getValue('NOMOR_WA', '6281234567890')) }}" target="_blank" rel="noopener">Chat Admin</a>
      <button class="burger"><span></span><span></span><span></span></button>
    </div>
  </div>
  <div class="nav-search" id="navSearch">
    <form method="GET" action="{{ route('cari') }}">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--text-soft)" stroke-width="2"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3"/></svg>
      <input type="text" name="q" placeholder="Cari produk atau artikel…" value="{{ request('q') }}">
      <button type="submit" class="btn btn-primary btn-sm">Cari</button>
    </form>
  </div>
</nav>
