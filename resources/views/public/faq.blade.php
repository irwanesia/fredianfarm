@extends('layouts.public')
@section('title', 'FAQ — Fredian Farm')
@php
    $faqJson = [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => $faqs->map(fn ($f) => [
            '@type' => 'Question',
            'name' => $f->pertanyaan,
            'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f->jawaban],
        ])->values()->all(),
    ];
@endphp
@push('schema')
<script type="application/ld+json">{!! json_encode($faqJson, JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_QUOT | JSON_HEX_APOS) !!}</script>
@endpush
@section('content')

@include('public._nav', ['active' => 'faq'])
<section class="section-tight tinted">
  <div class="container">
    <div class="breadcrumb"><a href="{{ route('home') }}">Beranda</a><span>/</span><span>FAQ</span></div>
    <div class="eyebrow">Bantuan</div>
    <h1>Pertanyaan yang sering diajukan</h1>
  </div>
</section>
<section>
  <div class="container" style="max-width:760px">
    @forelse ($faqs as $f)
    <div class="faq-item" style="border-bottom:1px solid var(--line)">
      <div class="faq-q" style="display:flex;justify-content:space-between;align-items:center;padding:20px 4px;cursor:pointer;font-weight:700;font-size:15.5px">
        <span>{{ $f->pertanyaan }}</span>
        <span class="plus" style="transition:.2s;color:var(--green-primary);font-size:20px">+</span>
      </div>
      <div class="faq-a" style="max-height:0;overflow:hidden;transition:.25s ease;font-size:14.5px">
        <div class="faq-a-inner" style="padding:0 4px 20px;color:var(--text-soft)">{{ $f->jawaban }}</div>
      </div>
    </div>
    @empty
    <div style="text-align:center;padding:60px 0;color:var(--text-soft)">Belum ada FAQ.</div>
    @endforelse
  </div>
</section>
@endsection
