@extends('layouts.public')
@section('title', 'Kontak — Fredian Farm')
@section('content')
@include('public._nav', ['active' => 'kontak'])
@if(session('success'))
<div class="toast">{{ session('success') }}</div>
@endif
<section class="section-tight tinted">
  <div class="container">
    <div class="breadcrumb"><a href="{{ route('home') }}">Beranda</a><span>/</span><span>Kontak</span></div>
    <div class="eyebrow">Hubungi Kami</div>
    <h1>Kami siap bantu kebutuhan bibit Anda</h1>
  </div>
</section>
<section>
  <div class="container grid grid-2" style="align-items:flex-start">
    <div>
      <h3>Informasi Kontak</h3>
      <div class="tag-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg><p>Jl. Raya Dieng No. 45, Dieng Kulon, Kabupaten Wonosobo, Jawa Tengah 56354</p></div>
      <div class="tag-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72c.13.96.36 1.9.7 2.81a2 2 0 01-.45 2.11L8 10a16 16 0 006 6l1.36-1.36a2 2 0 012.11-.45c.9.34 1.85.57 2.81.7A2 2 0 0122 16.92z"/></svg><p>0812-3456-7890 (WhatsApp & Telepon)</p></div>
      <div class="tag-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16v16H4z"/><path d="M22 6l-10 7L2 6"/></svg><p>halo@fredianfarm.co.id</p></div>
      <div class="tag-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg><p>Senin–Sabtu, 08.00–16.00 WIB</p></div>
      <div class="map-embed" style="border-radius:var(--radius);overflow:hidden;height:220px;margin-top:20px">
        <iframe src="https://www.google.com/maps?q=Dieng,Wonosobo,Jawa%20Tengah&output=embed" style="border:0;width:100%;height:100%" loading="lazy"></iframe>
      </div>
      <div class="map-fallback" style="height:150px;margin-top:20px;background:var(--green-soft)">
        <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="var(--green-primary)" stroke-width="1.8"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
        <p style="margin:0;color:var(--text-soft);font-size:13.5px">Dataran Tinggi Dieng, Jawa Tengah</p>
        <a class="btn btn-primary btn-sm" href="https://www.google.com/maps?q=Dieng,Wonosobo,Jawa+Tengah" target="_blank" rel="noopener">Buka di Google Maps</a>
      </div>
      <div style="background:var(--green-soft);border-radius:var(--radius);padding:18px 20px;margin-top:20px">
        <b style="font-size:13.5px">Channel utama kami ada di TikTok</b>
        <p style="font-size:13.5px;margin:6px 0 0">@fredianfarm · 27,9rb pengikut. Nomor pemesanan & Toko Online (TikTok Shop) tersedia di bio profil TikTok kami.</p>
      </div>
      <div class="social-row" style="margin-top:20px">
        @forelse ($mediaSosials as $ms)
          <a href="{{ $ms->url }}" target="_blank" rel="noopener" aria-label="{{ $ms->platform }}" style="background:var(--green-deep)">@include('partials.social-icon', ['platform' => $ms->platform, 'size' => 16])</a>
        @empty
          <span style="font-size:13.5px;color:var(--text-soft)">Media sosial kami dapat diakses melalui link di bio.</span>
        @endforelse
      </div>
    </div>
    <div>
      <h3>Formulir Kontak / RFQ</h3>
      <form method="POST" action="{{ route('kontak.store') }}">
        @csrf
        <x-honeypot />
        <div class="form-field">
          <label>Nama Lengkap</label>
          <input type="text" name="nama" required placeholder="Nama Anda" value="{{ old('nama') }}">
          @error('nama') <div style="color:#dc3545;font-size:12px;margin-top:4px">{{ $message }}</div> @enderror
        </div>
        <div class="form-field">
          <label>Email (opsional)</label>
          <input type="email" name="email" placeholder="email@example.com" value="{{ old('email') }}">
        </div>
        <div class="form-field">
          <label>Nomor WhatsApp</label>
          <input type="text" name="no_wa" required placeholder="08xx-xxxx-xxxx" value="{{ old('no_wa') }}">
          @error('no_wa') <div style="color:#dc3545;font-size:12px;margin-top:4px">{{ $message }}</div> @enderror
        </div>
        <div class="form-field">
          <label>Pesan / Kebutuhan</label>
          <textarea name="pesan" rows="4" required placeholder="Tuliskan kebutuhan Anda di sini...">{{ old('pesan') }}</textarea>
          @error('pesan') <div style="color:#dc3545;font-size:12px;margin-top:4px">{{ $message }}</div> @enderror
        </div>
        <button class="btn btn-primary" type="submit" style="width:100%">Kirim Pesan</button>
      </form>
    </div>
  </div>
</section>
@endsection
