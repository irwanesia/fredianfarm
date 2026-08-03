@extends('layouts.public')
@section('title', 'Kebijakan Privasi — Fredian Farm')
@section('content')
@include('public._nav', ['active' => 'privasi'])
<section class="section-tight">
  <div class="container" style="max-width:760px">
    <div class="breadcrumb"><a href="{{ route('home') }}">Beranda</a><span>/</span><span>Kebijakan Privasi</span></div>
    <h1>Kebijakan Privasi</h1>
    <p>Fredian Farm menghargai privasi setiap pengunjung dan pelanggan. Data yang Anda kirimkan melalui formulir kontak — seperti nama, nomor WhatsApp, dan kebutuhan pemesanan — hanya digunakan untuk keperluan komunikasi terkait pemesanan bibit dan tidak dibagikan ke pihak ketiga tanpa izin.</p>
    <p>Kami menggunakan cookie sederhana untuk keperluan analitik pengunjung situs guna meningkatkan kualitas layanan. Anda dapat menghubungi kami kapan saja melalui halaman Kontak untuk permintaan penghapusan data pribadi.</p>
  </div>
</section>
@endsection
