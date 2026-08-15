@extends('layouts.public')
@section('title', 'Sejarah Perusahaan — Fredian Farm')
@section('content')
@include('public._nav', ['active' => 'tentang'])
@php
    $settingValue = fn (string $key, $default = null) => optional($settings->get($key))->value ?? $default;
@endphp
<section class="section-tight tinted">
  <div class="container">
    <div class="breadcrumb"><a href="{{ route('home') }}">Beranda</a><span>/</span><a href="{{ route('about') }}">Tentang Kami</a><span>/</span><span>Sejarah Perusahaan</span></div>
    <div class="eyebrow">Tentang Kami</div>
    <h1>Sejarah Perusahaan</h1>
  </div>
</section>
<section>
  <div class="container grid grid-2" style="align-items:center">
    <div>
      <h3>Dari kebun keluarga menjadi mitra tani se-Nusantara</h3>
      <p style="font-size:16px">{{ $settingValue('SEJARAH', 'Fredian Farm berdiri sejak 2012 di dataran tinggi Dieng, Jawa Tengah.') }}</p>
    </div>
    <div style="background:var(--green-soft);border-radius:var(--radius);overflow:hidden;text-align:center">
      @php $sejarahImg = $settingValue('SEJARAH_IMAGE'); @endphp
      @if ($sejarahImg)
      <img src="{{ $sejarahImg }}" alt="Gudang sortir & fasilitas produksi Fredian Farm" style="width:100%;height:280px;object-fit:cover;display:block">
      @else
      <div style="padding:40px">
        <svg viewBox="0 0 240 200" style="width:80%;margin:0 auto"><ellipse cx="120" cy="170" rx="100" ry="14" fill="#c9dbc2"/><rect x="40" y="90" width="160" height="70" rx="8" fill="#8D6E63"/><rect x="40" y="90" width="160" height="16" rx="4" fill="#6f5650"/><path d="M40 90l80-50 80 50" fill="none" stroke="#2E7D32" stroke-width="6" stroke-linecap="round"/><circle cx="120" cy="70" r="10" fill="#F9A825"/></svg>
      </div>
      @endif
      <p style="padding:14px 20px 16px;margin:0;font-size:13.5px">Gudang sortir & fasilitas produksi Fredian Farm</p>
    </div>
  </div>
</section>
@endsection
