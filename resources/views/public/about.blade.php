@extends('layouts.public')
@section('title', 'Tentang Kami — Fredian Farm')
@section('content')
@include('public._nav', ['active' => 'tentang'])
@php
    $settingValue = fn (string $key, $default = null) => optional($settings->get($key))->value ?? $default;
@endphp
<section class="section-tight tinted">
  <div class="container">
    <div class="breadcrumb"><a href="{{ route('home') }}">Beranda</a><span>/</span><span>Tentang Kami</span></div>
    <div class="eyebrow">Profil Perusahaan</div>
    <h1>Mengenal Fredian Farm lebih dekat</h1>
    <p style="max-width:640px;font-size:16px">{{ $settingValue('SEJARAH', 'Fredian Farm berdiri sejak 2012 di dataran tinggi Dieng, Jawa Tengah.') }}</p>
  </div>
</section>
<section>
  <div class="container">
    <div class="grid grid-2">
      <a href="{{ route('about.sejarah') }}" class="value-card" style="display:block;text-decoration:none">
        <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 8v4l3 3M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <h4>Sejarah Perusahaan</h4>
        <p>Perjalanan Fredian Farm sejak kebun pertama di Dieng hingga menjadi mitra tani se-Nusantara.</p>
        <span style="color:var(--green-primary);font-weight:700;font-size:14px">Baca selengkapnya →</span>
      </a>
      <a href="{{ route('about.visi-misi') }}" class="value-card" style="display:block;text-decoration:none">
        <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7z"/><circle cx="12" cy="12" r="3"/></svg>
        <h4>Visi & Misi</h4>
        <p>Arah dan tujuan kami dalam mendukung ketahanan pangan hortikultura nasional.</p>
        <span style="color:var(--green-primary);font-weight:700;font-size:14px">Baca selengkapnya →</span>
      </a>
      <a href="{{ route('about.lokasi') }}" class="value-card" style="display:block;text-decoration:none">
        <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
        <h4>Lokasi</h4>
        <p>{{ $settingValue('ALAMAT', 'Dieng, Jawa Tengah') }}</p>
        <span style="color:var(--green-primary);font-weight:700;font-size:14px">Lihat peta →</span>
      </a>
      <a href="{{ route('about.sertifikasi') }}" class="value-card" style="display:block;text-decoration:none">
        <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 12l2 2 4-4M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <h4>Sertifikasi & Legalitas</h4>
        <p>NIB, sertifikat benih, dan izin usaha yang menaungi setiap batch produksi kami.</p>
        <span style="color:var(--green-primary);font-weight:700;font-size:14px">Baca selengkapnya →</span>
      </a>
    </div>
  </div>
</section>
@endsection
