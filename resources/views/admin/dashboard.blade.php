@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="row row-cards mb-3">
    <div class="col-sm-6 col-lg-3">
        <div class="card"><div class="card-body d-flex align-items-center gap-3">
            <div class="kpi-icon" style="background:var(--brand-green)"><i class="ti ti-shopping-bag"></i></div>
            <div><div class="text-secondary" style="font-size:.78rem">Total Produk</div><div style="font-size:1.4rem;font-weight:800">{{ $totalProduk }}</div></div>
        </div></div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card"><div class="card-body d-flex align-items-center gap-3">
            <div class="kpi-icon" style="background:#8D6E63"><i class="ti ti-article"></i></div>
            <div><div class="text-secondary" style="font-size:.78rem">Artikel Dipublikasi</div><div style="font-size:1.4rem;font-weight:800">{{ $artikelPublished }}</div></div>
        </div></div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card"><div class="card-body d-flex align-items-center gap-3">
            <div class="kpi-icon" style="background:#F9A825"><i class="ti ti-mail"></i></div>
            <div><div class="text-secondary" style="font-size:.78rem">Pesan Masuk Baru</div><div style="font-size:1.4rem;font-weight:800">{{ $pesanBaru }}</div></div>
        </div></div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card"><div class="card-body d-flex align-items-center gap-3">
            <div class="kpi-icon" style="background:#000"><i class="ti ti-brand-tiktok"></i></div>
            <div><div class="text-secondary" style="font-size:.78rem">Pengikut TikTok</div><div style="font-size:1.4rem;font-weight:800">27,9rb</div></div>
        </div></div>
    </div>
</div>

<div class="row row-cards mb-3">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Pesan Masuk & Artikel Terbit (14 Hari Terakhir)</h3></div>
            <div class="card-body"><div id="chartTraffic" style="min-height:250px"></div></div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Produk Paling Diminati</h3></div>
            <div class="card-body p-0">
                @forelse ($produks as $p)
                <div class="d-flex align-items-center justify-content-between px-3 py-2 border-bottom">
                    <div>
                        <div style="font-weight:600;font-size:.88rem">{{ $p->nama }}</div>
                        <div class="text-secondary" style="font-size:.72rem">{{ $p->kategori->nama ?? '-' }}</div>
                    </div>
                    @php
                        $stokClass = match($p->stok_status) {
                            'tersedia' => 'badge-stok-tersedia',
                            'terbatas' => 'badge-stok-terbatas',
                            default => 'badge-stok-preorder',
                        };
                        $stokLabel = match($p->stok_status) {
                            'tersedia' => 'Tersedia',
                            'terbatas' => 'Terbatas',
                            'habis' => 'Pre-order',
                            default => ucfirst($p->stok_status ?? ''),
                        };
                    @endphp
                    <span class="badge {{ $stokClass }}">{{ $stokLabel }}</span>
                </div>
                @empty
                <div class="text-center text-secondary py-3">Belum ada produk.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<div class="row row-cards">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h3 class="card-title">Artikel Terbaru</h3>
                <a href="{{ route('admin.artikel.index') }}" class="text-secondary" style="font-size:.8rem">Lihat Semua</a>
            </div>
            <div class="card-body p-0">
                @forelse ($artikels as $a)
                <div class="d-flex align-items-center justify-content-between px-3 py-2 border-bottom">
                    <div>
                        <div style="font-weight:600;font-size:.86rem">{{ $a->judul }}</div>
                        <div class="text-secondary" style="font-size:.72rem">{{ $a->kategori->nama ?? '-' }} · {{ $a->published_at ? $a->published_at->format('d M Y') : '-' }}</div>
                    </div>
                    <span class="badge @if($a->is_published) bg-green-lt @else bg-yellow-lt @endif">{{ $a->is_published ? 'Publish' : 'Draft' }}</span>
                </div>
                @empty
                <div class="text-center text-secondary py-3">Belum ada artikel.</div>
                @endforelse
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h3 class="card-title">Kontak Masuk Terbaru</h3>
                <a href="#" class="text-secondary" style="font-size:.8rem">Lihat Semua</a>
            </div>
            <div class="card-body p-0">
                @forelse ($kontaks as $k)
                @php
                    $statusLead = $k->dibaca ? 'Selesai' : 'Baru';
                    $leadClass = $k->dibaca ? 'bg-green-lt' : 'bg-red-lt';
                @endphp
                <div class="d-flex align-items-center justify-content-between px-3 py-2 border-bottom">
                    <div>
                        <div style="font-weight:600;font-size:.86rem">{{ $k->nama }}</div>
                        <div class="text-secondary" style="font-size:.72rem">{{ Str::limit($k->pesan, 40) }} · {{ $k->created_at->format('d M Y') }}</div>
                    </div>
                    <span class="badge {{ $leadClass }}">{{ $statusLead }}</span>
                </div>
                @empty
                <div class="text-center text-secondary py-3">Belum ada kontak masuk.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    if (typeof ApexCharts !== 'undefined') {
        var chartOptions = {
            chart: { type: 'area', height: 250, toolbar: { show: false }, fontFamily: 'Inter' },
            series: [
                { name: 'Pesan Masuk', data: @json($chartKontak) },
                { name: 'Artikel Terbit', data: @json($chartArtikel) }
            ],
            colors: ['#F9A825', '#2E7D32'],
            stroke: { curve: 'smooth', width: 2 },
            fill: { type: 'gradient', gradient: { opacityFrom: 0.35, opacityTo: 0 } },
            grid: { borderColor: '#eef0f2' },
            xaxis: { categories: @json($chartLabels), labels: { style: { fontSize: '11px' } } },
            legend: { position: 'top', horizontalAlign: 'right' }
        };
        new ApexCharts(document.querySelector('#chartTraffic'), chartOptions).render();
    }
});
</script>
@endpush
