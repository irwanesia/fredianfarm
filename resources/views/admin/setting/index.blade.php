@extends('layouts.admin')
@section('title', 'Pengaturan Website')
@section('content')
@php
    $getVal = fn (string $key) => old("settings.{$key}", optional($settings->firstWhere('key', $key))->value ?? '');
    $groups = [
        'profil' => [
            'id' => 'tab-profil',
            'title' => 'Profil Perusahaan',
            'fields' => [
                ['APP_NAME', 'Nama Website', 'text'],
                ['ALAMAT', 'Alamat', 'textarea'],
                ['NOMOR_WA', 'No. WhatsApp', 'text'],
                ['EMAIL', 'Email', 'email'],
                ['JAM_OPERASIONAL', 'Jam Operasional', 'text'],
                ['LINK_TIKTOK', 'Link TikTok (order marketplace)', 'url'],
                ['LINK_SHOPEE', 'Link Shopee (order marketplace)', 'url'],
            ],
        ],
        'tentang' => [
            'id' => 'tab-tentang',
            'title' => 'Tentang Kami',
            'fields' => [
                ['SEJARAH', 'Sejarah Perusahaan', 'textarea'],
                ['VISI', 'Visi', 'textarea'],
                ['MISI', 'Misi (satu item per baris)', 'textarea'],
                ['NIB', 'Nomor NIB', 'text'],
                ['SERTIFIKAT', 'Sertifikat', 'text'],
                ['IZIN', 'Izin', 'text'],
                ['ANGGOTA', 'Keanggotaan Asosiasi', 'text'],
                ['LOKASI_MAPS_EMBED', 'URL Embed Google Maps', 'text'],
            ],
        ],
        'footer' => [
            'id' => 'tab-footer',
            'title' => 'Footer',
            'fields' => [
                ['FOOTER_TAGLINE', 'Tagline Deskripsi', 'textarea'],
                ['FOOTER_TEXT', 'Baris Copyright', 'text'],
            ],
        ],
    ];
    $logoUrl = optional($settings->firstWhere('key', 'LOGO_URL'))->value ?: asset('images/logo.png');
    $sejarahImgUrl = optional($settings->firstWhere('key', 'SEJARAH_IMAGE'))->value ?: '';
@endphp
<form method="POST" action="{{ route('admin.setting.update') }}" enctype="multipart/form-data">
    @csrf

    <ul class="nav nav-tabs mb-3" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" data-bs-toggle="tab" href="#tab-profil" role="tab">
                <i class="ti ti-building-store me-1"></i>Profil Perusahaan
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" data-bs-toggle="tab" href="#tab-tentang" role="tab">
                <i class="ti ti-file-text me-1"></i>Tentang Kami
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" data-bs-toggle="tab" href="#tab-footer" role="tab">
                <i class="ti ti-align-justified me-1"></i>Footer
            </a>
        </li>
    </ul>

    <div class="tab-content">
        @foreach ($groups as $group)
        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="{{ $group['id'] }}" role="tabpanel">
            <div class="card">
                <div class="card-header"><h3 class="card-title">{{ $group['title'] }}</h3></div>
                <div class="card-body">
                    <div class="row g-3">
                        @if ($group['id'] === 'tab-profil')
                        <div class="col-12">
                            <label class="form-label">Logo</label>
                            <div class="d-flex align-items-center gap-3 flex-wrap">
                                <img id="logoPreview" src="{{ $logoUrl }}" alt="Logo" style="width:64px;height:64px;object-fit:contain;border:1px solid #eef0f2;border-radius:8px;background:#fff;padding:6px;">
                                <div class="flex-grow-1" style="min-width:220px">
                                    <input type="file" name="logo" id="logoInput" accept="image/png,image/webp,image/jpeg,image/jpg" data-preview-target="logoPreview" class="form-control form-control-sm @error('logo') is-invalid @enderror">
                                    <div class="text-secondary" style="font-size:.72rem;margin-top:4px">PNG / JPG / JPEG / WebP, maks. 2MB. Kosongkan jika tidak ingin mengubah.</div>
                                    @error('logo') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                    <label class="form-check mt-2" style="font-size:.82rem">
                                        <input class="form-check-input" type="checkbox" name="reset_logo" value="1" @checked(old('reset_logo'))>
                                        <span class="form-check-label text-secondary">Gunakan logo default (hapus logo saat ini)</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if ($group['id'] === 'tab-tentang')
                        <div class="col-12">
                            <label class="form-label">Foto Gudang Sortir & Fasilitas (Halaman Sejarah)</label>
                            <div class="d-flex align-items-center gap-3 flex-wrap">
                                @if ($sejarahImgUrl)
                                <img id="sejarahImagePreview" src="{{ $sejarahImgUrl }}" alt="Foto Gudang Sortir" style="width:96px;height:64px;object-fit:cover;border:1px solid #eef0f2;border-radius:8px;">
                                @else
                                <div id="sejarahImagePreview" class="avatar avatar-lg" style="background:var(--brand-soft);border:1px solid #eef0f2"><i class="ti ti-photo" style="color:#8a5b0a"></i></div>
                                @endif
                                <div class="flex-grow-1" style="min-width:220px">
                                    <input type="file" name="sejarah_image" id="sejarahImageInput" accept="image/png,image/webp,image/jpeg,image/jpg" data-preview-target="sejarahImagePreview" class="form-control form-control-sm @error('sejarah_image') is-invalid @enderror">
                                    <div class="text-secondary" style="font-size:.72rem;margin-top:4px">PNG / JPG / JPEG / WebP, maks. 2MB. Foto akan menggantikan ilustrasi pada halaman Sejarah Perusahaan. Kosongkan jika tidak ingin mengubah.</div>
                                    @error('sejarah_image') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                    <label class="form-check mt-2" style="font-size:.82rem">
                                        <input class="form-check-input" type="checkbox" name="reset_sejarah_image" value="1" @checked(old('reset_sejarah_image'))>
                                        <span class="form-check-label text-secondary">Hapus foto (kembali ke ilustrasi default)</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        @endif

                        @foreach ($group['fields'] as [$key, $label, $type])
                        @php $isTextarea = $type === 'textarea'; @endphp
                        <div class="{{ $isTextarea ? 'col-12' : 'col-md-6' }}">
                            <label class="form-label">{{ $label }}</label>
                            @if ($isTextarea)
                            <textarea name="settings[{{ $key }}]" rows="3" class="form-control @error("settings.{$key}") is-invalid @enderror">{{ $getVal($key) }}</textarea>
                            @else
                            <input type="{{ $type }}" name="settings[{{ $key }}]" class="form-control @error("settings.{$key}") is-invalid @enderror" value="{{ $getVal($key) }}">
                            @endif
                            @error("settings.{$key}") <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="card mt-3">
        <div class="card-footer d-flex gap-2">
            <button type="submit" class="btn text-white" style="background:var(--brand-green)"><i class="ti ti-device-floppy me-1"></i>Simpan Pengaturan</button>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('[data-preview-target]').forEach(function (input) {
        input.addEventListener('change', function () {
            var target = document.getElementById(input.dataset.previewTarget);
            if (target && input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    if (target.tagName === 'IMG') {
                        target.src = e.target.result;
                    } else {
                        target.innerHTML = '<img src="' + e.target.result + '" style="width:96px;height:64px;object-fit:cover;border-radius:8px;">';
                    }
                };
                reader.readAsDataURL(input.files[0]);
            }
        });
    });
});
</script>
@endpush
