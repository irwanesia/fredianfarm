@extends("layouts.public")
@section("title", $artikel->judul . " — Fredian Farm")
@section("meta_head")
    @php
        $settingValue = fn (string $key, $default = null) => optional($settings->get($key))->value ?? $default;
    @endphp
    <meta name="description" content="{{ $artikel->meta_description ?: ($artikel->excerpt ?: ($settingValue('META_DESCRIPTION', 'Produsen dan distributor bibit kentang G-0, G-0 MZ, Granola L, dan G-0 Plus dari Dieng, Jawa Tengah.'))) }}">
    <meta name="robots" content="index, follow">
    <meta property="og:type" content="article">
    <meta property="og:site_name" content="{{ $settingValue('APP_NAME', 'Fredian Farm') }}">
    <meta property="og:title" content="{{ $artikel->meta_title ?: ($artikel->judul . ' — Fredian Farm') }}">
    <meta property="og:description" content="{{ $artikel->meta_description ?: ($artikel->excerpt ?: ($settingValue('META_DESCRIPTION', ''))) }}">
    <meta property="og:url" content="{{ url()->current() }}">
    @if($artikel->image)
    <meta property="og:image" content="{{ url($artikel->image) }}">
    @elseif(!empty($settingValue('OG_IMAGE')))
    <meta property="og:image" content="{{ $settingValue('OG_IMAGE') }}">
    @endif
@endsection
@php
    $articleJson = [
        '@context' => 'https://schema.org',
        '@type' => 'Article',
        'headline' => $artikel->judul,
        'description' => $artikel->meta_description ?: ($artikel->excerpt ?: Str::limit(strip_tags($artikel->konten ?? ''), 200)),
        'mainEntityOfPage' => ['@type' => 'WebPage', '@id' => url()->current()],
        'datePublished' => $artikel->published_at ? $artikel->published_at->toIso8601String() : $artikel->created_at->toIso8601String(),
        'dateModified' => ($artikel->updated_at ?: $artikel->created_at)->toIso8601String(),
        'author' => ['@type' => 'Person', 'name' => $artikel->user->name ?? 'Tim Fredian Farm'],
        'publisher' => ['@type' => 'Organization', 'name' => $settingValue('APP_NAME', 'Fredian Farm')],
    ];
    if ($artikel->image) {
        $articleJson['image'] = url($artikel->image);
    }
    if ($faqs->count()) {
        $articleJson['mainEntity'] = ['@type' => 'FAQPage', 'mainEntity' => $faqs->map(fn ($f) => ['@type' => 'Question', 'name' => $f->pertanyaan, 'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f->jawaban]])->values()->all()];
    }
    $blogBreadcrumbJson = [
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Beranda', 'item' => url('/')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Blog', 'item' => route('blog.index')],
            ['@type' => 'ListItem', 'position' => 3, 'name' => $artikel->judul, 'item' => url()->current()],
        ],
    ];
@endphp
@push('schema')
<script type="application/ld+json">{!! json_encode($articleJson, JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_QUOT | JSON_HEX_APOS) !!}</script>
<script type="application/ld+json">{!! json_encode($blogBreadcrumbJson, JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_QUOT | JSON_HEX_APOS) !!}</script>
@endpush
@section("content")
@include("public._nav", ["active" => "blog"])
<section class="section-tight">
  <div class="container">
    <div class="breadcrumb"><a href="{{ route("home") }}">Beranda</a><span>/</span><a href="{{ route("blog.index") }}">Blog</a><span>/</span><span>{{ $artikel->judul }}</span></div>

    <div class="blog-detail-layout">
      <div class="blog-detail-main">
        <span class="badge-kat">{{ $artikel->kategori->nama ?? "Umum" }}</span>
        <h1 style="font-size:28px;margin:10px 0 6px">{{ $artikel->judul }}</h1>
        <div class="article-meta" style="margin-bottom:24px">{{ $artikel->published_at ? $artikel->published_at->format("d M Y") : "" }} · oleh {{ $artikel->user->name ?? "Tim Fredian Farm" }}</div>

        @if ($artikel->gambar)
        <div style="margin-bottom:24px">
          <img src="{{ $artikel->gambar }}" alt="{{ $artikel->judul }}" style="width:100%;border-radius:var(--radius);display:block">
        </div>
        @endif

        <div class="blog-content">{!! $artikel->konten !!}</div>
      </div>

      <aside class="blog-detail-sidebar">
        <div class="sidebar-card">
          <h4 class="sidebar-title">Blog Terbaru</h4>
          @forelse ($artikelTerbaru as $a)
          <a href="{{ route("blog.show", $a->slug) }}" class="sidebar-link">
            <span class="sidebar-link-title">{{ $a->judul }}</span>
            <span class="sidebar-link-meta">{{ $a->published_at ? $a->published_at->format("d M Y") : "" }}</span>
          </a>
          @empty
          <p style="font-size:14px;color:var(--text-soft);margin:0">Belum ada artikel.</p>
          @endforelse
        </div>

        <div class="sidebar-card">
          <h4 class="sidebar-title">Artikel Populer</h4>
          @forelse ($artikelPopuler as $a)
          <a href="{{ route("blog.show", $a->slug) }}" class="sidebar-link">
            <span class="sidebar-link-title">{{ $a->judul }}</span>
            <span class="sidebar-link-meta">{{ $a->kategori->nama ?? "Umum" }}</span>
          </a>
          @empty
          <p style="font-size:14px;color:var(--text-soft);margin:0">Belum ada artikel.</p>
          @endforelse
        </div>
      </aside>
    </div>

    @if ($faqs->count())
    <div style="margin-top:50px;padding-top:30px;border-top:1px solid var(--line)">
      <h3>FAQ Seputar Topik Ini</h3>
      @foreach ($faqs as $f)
      <div class="faq-item">
        <div class="faq-q"><span>{{ $f->pertanyaan }}</span><span class="plus">+</span></div>
        <div class="faq-a" style="max-height:0;overflow:hidden;transition:.25s ease;font-size:14.5px"><div class="faq-a-inner" style="padding:0 4px 20px;color:var(--text-soft)">{{ $f->jawaban }}</div></div>
      </div>
      @endforeach
    </div>
    @endif

    @if ($artikelTerkait->count())
    <div style="margin-top:50px">
      <h3>Artikel Terkait</h3>
      <div class="grid grid-articles">
        @foreach ($artikelTerkait as $a)
        <div class="article-card">
          <div class="article-media" style="background:var(--green-soft)">
            @if ($a->image)
            <img src="{{ $a->image }}" alt="{{ $a->judul }}" loading="lazy">
            @else
            <svg viewBox="0 0 100 100" style="width:40%"><rect x="25" y="20" width="50" height="60" rx="4" fill="#F9A825" opacity=".5"/><line x1="35" y1="35" x2="65" y2="35" stroke="#1F3D22" stroke-width="2" opacity=".3"/><line x1="35" y1="45" x2="60" y2="45" stroke="#1F3D22" stroke-width="2" opacity=".3"/><line x1="35" y1="55" x2="55" y2="55" stroke="#1F3D22" stroke-width="2" opacity=".3"/></svg>
            @endif
          </div>
          <div class="article-body">
            <h4>{{ $a->judul }}</h4>
            <p>{{ $a->excerpt ?? "" }}</p>
            <div class="article-meta">{{ $a->published_at ? $a->published_at->format("d M Y") : "" }} · <span class="cat">{{ $a->kategori->nama ?? "Umum" }}</span></div>
            <a href="{{ route("blog.show", $a->slug) }}" class="article-link">Baca selengkapnya <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M13 6l6 6-6 6"/></svg></a>
          </div>
        </div>
        @endforeach
      </div>
    </div>
    @endif
  </div>
</section>
@endsection
