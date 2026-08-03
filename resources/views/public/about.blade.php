@extends('layouts.public')
@section('title', 'Tentang Kami — Fredian Farm')
@section('content')
@include('public._nav', ['active' => 'tentang'])
<section class="section-tight tinted">
  <div class="container">
    <div class="breadcrumb"><a href="{{ route('home') }}">Beranda</a><span>/</span><span>Tentang Kami</span></div>
    <div class="eyebrow">Profil Perusahaan</div>
    <h1>Dari kebun keluarga menjadi mitra tani se-Nusantara</h1>
    <p style="max-width:620px;font-size:16px">Fredian Farm berdiri sejak 2012 di dataran tinggi Dieng, Jawa Tengah, memulai dari satu petak kebun kentang keluarga hingga kini memasok bibit ke lebih dari 800 mitra tani di Jawa, Sumatra, dan Sulawesi.</p>
  </div>
</section>
<section>
  <div class="container grid grid-2" style="align-items:center">
    <div>
      <h3>Sejarah Singkat</h3>
      <p>Bermula dari kebutuhan bibit unggul yang sulit didapat petani sekitar, pendiri Fredian Farm mulai menyeleksi dan mengembangbiakkan bibit kentang varietas lokal dan impor sejak 2012. Kini proses produksi telah tersertifikasi dan didukung laboratorium kultur jaringan mini.</p>
      <h3 style="margin-top:26px">Visi</h3>
      <p>Menjadi penyedia bibit kentang tepercaya nomor satu di Indonesia yang mendukung ketahanan pangan hortikultura.</p>
      <h3 style="margin-top:26px">Misi</h3>
      <div class="tag-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 6L9 17l-5-5"/></svg><p>Menyediakan bibit kentang bersertifikat dengan grading konsisten.</p></div>
      <div class="tag-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 6L9 17l-5-5"/></svg><p>Mendampingi petani mitra melalui edukasi budidaya berkelanjutan.</p></div>
      <div class="tag-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 6L9 17l-5-5"/></svg><p>Memperluas jangkauan distribusi ke seluruh sentra kentang Indonesia.</p></div>
    </div>
    <div style="background:var(--green-soft);border-radius:var(--radius);padding:40px;text-align:center">
      <svg viewBox="0 0 240 200" style="width:80%;margin:0 auto"><ellipse cx="120" cy="170" rx="100" ry="14" fill="#c9dbc2"/><rect x="40" y="90" width="160" height="70" rx="8" fill="#8D6E63"/><rect x="40" y="90" width="160" height="16" rx="4" fill="#6f5650"/><path d="M40 90l80-50 80 50" fill="none" stroke="#2E7D32" stroke-width="6" stroke-linecap="round"/><circle cx="120" cy="70" r="10" fill="#F9A825"/></svg>
      <p style="margin-top:14px;font-size:13.5px">Ilustrasi gudang sortir & fasilitas produksi Fredian Farm</p>
    </div>
  </div>
</section>
<section class="tinted">
  <div class="container">
    <div class="section-head center"><div class="eyebrow" style="justify-content:center">Legalitas & Sertifikat</div><h2>Terdaftar dan diawasi resmi</h2></div>
    <div class="grid grid-4">
      <div class="value-card" style="text-align:center"><div style="font-family:'JetBrains Mono',monospace;font-size:12px;color:var(--text-soft)">NIB</div><h4 style="font-size:15px">0812xxxxxxxx</h4></div>
      <div class="value-card" style="text-align:center"><div style="font-family:'JetBrains Mono',monospace;font-size:12px;color:var(--text-soft)">Sertifikat</div><h4 style="font-size:15px">Benih Bersertifikat BPSB</h4></div>
      <div class="value-card" style="text-align:center"><div style="font-family:'JetBrains Mono',monospace;font-size:12px;color:var(--text-soft)">Izin</div><h4 style="font-size:15px">Izin Usaha Pertanian</h4></div>
      <div class="value-card" style="text-align:center"><div style="font-family:'JetBrains Mono',monospace;font-size:12px;color:var(--text-soft)">Anggota</div><h4 style="font-size:15px">Asosiasi Benih Hortikultura</h4></div>
    </div>
  </div>
</section>
@endsection
