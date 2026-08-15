@extends('layouts.admin')
@section('title', 'SEO')
@section('content')
<form method="POST" action="{{ route('admin.seo.update') }}" enctype="multipart/form-data">
    @csrf
    <div class="row row-cards">
        <div class="col-lg-7">
            <div class="card">
                <div class="card-header"><h3 class="card-title">Meta Global</h3></div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Meta Title Default</label>
                        <input type="text" name="settings[META_TITLE]" class="form-control" value="{{ old('settings.META_TITLE', optional($settings->get('META_TITLE'))->value ?? 'Fredian Farm | Bibit Kentang Berkualitas dari Dieng') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Meta Description Default</label>
                        <textarea name="settings[META_DESCRIPTION]" class="form-control" rows="2">{{ old('settings.META_DESCRIPTION', optional($settings->get('META_DESCRIPTION'))->value ?? 'Produsen dan distributor bibit kentang G-0, G-0 MZ, Granola L, dan G-0 Plus dari Dieng, Jawa Tengah.') }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Open Graph Image</label>
                        <div class="d-flex align-items-center gap-2 flex-wrap">
                            @php $ogImage = optional($settings->get('OG_IMAGE'))->value ?? ''; @endphp
                            @if($ogImage)
                            <img src="{{ $ogImage }}" alt="OG Image" style="width:60px;height:60px;object-fit:cover;border-radius:8px;border:1px solid #eef0f2;">
                            @else
                            <div class="avatar avatar-lg" style="background:var(--brand-soft)"><i class="ti ti-photo" style="color:#8a5b0a"></i></div>
                            @endif
                            <div>
                                <input type="file" name="og_image" accept="image/jpeg,image/png,image/webp" class="form-control form-control-sm">
                                <div class="text-secondary" style="font-size:.72rem;margin-top:4px">JPG/PNG/WebP maks. 2MB — pratinjau saat link dibagikan (WhatsApp/Facebook). Kosongkan jika tidak ingin mengubah.</div>
                                @error('og_image') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Robots.txt</label>
                        <textarea name="settings[ROBOTS_TXT]" class="form-control font-monospace" rows="4">{{ old('settings.ROBOTS_TXT', optional($settings->get('ROBOTS_TXT'))->value ?? "User-agent: *\nAllow: /\n\nSitemap: ".url('/sitemap.xml')) }}</textarea>
                    </div>
                    <button type="submit" class="btn text-white" style="background:var(--brand-green)"><i class="ti ti-device-floppy me-1"></i>Simpan Pengaturan</button>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card">
                <div class="card-header"><h3 class="card-title">Sitemap</h3></div>
                <div class="card-body">
                    <p class="text-secondary" style="font-size:.85rem">Sitemap XML dibuat otomatis dari seluruh produk dan artikel yang dipublikasikan. Selalu terbaru setiap kali diakses — tanpa perlu generate manual.</p>
                    <div class="mb-2">
                        <span class="status-dot" style="background:#2E7D32;width:8px;height:8px;border-radius:50%;display:inline-block"></span>
                        <span style="font-size:.85rem">Aktif di <a href="{{ url('/sitemap.xml') }}" target="_blank" class="text-primary">{{ url('/sitemap.xml') }}</a></span>
                    </div>
                    <div class="mb-3">
                        <span class="status-dot" style="background:#2E7D32;width:8px;height:8px;border-radius:50%;display:inline-block"></span>
                        <span style="font-size:.85rem">Robots.txt di <a href="{{ url('/robots.txt') }}" target="_blank" class="text-primary">{{ url('/robots.txt') }}</a></span>
                    </div>
                    <a href="{{ url('/sitemap.xml') }}" target="_blank" class="btn btn-outline-secondary btn-sm"><i class="ti ti-external-link me-1"></i>Buka Sitemap</a>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
