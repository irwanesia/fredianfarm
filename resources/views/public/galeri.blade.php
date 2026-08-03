@php
$icons = [
    "foto_produk" => '<svg viewBox="0 0 120 120" style="width:50%;opacity:.6"><ellipse cx="60" cy="65" rx="32" ry="24" fill="#F9A825" opacity=".7"/><path d="M28 80c16-22 28-22 44 0" stroke="#3F9A45" stroke-width="5" fill="none" stroke-linecap="round"/><path d="M52 80c16-22 28-22 44 0" stroke="#2E7D32" stroke-width="5" fill="none" stroke-linecap="round"/><circle cx="60" cy="48" r="26" fill="#A1887F" opacity=".3"/></svg>',
    "foto_kegiatan" => '<svg viewBox="0 0 120 120" style="width:50%;opacity:.6"><circle cx="60" cy="35" r="14" fill="#F9A825" opacity=".5"/><ellipse cx="60" cy="68" rx="24" ry="18" fill="#F9A825" opacity=".4"/><line x1="60" y1="56" x2="60" y2="90" stroke="#5D4037" stroke-width="3" opacity=".5"/><line x1="42" y1="72" x2="28" y2="68" stroke="#5D4037" stroke-width="3" opacity=".4"/><line x1="78" y1="72" x2="92" y2="68" stroke="#5D4037" stroke-width="3" opacity=".4"/></svg>',
    "foto_lahan" => '<svg viewBox="0 0 120 120" style="width:50%;opacity:.6"><rect x="10" y="50" width="100" height="50" rx="4" fill="#A1887F" opacity=".4"/><line x1="10" y1="60" x2="110" y2="60" stroke="#2E7D32" stroke-width="2" opacity=".5"/><line x1="30" y1="50" x2="30" y2="100" stroke="#2E7D32" stroke-width="3" opacity=".3"/><line x1="60" y1="50" x2="60" y2="100" stroke="#2E7D32" stroke-width="3" opacity=".3"/><line x1="90" y1="50" x2="90" y2="100" stroke="#2E7D32" stroke-width="3" opacity=".3"/><path d="M20 10 Q40 0 60 10 Q80 20 100 10" stroke="#4CAF50" stroke-width="4" fill="none" opacity=".5"/></svg>',
    "tim" => '<svg viewBox="0 0 120 120" style="width:50%;opacity:.6"><circle cx="42" cy="35" r="11" fill="#F9A825" opacity=".5"/><circle cx="78" cy="35" r="11" fill="#F9A825" opacity=".5"/><ellipse cx="42" cy="65" rx="18" ry="14" fill="#F9A825" opacity=".35"/><ellipse cx="78" cy="65" rx="18" ry="14" fill="#F9A825" opacity=".35"/><line x1="56" y1="50" x2="56" y2="80" stroke="#5D4037" stroke-width="2.5" opacity=".4"/><line x1="64" y1="50" x2="64" y2="80" stroke="#5D4037" stroke-width="2.5" opacity=".4"/></svg>',
];
$defaultIcon = '<svg viewBox="0 0 120 120" style="width:50%;opacity:.6"><path d="M60 15 L95 40 L95 85 L60 105 L25 85 L25 40Z" fill="none" stroke="#4CAF50" stroke-width="4" stroke-linejoin="round" opacity=".5"/><circle cx="60" cy="55" r="14" fill="#F9A825" opacity=".4"/><line x1="60" y1="45" x2="60" y2="30" stroke="#4CAF50" stroke-width="2.5" opacity=".4"/><line x1="60" y1="65" x2="60" y2="80" stroke="#4CAF50" stroke-width="2.5" opacity=".4"/><line x1="46" y1="55" x2="34" y2="55" stroke="#4CAF50" stroke-width="2.5" opacity=".4"/><line x1="74" y1="55" x2="86" y2="55" stroke="#4CAF50" stroke-width="2.5" opacity=".4"/></svg>';
@endphp
@extends("layouts.public")
@section("title", "Galeri — Fredian Farm")
@section("content")
@include("public._nav", ["active" => "galeri"])
<section class="section-tight tinted">
  <div class="container">
    <div class="breadcrumb"><a href="{{ route("home") }}">Beranda</a><span>/</span><span>Galeri</span></div>
    <div class="eyebrow">Dokumentasi</div>
    <h1>Proses dari kebun sampai pengiriman</h1>
  </div>
</section>
<section>
  <div class="container">
    @if ($kategoris->count())
    <div style="display:flex;gap:8px;flex-wrap:wrap;margin-bottom:30px">
      <a href="{{ route("galeri") }}" class="btn-filter {{ !request("kategori") ? "active" : "" }}">Semua</a>
      @foreach ($kategoris as $k)
      <a href="{{ route("galeri", ["kategori" => $k]) }}" class="btn-filter {{ request("kategori") == $k ? "active" : "" }}">{{ str_replace("_", " ", ucwords($k)) }}</a>
      @endforeach
    </div>
    @endif

    @if ($galeris->count())
    <div class="galeri-grid">
      @foreach ($galeris as $i => $g)
      @php
        $isFeatured = $i === 0 && $galeris->count() >= 3;
        $icon = $icons[$g->kategori] ?? $defaultIcon;
      @endphp
      <div class="galeri-card {{ $isFeatured ? "galeri-featured" : "" }}">
        <div class="galeri-media">
          @if ($g->url)
          <img src="{{ $g->url }}" alt="{{ $g->judul }}" loading="lazy">
          @else
          <div class="galeri-placeholder">{!! $icon !!}</div>
          @endif
          <div class="galeri-overlay">
            <div class="galeri-overlay-content">
              <h4>{{ $g->judul ?? "Dokumentasi" }}</h4>
              @if ($g->deskripsi)
              <p>{{ $g->deskripsi }}</p>
              @endif
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    @else
    <div style="text-align:center;padding:80px 20px">
      <div style="margin-bottom:16px;color:var(--green-primary)">{!! $defaultIcon !!}</div>
      <h3 style="margin:0 0 6px;font-size:18px">Belum Ada Dokumentasi</h3>
      <p style="margin:0;color:var(--text-soft);font-size:14px">Admin belum menambahkan galeri. Pantau terus untuk update terbaru!</p>
    </div>
    @endif
  </div>
</section>
@endsection

@push("styles")
<style>
.galeri-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;}
.galeri-card{border-radius:var(--radius);overflow:hidden;position:relative;}
.galeri-card.galeri-featured{grid-column:span 2;grid-row:span 2;}
.galeri-media{position:relative;aspect-ratio:4/3;overflow:hidden;background:var(--green-soft);display:flex;align-items:center;justify-content:center;}
.galeri-featured .galeri-media{aspect-ratio:16/10;}
.galeri-media img{width:100%;height:100%;object-fit:cover;transition:transform .4s ease;}
.galeri-card:hover .galeri-media img{transform:scale(1.06);}
.galeri-placeholder{display:flex;align-items:center;justify-content:center;width:100%;height:100%;}
.galeri-overlay{position:absolute;inset:0;background:linear-gradient(0deg,rgba(0,0,0,.78) 0%,rgba(0,0,0,.05) 70%);display:flex;flex-direction:column;justify-content:flex-end;padding:20px;opacity:0;transition:opacity .3s ease;}
.galeri-card:hover .galeri-overlay{opacity:1;}
.galeri-overlay-content{background:rgba(0,0,0,.6);border-radius:10px;padding:10px 14px;max-width:100%;}
.galeri-overlay-content h4{margin:0 0 5px;font-size:16px;font-weight:800;color:#FFE14D;text-shadow:0 1px 2px rgba(0,0,0,.95);}
.galeri-overlay-content p{margin:0;font-size:13px;color:#fff;opacity:1;line-height:1.45;text-shadow:0 1px 2px rgba(0,0,0,.95);}
.btn-filter{display:inline-block;padding:8px 18px;border-radius:var(--radius);font-size:13px;font-weight:600;text-decoration:none;border:1.5px solid var(--line);color:var(--text);transition:all .2s;}
.btn-filter.active{background:var(--green-primary);color:#fff;border-color:var(--green-primary);}
.btn-filter:not(.active):hover{background:var(--green-soft);border-color:var(--green-primary);}
@media(max-width:760px){
  .galeri-grid{grid-template-columns:repeat(2,1fr);gap:12px;}
  .galeri-card.galeri-featured{grid-column:span 2;grid-row:span 1;}
}
@media(max-width:480px){
  .galeri-grid{grid-template-columns:1fr;gap:12px;}
  .galeri-card.galeri-featured{grid-column:span 1;grid-row:span 1;}
  .galeri-overlay{opacity:1;padding:16px;}
  .galeri-overlay-content h4{font-size:15px;}
}
</style>
@endpush
