@extends('layouts.public')
@section('title', 'Cara Pemesanan — Fredian Farm')
@section('content')
@include('public._nav', ['active' => 'cara-pesan'])
<section class="section-tight tinted">
  <div class="container">
    <div class="breadcrumb"><a href="{{ route('home') }}">Beranda</a><span>/</span><span>Cara Pemesanan</span></div>
    <div class="eyebrow">Alur Pemesanan</div>
    <h1>Pilih, checkout, konfirmasi via WhatsApp - simpel tanpa ribet</h1>
    <p style="max-width:580px">Cukup tambahkan produk ke keranjang, isi data pemesanan, dan pilih metode pembayaran (Transfer Bank atau COD). Pesanan langsung terkirim ke admin kami via WhatsApp.</p>
  </div>
</section>

<section>
  <div class="container">
    <div class="section-head center">
      <div class="eyebrow" style="justify-content:center">Langkah Mudah</div>
      <h2>Cara pesan di Fredian Farm</h2>
    </div>
    <div class="scroll-hint">Geser untuk lihat tahapan berikutnya →</div>
    <div class="flow">
      <div class="flow-step"><div class="num">1</div><h4>Pilih Produk</h4><p>Buka halaman <a href="{{ route('produk.index') }}" style="color:var(--green-primary);font-weight:700">Produk</a>, pilih varian kemasan yang sesuai, atur jumlah, lalu klik <strong>+ Keranjang</strong> atau <strong>Beli Langsung</strong>.</p></div>
      <div class="flow-step"><div class="num">2</div><h4>Checkout</h4><p>Buka keranjang (🛒) lalu klik <strong>Checkout</strong>. Isi nama lengkap, nomor WhatsApp, dan alamat pengiriman lengkap.</p></div>
      <div class="flow-step"><div class="num">3</div><h4>Pilih Pembayaran</h4><p>Pilih metode: <strong>Transfer Bank</strong> (bayar dulu, barang dikirim setelah konfirmasi) atau <strong>COD</strong> (bayar saat barang sampai).</p></div>
      <div class="flow-step"><div class="num">4</div><h4>Kirim via WA</h4><p>Klik tombol kirim → otomatis terbuka WhatsApp dengan pesanan sudah terisi lengkap. Admin akan membalas konfirmasi.</p></div>
      <div class="flow-step"><div class="num">5</div><h4>Konfirmasi Admin</h4><p>Admin akan merinci total biaya + ongkos kirim. Untuk transfer, admin juga akan mengirimkan nomor rekening tujuan.</p></div>
      <div class="flow-step"><div class="num">6</div><h4>Pembayaran & Kirim</h4><p>Transfer sesuai nominal atau siapkan uang tunai untuk COD. Setelah itu, bibit dikemas dan dikirim ke alamat Anda.</p></div>
    </div>
  </div>
</section>

<section class="tinted">
  <div class="container">
    <div class="section-head center">
      <div class="eyebrow" style="justify-content:center">Metode Pembayaran</div>
      <h2>Pilih yang paling nyaman untuk Anda</h2>
    </div>
    <div class="grid grid-2" style="max-width:720px;margin:0 auto">
      <div class="value-card" style="text-align:center">
        <div style="font-size:36px;margin-bottom:10px">🏦</div>
        <h4>Transfer Bank</h4>
        <p style="font-size:14px">Bayar terlebih dahulu via transfer ke rekening yang disampaikan admin. Cocok untuk yang sudah terbiasa transfer.</p>
        <div style="font-size:12px;background:var(--green-soft);border-radius:8px;padding:8px 12px;color:var(--green-deep);font-weight:600">✅ Pesanan diproses setelah pembayaran dikonfirmasi</div>
      </div>
      <div class="value-card" style="text-align:center">
        <div style="font-size:36px;margin-bottom:10px">💵</div>
        <h4>COD (Bayar di Tempat)</h4>
        <p style="font-size:14px">Bayar saat barang sampai di alamat Anda. Tanpa ribet transfer, tanpa khawatir ditipu.</p>
        <div style="font-size:12px;background:var(--yellow-soft);border-radius:8px;padding:8px 12px;color:#8A5A00;font-weight:600">🚚 Barang dikirim segera setelah admin konfirmasi</div>
      </div>
    </div>
  </div>
</section>

<section>
  <div class="container">
    <div class="section-head center">
      <div class="eyebrow" style="justify-content:center">Order di Marketplace</div>
      <h2>Pesan juga lewat TikTok atau Shopee</h2>
    </div>
    <div style="max-width:720px;margin:0 auto;text-align:center">
      <p style="font-size:15px;line-height:1.7">Selain memesan melalui WhatsApp di website ini, Anda juga bisa membeli produk kami langsung dari toko resmi di platform TikTok dan Shopee. Pesanan dari kedua platform tetap tercatat dan diproses oleh tim Fredian Farm.</p>
      <div class="grid grid-2" style="margin-top:20px">
        <a href="{{ \App\Models\Setting::getValue('LINK_TIKTOK', 'https://www.tiktok.com/@fredianfarm') }}" target="_blank" rel="noopener" class="btn btn-tiktok" style="justify-content:center">🛍️ Pesan via TikTok</a>
        <a href="{{ \App\Models\Setting::getValue('LINK_SHOPEE', '#') }}" target="_blank" rel="noopener" class="btn btn-shopee" style="justify-content:center">🛍️ Pesan via Shopee</a>
      </div>
    </div>
  </div>
</section>

<section class="tinted">
  <div class="container">
    <div class="section-head center">
      <div class="eyebrow" style="justify-content:center">Lacak Pesanan</div>
      <h2>Pantau status pesanan Anda kapan saja</h2>
    </div>
    <div style="max-width:560px;margin:0 auto;text-align:center">
      <p>Setelah pesanan dikirim, Anda akan mendapat nomor resi dari admin. Gunakan menu <strong>📦 Lacak Pesanan</strong> di website untuk mengecek status terbaru, termasuk nomor resi dan link lacak paket.</p>
      <button class="btn btn-primary" onclick="openTrack()">📦 Lacak Pesanan Saya</button>
    </div>
  </div>
</section>

<section class="tinted">
  <div class="container grid grid-2">
    <div class="value-card">
      <h4>Permintaan Penawaran (RFQ)</h4>
      <p style="font-size:14.5px">Untuk kelompok tani, distributor, atau dinas pertanian yang memesan dalam jumlah besar, gunakan form RFQ untuk mendapat penawaran harga khusus dan estimasi ketersediaan stok.</p>
      <a href="{{ route('kontak') }}" class="btn btn-primary btn-sm">Isi Form RFQ</a>
    </div>
    <div class="value-card">
      <h4>Pengiriman Aman</h4>
      <p style="font-size:14.5px">Bibit dikemas dengan kemasan berventilasi khusus agar tetap segar selama perjalanan. Dikirim via ekspedisi kargo terpercaya dengan nomor resi yang bisa dilacak.</p>
    </div>
  </div>
</section>
@endsection
