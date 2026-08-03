@extends('layouts.public')
@section('title', 'Blog — Fredian Farm')
@section('content')
@include('public._nav', ['active' => 'blog'])
<section class="section-tight tinted">
  <div class="container">
    <div class="breadcrumb"><a href="{{ route('home') }}">Beranda</a><span>/</span><span>Blog</span></div>
    <div class="eyebrow">Blog Budidaya</div>
    <h1>Panduan & wawasan seputar kentang</h1>
  </div>
</section>
<section>
  <div class="container">
    <div style="display:flex;gap:10px;flex-wrap:wrap;margin-bottom:30px">
      <a href="{{ route('blog.index') }}" class="btn btn-sm {{ !request('kategori') ? 'btn-primary' : 'btn-ghost' }}">Semua</a>
      @foreach ($kategoris as $k)
      <a href="{{ route('blog.index', ['kategori' => $k->slug]) }}" class="btn btn-sm {{ request('kategori') == $k->slug ? 'btn-primary' : 'btn-ghost' }}">{{ $k->nama }}</a>
      @endforeach
    </div>
    <div class="grid grid-articles">
      @forelse ($artikels as $a)
      <a href="{{ route('blog.show', $a->slug) }}" class="article-card">
        <div class="article-media" style="background:var(--green-soft)">
          @if ($a->image)
          <img src="{{ $a->image }}" alt="{{ $a->judul }}" loading="lazy">
          @else
          <svg viewBox="0 0 100 100" style="width:40%"><rect x="25" y="20" width="50" height="60" rx="4" fill="#F9A825" opacity=".5"/><line x1="35" y1="35" x2="65" y2="35" stroke="#1F3D22" stroke-width="2" opacity=".3"/><line x1="35" y1="45" x2="60" y2="45" stroke="#1F3D22" stroke-width="2" opacity=".3"/><line x1="35" y1="55" x2="55" y2="55" stroke="#1F3D22" stroke-width="2" opacity=".3"/></svg>
          @endif
        </div>
        <div class="article-body">
          <span class="badge-kat">{{ $a->kategori->nama ?? 'Umum' }}</span>
          <h4>{{ $a->judul }}</h4>
          <p>{{ $a->excerpt ?? $a->judul }}</p>
          <div class="article-meta">{{ $a->published_at ? $a->published_at->format('d M Y') : '' }}</div>
        </div>
      </a>
      @empty
      <div style="grid-column:1/-1;text-align:center;padding:60px 0;color:var(--text-soft)">Belum ada artikel.</div>
      @endforelse
    </div>
    <div style="margin-top:40px">{{ $artikels->links() }}</div>
  </div>
</section>
@endsection
