@extends('layouts.admin')

@section('title', 'Pengaturan Website')

@section('content')
    <form method="POST" action="{{ route('admin.setting.update') }}">
        @csrf

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Pengaturan Website</h3>
            </div>
            <div class="card-body">
                @php
                    $settingKeys = [
                        'APP_NAME' => 'Nama Website',
                        'ALAMAT' => 'Alamat',
                        'NOMOR_WA' => 'No. WhatsApp',
                        'EMAIL' => 'Email',
                        'LOGO_URL' => 'Logo URL',
                        'FOOTER_TEXT' => 'Footer Text',
                        'LINK_TIKTOK' => 'Link TikTok (order marketplace)',
                        'LINK_SHOPEE' => 'Link Shopee (order marketplace)',
                    ];
                    $fieldTypes = [
                        'APP_NAME' => 'text',
                        'ALAMAT' => 'textarea',
                        'NOMOR_WA' => 'text',
                        'EMAIL' => 'email',
                        'LOGO_URL' => 'text',
                        'FOOTER_TEXT' => 'text',
                        'LINK_TIKTOK' => 'text',
                        'LINK_SHOPEE' => 'text',
                    ];
                @endphp

                @foreach ($settingKeys as $key => $label)
                    @php
                        $value = old("settings.{$key}", optional($settings->firstWhere('key', $key))->value ?? '');
                        $type = $fieldTypes[$key];
                    @endphp
                    <div class="mb-3">
                        <label class="form-label">{{ $label }}</label>
                        @if ($type === 'textarea')
                            <textarea name="settings[{{ $key }}]" rows="3" class="form-control @error("settings.{$key}") is-invalid @enderror">{{ $value }}</textarea>
                        @else
                            <input type="{{ $type }}" name="settings[{{ $key }}]" class="form-control @error("settings.{$key}") is-invalid @enderror"
                                value="{{ $value }}">
                        @endif
                        @error("settings.{$key}") <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                @endforeach
            </div>
            <div class="card-footer d-flex gap-2">
                <button type="submit" class="btn btn-primary">Simpan Pengaturan</button>
            </div>
        </div>
    </form>
@endsection
