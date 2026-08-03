@extends('layouts.public')
@section('title', 'Testimoni — Fredian Farm')
@section('content')
@include('public._nav', ['active' => 'testimoni'])
<section class="section-tight tinted">
  <div class="container">
    <div class="breadcrumb"><a href="{{ route('home') }}">Beranda</a><span>/</span><span>Testimoni</span></div>
    <div class="eyebrow">Cerita Mitra</div>
    <h1>Pengalaman petani menanam bibit kami</h1>
  </div>
</section>
<section>
  <div class="scroll-hint container" style="padding-bottom:0;margin-bottom:10px">Geser untuk baca lainnya →</div>
  <div class="container grid testi-scroller">
    @forelse ($testimonis as $t)
    <div class="test-card">
      <div class="stars">★★★★★</div>
      <p class="test-quote">"{{ $t->review }}"</p>
      <div class="test-person">
        <div class="avatar">{{ substr($t->nama, 0, 2) }}</div>
        <div><b>{{ $t->nama }}</b><span>{{ $t->daerah ?? '-' }}</span></div>
      </div>
    </div>
    @empty
    <div style="grid-column:1/-1;text-align:center;padding:60px 0;color:var(--text-soft)">Belum ada testimoni.</div>
    @endforelse
  </div>
</section>
@endsection
