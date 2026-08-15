@extends('layouts.public')
@section('title', 'Visi & Misi — Fredian Farm')
@section('content')
@include('public._nav', ['active' => 'tentang'])
@php
    $settingValue = fn (string $key, $default = null) => optional($settings->get($key))->value ?? $default;
@endphp
<section class="section-tight tinted">
  <div class="container">
    <div class="breadcrumb"><a href="{{ route('home') }}">Beranda</a><span>/</span><a href="{{ route('about') }}">Tentang Kami</a><span>/</span><span>Visi & Misi</span></div>
    <div class="eyebrow">Tentang Kami</div>
    <h1>Visi & Misi</h1>
  </div>
</section>
<section>
  <div class="container">
    <div class="grid grid-2" style="align-items:start">
      <div>
        <h3>Visi</h3>
        <p style="font-size:16px">{{ $settingValue('VISI', 'Menjadi penyedia bibit kentang tepercaya nomor satu di Indonesia.') }}</p>
      </div>
      <div>
        <h3>Misi</h3>
        @forelse ($misi as $item)
        <div class="tag-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 6L9 17l-5-5"/></svg><p>{{ $item }}</p></div>
        @empty
        <p style="color:var(--text-soft)">Misi belum diisi.</p>
        @endforelse
      </div>
    </div>
  </div>
</section>
@endsection
