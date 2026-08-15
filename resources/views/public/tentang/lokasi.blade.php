@extends('layouts.public')
@section('title', 'Lokasi — Fredian Farm')
@section('content')
@include('public._nav', ['active' => 'tentang'])
@php
    $settingValue = fn (string $key, $default = null) => optional($settings->get($key))->value ?? $default;
    $mapsEmbed = $settingValue('LOKASI_MAPS_EMBED', 'https://www.google.com/maps?q=Dieng,Wonosobo,Jawa%20Tengah&output=embed');
    $mapsLink = preg_replace('/[?&]output=embed$/', '', $mapsEmbed);
@endphp
<section class="section-tight tinted">
  <div class="container">
    <div class="breadcrumb"><a href="{{ route('home') }}">Beranda</a><span>/</span><a href="{{ route('about') }}">Tentang Kami</a><span>/</span><span>Lokasi</span></div>
    <div class="eyebrow">Tentang Kami</div>
    <h1>Lokasi</h1>
  </div>
</section>
<section>
  <div class="container lokasi-grid" style="align-items:center">
    <div>
      <h3>Kebun & gudang sortir</h3>
      <p style="font-size:16px">{{ $settingValue('ALAMAT', 'Dieng, Jawa Tengah') }}</p>
      <p style="font-size:14.5px">Terbuka untuk kunjungan kelompok tani dan dinas pertanian. Hubungi kami dulu untuk menjadwalkan kunjungan.</p>
      @if ($settingValue('JAM_OPERASIONAL'))
      <div class="tag-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg><p>{{ $settingValue('JAM_OPERASIONAL') }}</p></div>
      @endif
      <a href="{{ route('kontak') }}" class="btn btn-primary" style="margin-top:8px">Lihat Kontak Lengkap</a>
    </div>
    <div>
      <div class="map-embed" style="border-radius:var(--radius);overflow:hidden;height:300px">
        <iframe src="{{ $mapsEmbed }}" style="border:0;width:100%;height:100%" loading="lazy"></iframe>
      </div>
      <div class="map-fallback" style="height:240px;background:var(--green-soft);margin-top:0">
        <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="var(--green-primary)" stroke-width="1.8"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
        <p style="margin:0;color:var(--text-soft);font-size:13.5px">{{ $settingValue('ALAMAT', 'Dieng, Jawa Tengah') }}</p>
        <a class="btn btn-primary btn-sm" href="{{ $mapsLink }}" target="_blank" rel="noopener">Buka di Google Maps</a>
      </div>
    </div>
  </div>
</section>
@endsection
