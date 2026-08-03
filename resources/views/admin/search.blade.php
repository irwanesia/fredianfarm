@extends('layouts.admin')

@section('title', 'Pencarian')

@section('content')
<div class="card">
  <div class="card-body text-center text-secondary py-5">
    <i class="ti ti-search fs-1 mb-2 d-block"></i>
    @if($q)
      <p>Hasil pencarian untuk: <strong>{{ $q }}</strong></p>
      <p class="small">Fitur pencarian akan diimplementasikan sepenuhnya pada tahap berikutnya.</p>
    @else
      <p>Masukkan kata kunci untuk mencari konten di admin.</p>
    @endif
  </div>
</div>
@endsection
