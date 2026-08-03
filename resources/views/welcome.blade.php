@extends('layouts.public')

@section('title', 'Fredian Farm')

@section('content')
<div class="hero-section text-white text-center py-5" style="background: linear-gradient(135deg, #2E7D32, #1B5E20);">
    <div class="container py-5">
        <h1 class="display-4 fw-bold mb-3">Bibit Kentang Bersertifikat Berkualitas</h1>
        <p class="lead mb-4">Granola, Atlantik, Medians — bibit unggul untuk hasil panen maksimal</p>
        <div class="d-flex justify-content-center gap-3">
            <a href="/produk" class="btn btn-warning btn-lg px-4">Lihat Produk</a>
            <a href="/blog" class="btn btn-outline-light btn-lg px-4">Baca Artikel</a>
        </div>
    </div>
</div>

<div class="container my-5">
    <div class="row text-center mb-5">
        <div class="col-12">
            <h2 class="fw-bold" style="color: #2E7D32;">Kenapa Memilih Fredian Farm?</h2>
            <p class="text-muted">Bibit kentang bersertifikat, pengalaman bertahun-tahun, terpercaya petani Indonesia</p>
        </div>
    </div>
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#2E7D32" stroke-width="1.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    </div>
                    <h5>Bersertifikat</h5>
                    <p class="text-muted small">Bibit bersertifikat dengan kualitas terjamin dan bebas penyakit.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#8D6E63" stroke-width="1.5"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </div>
                    <h5>Terpercaya</h5>
                    <p class="text-muted small">Telah dipercaya petani dan kelompok tani di berbagai daerah.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#F9A825" stroke-width="1.5"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
                    </div>
                    <h5>Hasil Unggul</h5>
                    <p class="text-muted small">Potensi hasil panen tinggi dengan bibit varietas unggul terbaik.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="py-5" style="background-color: #FAF7F0;">
    <div class="container text-center">
        <h2 class="fw-bold mb-3" style="color: #2E7D32;">Hubungi Kami</h2>
        <p class="mb-4">Pesan bibit kentang sekarang melalui WhatsApp</p>
        <a href="https://wa.me/628xxx" class="btn btn-success btn-lg px-5" target="_blank">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" class="me-2"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
            Hubungi WhatsApp
        </a>
    </div>
</div>
@endsection
