@extends('layouts.public')
@section('title', 'Sertifikasi & Legalitas — Fredian Farm')
@section('content')
@include('public._nav', ['active' => 'tentang'])
@php
    $settingValue = fn (string $key, $default = null) => optional($settings->get($key))->value ?? $default;
@endphp
<section class="section-tight tinted">
  <div class="container">
    <div class="breadcrumb"><a href="{{ route('home') }}">Beranda</a><span>/</span><a href="{{ route('about') }}">Tentang Kami</a><span>/</span><span>Sertifikasi & Legalitas</span></div>
    <div class="eyebrow">Tentang Kami</div>
    <h1>Sertifikasi & Legalitas</h1>
  </div>
</section>
<section>
  <div class="container">
    <div class="section-head center"><div class="eyebrow" style="justify-content:center">Legalitas & Sertifikat</div><h2>Terdaftar dan diawasi resmi</h2></div>
    <div class="grid grid-4">
      <div class="value-card" style="text-align:center"><div style="font-family:'JetBrains Mono',monospace;font-size:12px;color:var(--text-soft)">NIB</div><h4 style="font-size:15px">{{ $settingValue('NIB', '0812xxxxxxxx') }}</h4></div>
      <div class="value-card" style="text-align:center"><div style="font-family:'JetBrains Mono',monospace;font-size:12px;color:var(--text-soft)">Sertifikat</div><h4 style="font-size:15px">{{ $settingValue('SERTIFIKAT', 'Benih Bersertifikat BPSB') }}</h4></div>
      <div class="value-card" style="text-align:center"><div style="font-family:'JetBrains Mono',monospace;font-size:12px;color:var(--text-soft)">Izin</div><h4 style="font-size:15px">{{ $settingValue('IZIN', 'Izin Usaha Pertanian') }}</h4></div>
      <div class="value-card" style="text-align:center"><div style="font-family:'JetBrains Mono',monospace;font-size:12px;color:var(--text-soft)">Anggota</div><h4 style="font-size:15px">{{ $settingValue('ANGGOTA', 'Asosiasi Benih Hortikultura') }}</h4></div>
    </div>
  </div>
</section>
@endsection
