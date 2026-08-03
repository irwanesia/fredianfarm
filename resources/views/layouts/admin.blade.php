<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title', 'Dashboard') — Admin Fredian Farm</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('vendor/tabler/css/tabler.min.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">
<script src="{{ asset('vendor/tinymce/tinymce.min.js') }}"></script>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.5/dist/cdn.min.js"></script>
<style>
:root{
  --tblr-primary:#2E7D32;
  --tblr-body-bg:#ffffff;
  --brand-green:#2E7D32;
  --brand-green-deep:#1F3D22;
  --brand-yellow:#F9A825;
  --brand-soft:#EEF5EC;
}
body{font-family:'Inter',sans-serif;background:#fff;}
.navbar-vertical{background:#fff;border-right:1px solid #eef0f2;width:260px;position:fixed;top:0;bottom:0;left:0;overflow-y:auto;z-index:40;}
.navbar-vertical .navbar-brand{padding:1rem 1.25rem;}
.navbar-vertical .nav-link{color:#5a6169;font-weight:500;border-radius:8px;margin:2px 8px;padding:.55rem .75rem;}
.navbar-vertical .nav-link.active,.navbar-vertical .nav-link:hover{background:var(--brand-soft);color:var(--brand-green-deep);}
.navbar-vertical .nav-link.active .nav-link-icon,.navbar-vertical .nav-link:hover .nav-link-icon{color:var(--brand-green);}
.nav-link-icon{font-size:1.15rem;margin-right:.6rem;color:#9aa1a8;}
.nav-group-title{font-size:.68rem;font-weight:700;letter-spacing:.06em;text-transform:uppercase;color:#b7bdc3;padding:1rem 1.25rem .35rem;}
.navbar-vertical .navbar-nav .nav-link.sidebar-footer-link{font-size:.78rem;padding-top:.4rem;padding-bottom:.4rem;}
.navbar-vertical .navbar-nav .nav-link.sidebar-footer-link.logout-link{color:#dc3545;}
.navbar-vertical .navbar-nav .nav-link.sidebar-footer-link.logout-link:hover{color:#dc3545;background:#fef0f0;}
.page-wrapper{background:#fff;margin-left:260px;}
.page-body{background:#fff;}
.card{border:1px solid #eef0f2;box-shadow:0 1px 3px rgba(0,0,0,.03);}
.avatar{font-weight:700;}
.topbar-search{max-width:320px;}
.table thead th{font-size:.72rem;text-transform:uppercase;letter-spacing:.04em;color:#9aa1a8;font-weight:700;border-bottom:1px solid #eef0f2;}
[x-cloak]{display:none!important;}
.kpi-icon{width:42px;height:42px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:1.2rem;color:#fff;flex:none;}
.admin-content{padding:1rem 1.5rem;}

.sidebar-separator{border-top:1px solid #eef0f2;margin:1rem 1.25rem .25rem;}
.sidebar-footer-link{font-size:.8rem;padding-top:.4rem!important;padding-bottom:.4rem!important;}
.sidebar-footer-link.logout-link{color:#dc3545;}
.sidebar-footer-link.logout-link:hover{color:#dc3545!important;background:#fef0f0!important;}
</style>
@stack('styles')
</head>
<body>
<div class="page">

  <!-- SIDEBAR -->
  <aside class="navbar navbar-vertical navbar-expand-lg" id="sidebar-admin">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
        <img src="{{ asset('images/logo.png') }}" alt="Fredian Farm" style="height:35px;width:auto;">
      </a>
      <div class="navbar-collapse" id="navbar-sidebar">
        <ul class="navbar-nav pt-2">
          <li class="nav-item">
            <a class="nav-link @if(Route::is('admin.dashboard')) active @endif" href="{{ route('admin.dashboard') }}">
              <i class="ti ti-layout-dashboard nav-link-icon"></i>Dashboard
            </a>
          </li>
        </ul>
        @if(auth()->user()->isAdmin())
        <div class="nav-group-title">Pesanan</div>
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link @if(Route::is('admin.orders.*')) active @endif" href="{{ route('admin.orders.index') }}"><i class="ti ti-truck nav-link-icon"></i>Pesanan</a></li>
          <li class="nav-item"><a class="nav-link @if(Route::is('admin.banks.*')) active @endif" href="{{ route('admin.banks.index') }}"><i class="ti ti-building-bank nav-link-icon"></i>Bank Transfer</a></li>
        </ul>
        @endif
        <div class="nav-group-title">Katalog</div>
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link @if(Route::is('admin.produk.*')) active @endif" href="{{ route('admin.produk.index') }}"><i class="ti ti-shopping-bag nav-link-icon"></i>Produk</a></li>
          <li class="nav-item"><a class="nav-link @if(Route::is('admin.kategori-produk.*')) active @endif" href="{{ route('admin.kategori-produk.index') }}"><i class="ti ti-category-2 nav-link-icon"></i>Kategori Produk</a></li>
        </ul>
        <div class="nav-group-title">Konten</div>
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link @if(Route::is('admin.artikel.*')) active @endif" href="{{ route('admin.artikel.index') }}"><i class="ti ti-article nav-link-icon"></i>Artikel</a></li>
          <li class="nav-item"><a class="nav-link @if(Route::is('admin.kategori-artikel.*')) active @endif" href="{{ route('admin.kategori-artikel.index') }}"><i class="ti ti-tags nav-link-icon"></i>Kategori Artikel</a></li>
          <li class="nav-item"><a class="nav-link @if(Route::is('admin.galeri.*')) active @endif" href="{{ route('admin.galeri.index') }}"><i class="ti ti-photo nav-link-icon"></i>Galeri</a></li>
          <li class="nav-item"><a class="nav-link @if(Route::is('admin.testimoni.*')) active @endif" href="{{ route('admin.testimoni.index') }}"><i class="ti ti-message-star nav-link-icon"></i>Testimoni</a></li>
          <li class="nav-item"><a class="nav-link @if(Route::is('admin.faq.*')) active @endif" href="{{ route('admin.faq.index') }}"><i class="ti ti-help-hexagon nav-link-icon"></i>FAQ</a></li>
          <li class="nav-item"><a class="nav-link @if(Route::is('admin.banner.*')) active @endif" href="{{ route('admin.banner.index') }}"><i class="ti ti-layout-2 nav-link-icon"></i>Banner</a></li>
        </ul>
        @if(auth()->user()->isAdmin())
        <div class="nav-group-title">Pengaturan</div>
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link @if(Route::is('admin.media-sosial.*')) active @endif" href="{{ route('admin.media-sosial.index') }}"><i class="ti ti-brand-tiktok nav-link-icon"></i>Media Sosial</a></li>
          <li class="nav-item"><a class="nav-link @if(Route::is('admin.setting.*')) active @endif" href="{{ route('admin.setting.index') }}"><i class="ti ti-building-store nav-link-icon"></i>Profil Perusahaan</a></li>
          <li class="nav-item"><a class="nav-link @if(Route::is('admin.kontak.*')) active @endif" href="{{ route('admin.kontak.index') }}"><i class="ti ti-inbox nav-link-icon"></i>Kotak Masuk</a></li>
          <li class="nav-item"><a class="nav-link @if(Route::is('admin.seo.*')) active @endif" href="{{ route('admin.seo.index') }}"><i class="ti ti-seo nav-link-icon"></i>SEO</a></li>
          <li class="nav-item"><a class="nav-link @if(Route::is('admin.pengguna.*')) active @endif" href="{{ route('admin.pengguna.index') }}"><i class="ti ti-users nav-link-icon"></i>Pengguna</a></li>
        </ul>
        @endif

        <div class="sidebar-separator"></div>
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link sidebar-footer-link" href="{{ url('/') }}" target="_blank">
              <i class="ti ti-external-link nav-link-icon"></i>Lihat Website
            </a>
          </li>
          <li class="nav-item">
            <form method="POST" action="{{ route('admin.logout') }}">
              @csrf
              <button type="submit" class="nav-link sidebar-footer-link logout-link w-100 text-start border-0 bg-transparent d-flex align-items-center">
                <i class="ti ti-logout nav-link-icon"></i>Logout
              </button>
            </form>
          </li>
        </ul>
      </div>
    </div>
  </aside>

  <!-- MAIN -->
  <div class="page-wrapper">
    <!-- TOPBAR -->
    <header class="navbar navbar-expand-md sticky-top d-print-none" style="background:#fff;border-bottom:1px solid #eef0f2;">
      <div class="container-fluid d-flex align-items-center">
        <button class="navbar-toggler d-lg-none me-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-sidebar">
          <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand d-none d-sm-block" style="font-size:1.05rem;font-weight:700;color:#1F3D22;">@yield('title', 'Dashboard')</h1>
        <div class="ms-auto d-flex align-items-center gap-3">

          <!-- SEARCH -->
          {{-- <form action="{{ route('admin.search') }}" method="GET" class="input-icon topbar-search d-none d-md-block">
            <span class="input-icon-addon"><i class="ti ti-search"></i></span>
            <input type="text" name="q" class="form-control form-control-sm" placeholder="Cari di admin..." value="{{ request('q') }}">
          </form> --}}

          <!-- NOTIFICATIONS -->
          @if(auth()->user()->isAdmin())
          <div class="dropdown">
            <a href="#" class="text-secondary position-relative" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
              <i class="ti ti-bell fs-1"></i>
              @if($adminNotificationCount > 0)
              <span class="badge bg-red" style="position:absolute;top:-12px;right:-6px;font-size:.62rem; color:#fff; padding:.15rem .35rem;border-radius:10px;">{{ $adminNotificationCount }}</span>
              @endif
            </a>
            <div class="dropdown-menu dropdown-menu-end" style="width:320px;">
              <div class="dropdown-header d-flex align-items-center justify-content-between">
                <span class="fw-semibold">Notifikasi</span>
                <span class="badge bg-red-lt">{{ $adminNotificationCount }} baru</span>
              </div>
              <div class="list-group list-group-flush" style="max-height:320px;overflow-y:auto;">
                @forelse ($adminNotifications as $notif)
                <a href="{{ $notif['url'] }}" class="list-group-item list-group-item-action d-flex align-items-start gap-3 py-3 px-3">
                  <div>
                    @if($notif['type'] === 'pesanan')
                      <i class="ti ti-truck text-primary fs-3"></i>
                    @else
                      <i class="ti ti-message text-success fs-3"></i>
                    @endif
                  </div>
                  <div class="text-truncate">
                    <div class="text-secondary small">{{ $notif['title'] }}</div>
                    <div class="text-truncate text-secondary" style="font-size:.72rem;">{{ $notif['subtitle'] }}</div>
                    <div class="text-secondary" style="font-size:.7rem;">{{ $notif['time'] }}</div>
                  </div>
                </a>
                @empty
                <div class="text-center text-secondary py-4 px-3">
                  <i class="ti ti-bell-off fs-3 d-block mb-1"></i>
                  Tidak ada notifikasi baru
                </div>
                @endforelse
              </div>
              <div class="dropdown-footer text-center py-2">
                <a href="{{ route('admin.orders.index') }}" class="text-secondary small">Lihat semua notifikasi</a>
              </div>
            </div>
          </div>
          @endif

          <!-- USER DROPDOWN -->
          <div class="dropdown">
            <a href="#" class="d-flex align-items-center gap-2 text-reset text-decoration-none" data-bs-toggle="dropdown" aria-expanded="false">
              <span class="avatar avatar-sm" style="background:var(--brand-green);color:#fff">
                {{ substr(auth()->user()->name ?? 'Admin Fredian', 0, 2) }}
              </span>
              <div class="d-none d-sm-block text-start">
                <div style="font-size:.82rem;font-weight:700;color:#1F3D22">{{ auth()->user()->name ?? 'Admin Fredian' }}</div>
                <div style="font-size:.7rem;color:#9aa1a8">{{ auth()->user()->roleLabel() }}</div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-end" style="min-width:200px;">
              <div class="dropdown-header px-3 py-2">
                <div style="font-size:.82rem;font-weight:700;color:#1F3D22">{{ auth()->user()->name ?? 'Admin Fredian' }}</div>
                <div style="font-size:.7rem;color:#9aa1a8">{{ auth()->user()->email ?? 'admin@fredianfarm.com' }}</div>
              </div>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="#"><i class="ti ti-user fs-5"></i>Profil Saya</a>
              <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="{{ route('admin.setting.index') }}"><i class="ti ti-settings fs-5"></i>Pengaturan</a>
              <div class="dropdown-divider"></div>
              <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="dropdown-item d-flex align-items-center gap-2 py-2 text-danger">
                  <i class="ti ti-logout fs-5"></i>Logout
                </button>
              </form>
            </div>
          </div>

        </div>
      </div>
    </header>

    <!-- PAGE BODY -->
    <div class="page-body">
      <div class="admin-content">
        @if($__env->hasSection('page-header-left') || $__env->hasSection('page-actions'))
        <div class="page-header" style="display:flex;align-items:center;justify-content:space-between;margin-bottom:.5rem;min-height:1.5rem;flex-direction:row;gap:.75rem;flex-wrap:nowrap">
          <div>
            @yield('page-header-left')
            @hasSection('breadcrumb')
              <div style="font-size:.75rem;color:#9aa1a8;margin-top:2px;">@yield('breadcrumb')</div>
            @endif
          </div>
          <div style="display:flex;align-items:center;gap:.5rem;flex-shrink:0">
            @yield('page-actions')
          </div>
        </div>
        @endif
        @yield('content')
      </div>
    </div>
  </div>
</div>

<!-- Toast notifications -->
@if(session('success'))
<div class="toast align-items-center show position-fixed" style="bottom:20px;right:20px;z-index:9999;background:#1F3D22;color:#fff;border:none;" role="alert">
  <div class="d-flex">
    <div class="toast-body"><i class="ti ti-check me-1"></i>{{ session('success') }}</div>
    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
  </div>
</div>
@endif
@if(session('error'))
<div class="toast align-items-center show position-fixed" style="bottom:60px;right:20px;z-index:9999;background:#dc3545;color:#fff;border:none;" role="alert">
  <div class="d-flex">
    <div class="toast-body"><i class="ti ti-alert-circle me-1"></i>{{ session('error') }}</div>
    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
  </div>
</div>
@endif

<script src="{{ asset('vendor/tabler/js/tabler.min.js') }}"></script>
@stack('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  document.querySelectorAll('.editor-tinymce').forEach(function(el) {
    if (typeof tinymce !== 'undefined') {
      tinymce.init({
        selector: '.editor-tinymce',
        height: 500,
        language: 'id',
        plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table code help wordcount',
        toolbar: 'undo redo | blocks | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | code fullscreen',
        menubar: 'file edit view insert format tools table help',
        images_upload_handler: function (blobInfo, progress) {
          return new Promise(function (resolve, reject) {
            var formData = new FormData();
            formData.append('file', blobInfo.blob(), blobInfo.filename());
            fetch('{{ route("admin.tinymce.upload") }}', {
              method: 'POST',
              headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json'},
              body: formData,
            })
            .then(function (response) { return response.json(); })
            .then(function (data) { data.location ? resolve(data.location) : reject('Upload failed'); })
            .catch(function (error) { reject('Upload error: ' + error.message); });
          });
        },
      });
    }
  });
});

setTimeout(function() {
  document.querySelectorAll('.toast.show').forEach(function(el) {
    var bsToast = new tabler.Toast(el);
    bsToast.hide();
  });
}, 5000);
</script>
</body>
</html>
