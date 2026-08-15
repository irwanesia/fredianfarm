<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
@php
    $settingValue = fn (string $key, $default = null) => ($settings->get($key)?->value) ?: $default;
@endphp
<title>@yield('title', $settingValue('META_TITLE', 'Fredian Farm — Bibit Kentang Unggul'))</title>
<link rel="canonical" href="{{ url()->current() }}">
@hasSection('meta_head')
    @yield('meta_head')
@else
    <meta name="description" content="{{ $settingValue('META_DESCRIPTION', 'Produsen dan distributor bibit kentang G-0, G-0 MZ, Granola L, dan G-0 Plus dari Dieng, Jawa Tengah.') }}">
    <meta name="robots" content="index, follow">
    <meta property="og:site_name" content="{{ $settingValue('APP_NAME', 'Fredian Farm') }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('title', $settingValue('META_TITLE', 'Fredian Farm'))">
    <meta property="og:description" content="{{ $settingValue('META_DESCRIPTION', 'Produsen dan distributor bibit kentang G-0, G-0 MZ, Granola L, dan G-0 Plus dari Dieng, Jawa Tengah.') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    @if(!empty($settingValue('OG_IMAGE')))
    <meta property="og:image" content="{{ $settingValue('OG_IMAGE') }}">
    @endif
@endif
@php
    $orgName = $settingValue('APP_NAME', 'Fredian Farm');
    $orgLogo = $settingValue('LOGO_URL');
    $orgJson = [
        '@context' => 'https://schema.org',
        '@type' => 'Organization',
        'name' => $orgName,
        'url' => url('/'),
    ];
    if ($orgLogo) {
        $orgJson['logo'] = url($orgLogo);
    }
    if (!empty($settingValue('ALAMAT'))) {
        $orgJson['address'] = ['@type' => 'PostalAddress', 'streetAddress' => $settingValue('ALAMAT')];
    }
    $phoneRaw = preg_replace('/[^0-9]/', '', $settingValue('NOMOR_WA', ''));
    $contact = [];
    if (str_starts_with($phoneRaw, '62')) {
        $contact['telephone'] = '+' . $phoneRaw;
    } elseif (str_starts_with($phoneRaw, '0')) {
        $contact['telephone'] = '+62' . ltrim($phoneRaw, '0');
    } elseif ($phoneRaw) {
        $contact['telephone'] = '+62' . $phoneRaw;
    }
    if (!empty($settingValue('EMAIL'))) {
        $contact['email'] = $settingValue('EMAIL');
    }
    if ($contact) {
        $contact['@type'] = 'ContactPoint';
        $contact['contactType'] = 'customer service';
        $orgJson['contactPoint'] = $contact;
    }
@endphp
<script type="application/ld+json">{!! json_encode($orgJson, JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_QUOT | JSON_HEX_APOS) !!}</script>
@stack('schema')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,500;0,9..144,600;1,9..144,500&family=Manrope:wght@400;500;600;700;800&family=JetBrains+Mono:wght@500;600&family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
:root{
  --green-deep:#1F3D22;
  --green-primary:#2E7D32;
  --green-bright:#3F9A45;
  --green-soft:#EAF2E6;
  --brown-earth:#8D6E63;
  --brown-soft:#F1E9E4;
  --yellow-potato:#F9A825;
  --yellow-soft:#FDECC8;
  --cream:#FAF7F0;
  --text:#2B2B26;
  --text-soft:#69675E;
  --line:#E4DDCE;
  --radius:14px;
  --shadow:0 10px 30px -14px rgba(31,61,34,.25);
}
*{box-sizing:border-box;}
html{scroll-behavior:smooth;}
body{margin:0;background:#fff;color:var(--text);font-family:'Manrope',sans-serif;font-size:16px;line-height:1.6;-webkit-font-smoothing:antialiased;}
h1{font-size:36px;}
h2{font-size:28px;}
h3{font-size:20px;}
h4{font-size:17px;}
h1,h2,h3,h4{font-family:'Montserrat',sans-serif;font-weight:700;letter-spacing:-.01em;margin:0 0 .4em;color:var(--green-deep);}
@media(max-width:600px){
  h1{font-size:clamp(22px,5vw,28px);}
  h2{font-size:clamp(18px,4vw,22px);}
  h3{font-size:17px;}
  section{padding:56px 0;}
  .section-tight{padding:36px 0;}
}
p{margin:0 0 1em;color:var(--text-soft);}
a{color:inherit;text-decoration:none;}
img{max-width:100%;display:block;}
.container{max-width:1180px;margin:0 auto;padding:0 24px;}
.eyebrow{font-family:'JetBrains Mono',monospace;font-size:12px;font-weight:600;letter-spacing:.12em;text-transform:uppercase;color:var(--green-primary);display:inline-flex;align-items:center;gap:8px;margin-bottom:10px;}
.eyebrow::before{content:"";width:18px;height:1px;background:var(--yellow-potato);display:inline-block;}
.btn{display:inline-flex;align-items:center;justify-content:center;gap:8px;padding:13px 26px;border-radius:100px;border:1px solid transparent;font-family:'Manrope',sans-serif;font-weight:700;font-size:14.5px;cursor:pointer;transition:.2s ease;white-space:nowrap;}
.btn-primary{background:var(--green-primary);color:#fff;}
.btn-primary:hover{background:var(--green-deep);transform:translateY(-1px);}
.btn-accent{background:var(--yellow-potato);color:var(--green-deep);}
.btn-accent:hover{background:#e6960f;transform:translateY(-1px);}
.btn-ghost{background:transparent;border-color:var(--line);color:var(--text);}
.btn-ghost:hover{border-color:var(--green-primary);color:var(--green-primary);}
.btn-tiktok{background:#1F1F1F;color:#fff;}
.btn-tiktok:hover{background:#000;transform:translateY(-1px);}
.btn-shopee{background:#F97316;color:#fff;}
.btn-shopee:hover{background:#EA580C;transform:translateY(-1px);}
.btn-sm{padding:9px 18px;font-size:13px;}

/* nav */
.nav{position:sticky;top:0;z-index:50;background:#fff;backdrop-filter:blur(8px);border-bottom:1px solid var(--line);}
.nav-inner{display:flex;align-items:center;justify-content:space-between;padding:14px 24px;max-width:1180px;margin:0 auto;}
.logo{display:flex;align-items:center;gap:10px;font-family:'Fraunces',serif;font-weight:600;font-size:20px;color:var(--green-deep);cursor:pointer;}
.logo-mark{width:34px;height:34px;flex:none;}
.logo-img{height:38px;width:auto;flex:none;display:block;}
.nav-links{display:flex;gap:26px;list-style:none;margin:0;padding:0;align-items:center;}
.nav-links a{font-size:14.5px;font-weight:600;color:var(--text-soft);cursor:pointer;padding:4px 0;border-bottom:2px solid transparent;transition:.15s;}
.nav-links a:hover,.nav-links a.active{color:var(--green-primary);border-color:var(--yellow-potato);}
.nav-cta{display:flex;align-items:center;gap:14px;}
.nav-icon-link:hover{background:var(--green-soft)!important;color:var(--green-primary)!important;}
.burger{display:none;flex-direction:column;gap:5px;cursor:pointer;background:none;border:none;padding:6px;}
.burger span{width:22px;height:2px;background:var(--green-deep);}

/* nav dropdown */
.nav-dropdown{position:relative;}
.nav-dropdown-toggle{cursor:pointer;user-select:none;}
.nav-dropdown-toggle .arrow{font-size:10px;margin-left:3px;transition:.2s;display:inline-block;}
.nav-dropdown.open .nav-dropdown-toggle .arrow{transform:rotate(180deg);}
.nav-dropdown-menu{display:none;position:absolute;top:100%;left:0;background:#fff;border:1px solid var(--line);border-radius:12px;padding:6px;min-width:180px;box-shadow:0 8px 30px rgba(0,0,0,.1);z-index:60;}
.nav-dropdown.open .nav-dropdown-menu{display:block;}
.nav-dropdown-menu a{display:block;padding:9px 14px;font-size:14px;font-weight:600;color:var(--text-soft);border-radius:8px;transition:.12s;white-space:nowrap;}
.nav-dropdown-menu a:hover,.nav-dropdown-menu a.active{background:var(--green-soft);color:var(--green-primary);}
@media(hover:hover){.nav-dropdown:hover .nav-dropdown-menu{display:block;}}
.nav-mobile-extra{display:none;}
.nav-sub-wrap{position:relative;}
.nav-sub-wrap .nav-sub-head{display:flex;justify-content:space-between;align-items:center;gap:10px;padding:9px 14px;font-size:14px;font-weight:600;color:var(--text-soft);border-radius:8px;transition:.12s;white-space:nowrap;}
.nav-sub-wrap .nav-sub-head:hover,.nav-sub-wrap .nav-sub-head.active{background:var(--green-soft);color:var(--green-primary);}
.nav-submenu{display:none;position:absolute;left:100%;top:-6px;background:#fff;border:1px solid var(--line);border-radius:12px;padding:6px;min-width:190px;box-shadow:0 8px 30px rgba(0,0,0,.1);z-index:61;margin-left:6px;}
.nav-submenu a{display:block;padding:9px 14px;font-size:14px;font-weight:600;color:var(--text-soft);border-radius:8px;transition:.12s;white-space:nowrap;}
.nav-submenu a:hover,.nav-submenu a.active{background:var(--green-soft);color:var(--green-primary);}
.nav-sub-wrap:hover .nav-submenu{display:block;}
.nav-search{display:none;max-width:1180px;margin:0 auto;padding:12px 24px 18px;}
.nav-search.open{display:block;}
.nav-search form{display:flex;align-items:center;gap:10px;background:var(--cream);border:1px solid var(--line);border-radius:100px;padding:8px 8px 8px 18px;}
.nav-search form svg{flex:none;}
.nav-search input{flex:1;border:none;background:transparent;outline:none;font-family:'Manrope',sans-serif;font-size:14.5px;color:var(--text);min-width:0;}
.nav-search .btn{flex:none;}
.nav-icon-link{font-size:18px;cursor:pointer;padding:6px;display:inline-flex;align-items:center;justify-content:center;width:36px;height:36px;border-radius:50%;transition:.15s;color:var(--text-soft);text-decoration:none;position:relative;}
.nav-icon-link:hover{background:var(--green-soft)!important;color:var(--green-primary)!important;}
.cart-badge{position:absolute;top:-2px;right:-2px;background:var(--yellow-potato);color:var(--green-deep);font-size:10px;font-weight:800;min-width:18px;height:18px;border-radius:9px;display:none;align-items:center;justify-content:center;border:2px solid #fff;}

@media(max-width:960px){
  .nav-links{position:fixed;top:64px;left:0;right:0;background:#fff;flex-direction:column;align-items:flex-start;padding:20px 24px 26px;border-bottom:1px solid var(--line);gap:16px;display:none;}
  .nav-links.open{display:flex;}
  .burger{display:flex;}
  .nav-cta .btn-primary,.nav-cta .nav-icon-link{display:none;}
  .nav-mobile-extra{display:block;}
  .nav-dropdown-menu{position:static;box-shadow:none;border:none;padding:4px 0 0 16px;background:transparent;}
  .nav-dropdown-menu a{padding:8px 12px;font-size:13px;}
  .nav-dropdown.open .nav-dropdown-menu{display:block;}
  .nav-submenu{position:static;box-shadow:none;border:none;background:transparent;margin:0;padding:0 0 0 10px;display:block;min-width:0;}
  .nav-submenu a{padding:8px 12px;font-size:13px;}
  .nav-search{margin:0;padding:4px 24px 16px;}
  .nav-search form{border-radius:14px;padding:6px 6px 6px 14px;}
  .nav-search .btn{font-size:12px;padding:8px 14px;}
}

/* section rhythm */
section{padding:88px 0;}
.section-tight{padding:64px 0;}
.tinted{background:var(--green-soft);}
.dark{background:var(--green-deep);color:#EDF3EB;}
.dark h1,.dark h2,.dark h3,.dark h4{color:#fff;}
.dark p{color:#C7D6C4;}
.section-head{max-width:640px;margin-bottom:44px;}
.section-head.center{margin-left:auto;margin-right:auto;text-align:center;}

/* soil divider */
.soil-divider{width:100%;height:46px;display:block;}

/* grid utilities */
.grid{display:grid;gap:24px;}
.grid-2{grid-template-columns:repeat(2,minmax(0,1fr));}
.grid-3{grid-template-columns:repeat(3,minmax(0,1fr));}
.grid-4{grid-template-columns:repeat(4,minmax(0,1fr));}
@media(max-width:900px){.grid-3{grid-template-columns:repeat(2,minmax(0,1fr));}}
@media(max-width:600px){.grid-2{grid-template-columns:minmax(0,1fr);}}
/* grid-4 (e.g. Legalitas) stays at 2 columns all the way down instead of collapsing to 1 */
@media(max-width:900px){.grid-4{grid-template-columns:repeat(2,minmax(0,1fr));}}

/* marketplace-style fixed 2-column grids for product/article/gallery cards on mobile */
.grid-products,.grid-articles{grid-template-columns:repeat(3,1fr);}
@media(max-width:760px){
  .grid-products,.grid-articles{grid-template-columns:repeat(2,1fr);gap:14px;}
}
@media(max-width:480px){
  .grid-products .prod-body{padding:13px 13px 15px;}
  .grid-products .prod-body h4{font-size:14.5px;margin-bottom:2px;}
  .grid-products .desc-clamp{font-size:12px;margin:0 0 4px;}
  .grid-products .prod-harga{font-size:16px;margin:2px 0 6px;}
  .grid-products .prod-foot .btn{font-size:12px;padding:7px 14px;}
  .grid-products .gal-item .gal-label{font-size:11.5px;padding:9px 10px;}
  .grid-articles .article-body{padding:14px;}
  .grid-articles .article-body h4{font-size:14px;}
  .grid-articles .badge-kat{font-size:9.5px;padding:3px 8px;}
}

/* blog detail 2-column layout */
.blog-detail-layout{display:grid;grid-template-columns:1fr 300px;gap:40px;align-items:start;}
.blog-detail-main{min-width:0;}
.blog-content{font-size:16px;line-height:1.8;color:var(--text);}
.blog-content h2{font-size:21px;margin:28px 0 12px;color:var(--text);}
.blog-content p{margin:0 0 16px;}
.blog-content img{max-width:100%;border-radius:var(--radius);margin:16px 0;}
.blog-detail-sidebar{display:flex;flex-direction:column;gap:24px;}
.sidebar-card{background:var(--green-soft);border-radius:var(--radius);padding:20px;}
.sidebar-title{font-size:15px;margin:0 0 14px;padding-bottom:10px;border-bottom:1px solid var(--line);}
.sidebar-link{display:block;padding:8px 0;text-decoration:none;border-bottom:1px solid var(--line);}
.sidebar-link:last-child{border-bottom:none;}
.sidebar-link-title{display:block;font-size:14px;font-weight:500;color:var(--text);line-height:1.4;}
.sidebar-link-meta{display:block;font-size:12px;color:var(--text-soft);margin-top:2px;}
.sidebar-link:hover .sidebar-link-title{color:var(--green-primary);}
@media(max-width:768px){
  .blog-detail-layout{grid-template-columns:1fr;gap:24px;}
}

/* horizontal scroll-snap sliders for mobile (Kenapa Kami, Testimoni) */
.value-scroller{grid-template-columns:repeat(4,1fr);}
.testi-scroller{grid-template-columns:repeat(3,1fr);}
@media(max-width:900px){.value-scroller{grid-template-columns:repeat(2,1fr);}}
.scroll-hint{display:none;font-size:12px;font-weight:700;color:var(--text-soft);margin-bottom:14px;}
@media(max-width:760px){
  .value-scroller,.testi-scroller{
    display:flex;
    grid-template-columns:none;
    overflow-x:auto;
    scroll-snap-type:x mandatory;
    gap:14px;
    padding-bottom:6px;
    margin:0 -24px;
    padding-left:24px;
    padding-right:24px;
    -webkit-overflow-scrolling:touch;
    scrollbar-width:none;
  }
  .value-scroller::-webkit-scrollbar,.testi-scroller::-webkit-scrollbar{display:none;}
  .value-scroller > *{flex:0 0 72%;scroll-snap-align:start;}
  .testi-scroller > *{flex:0 0 84%;scroll-snap-align:start;}
  .scroll-hint{display:block;}
}

/* hero */
.hero{background:var(--green-deep);color:#fff;position:relative;overflow:hidden;padding:100px 0 0;}
.hero-inner{display:grid;grid-template-columns:1.1fr .9fr;gap:40px;align-items:center;position:relative;z-index:2;}
.hero h1{font-size:clamp(26px,5vw,48px);color:#fff;line-height:1.05;}
.hero h1 em{font-style:italic;color:var(--yellow-potato);}
.hero p.lead{color:#CFE0CB;font-size:17.5px;max-width:480px;}
.hero-stats{display:flex;gap:28px;margin-top:32px;flex-wrap:wrap;}
.hero-stat b{display:block;font-family:'Fraunces',serif;font-size:26px;color:var(--yellow-potato);}
.hero-stat span{font-size:12.5px;color:#B9CBB5;text-transform:uppercase;letter-spacing:.06em;}
.hero-actions{display:flex;gap:14px;margin-top:34px;flex-wrap:wrap;}
.hero-art{position:relative;height:380px;}
@media(max-width:900px){.hero-inner{grid-template-columns:1fr;}.hero-art{height:220px;}}

/* hero slider (banner) */
.hero-slider{height:560px;padding:0;}
.hero-slide{position:absolute;inset:0;opacity:0;transition:opacity .6s ease;background-size:cover;background-position:center;display:flex;align-items:center;z-index:1;pointer-events:none;}
.hero-slide.active{opacity:1;z-index:2;pointer-events:auto;}
.hero-slide::before{content:'';position:absolute;inset:0;background:linear-gradient(90deg,rgba(0,0,0,.62),rgba(0,0,0,.18) 55%,rgba(0,0,0,.05));z-index:1;}
.hero-slider .hero-inner{width:100%;height:100%;align-items:flex-start;padding-top:90px;}
.hero-slide-content{position:relative;z-index:2;max-width:560px;}
.hero-slide-bg.fallback{position:absolute;inset:0;background:var(--green-deep);overflow:hidden;z-index:0;}
.hero-nav{position:absolute;top:50%;transform:translateY(-50%);z-index:5;background:rgba(255,255,255,.12);border:1px solid rgba(255,255,255,.25);color:#fff;width:44px;height:44px;border-radius:50%;font-size:22px;line-height:1;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:background .2s;padding:0;}
.hero-nav:hover{background:rgba(255,255,255,.28);}
.hero-nav.prev{left:18px;}
.hero-nav.next{right:18px;}
.hero-dots{position:absolute;bottom:56px;left:50%;transform:translateX(-50%);z-index:5;display:flex;gap:8px;}
.hero-dots span{width:26px;height:5px;border-radius:3px;background:rgba(255,255,255,.35);cursor:pointer;transition:background .2s;}
.hero-dots span.active{background:var(--yellow-potato);}
.hero-slider .soil-divider{position:absolute;bottom:0;left:0;right:0;z-index:6;}
@media(max-width:900px){
  .hero-slider{height:520px;}
  .hero-slider .hero-inner{grid-template-columns:1fr;align-items:flex-start;padding-top:104px;padding-bottom:64px;}
  .hero-slide::before{background:linear-gradient(0deg,rgba(0,0,0,.75),rgba(0,0,0,.1) 70%);}
  .hero-slide-content{max-width:100%;}
  .hero-slide-content h1{font-size:27px;}
  .hero p.lead{font-size:15px;}
  .hero-actions{gap:10px;}
  .hero-nav{width:38px;height:38px;font-size:18px;}
  .hero-nav.prev{left:10px;}
  .hero-nav.next{right:10px;}
  .hero-dots{bottom:46px;}
  .hero-slide-bg.fallback svg{display:none;}
}

/* value cards */
.value-card{background:#fff;border:1px solid var(--line);border-radius:var(--radius);padding:28px;box-shadow:var(--shadow);}
.value-card .icon{width:40px;height:40px;color:var(--green-primary);margin-bottom:14px;}
.value-card h4{font-size:17px;margin-bottom:6px;}
.value-card p{font-size:14.5px;margin:0;}

/* product card */
.prod-card{background:#fff;border:1px solid var(--line);border-radius:var(--radius);overflow:hidden;box-shadow:var(--shadow);cursor:pointer;transition:.2s;display:flex;flex-direction:column;}
.prod-card:hover{transform:translateY(-4px);}
.prod-media{aspect-ratio:4/3;position:relative;display:flex;align-items:center;justify-content:center;}
.prod-media svg{width:56%;height:56%;}
.prod-media img{width:100%;height:100%;object-fit:cover;}
.thumb-active{border-color:var(--green-primary)!important;}
.produk-deskripsi strong{font-weight:700;}
.produk-deskripsi p{margin:0 0 10px;}
.produk-deskripsi ul,.produk-deskripsi ol{margin:0 0 10px;padding-left:20px;}
.produk-deskripsi li{margin-bottom:4px;}
.produk-deskripsi h2,.produk-deskripsi h3,.produk-deskripsi h4{margin:16px 0 6px;font-family:'Manrope',sans-serif;font-weight:700;color:var(--text);}
.prod-body{padding:20px 20px 22px;flex:1;display:flex;flex-direction:column;}
.prod-tag{position:absolute;top:12px;left:12px;font-family:'JetBrains Mono',monospace;font-size:11px;font-weight:600;padding:5px 10px;border-radius:100px;background:rgba(255,255,255,.9);}
.stok-tersedia{color:var(--green-primary);}
.stok-terbatas{color:#B5751A;}
.stok-preorder{color:#8D6E63;}
.prod-body h4{font-size:18px;margin-bottom:4px;}
.desc-clamp{font-size:13.5px;color:var(--text-soft);display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;line-height:1.5;margin:0 0 6px;}
.prod-meta{display:flex;gap:10px;flex-wrap:wrap;margin:10px 0 14px;}
.chip{font-family:'JetBrains Mono',monospace;font-size:11px;font-weight:500;background:var(--brown-soft);color:var(--brown-earth);padding:4px 9px;border-radius:6px;}
.prod-foot{margin-top:auto;display:flex;justify-content:space-between;align-items:center;}

/* filter bar */
.filter-bar{display:flex;gap:14px;flex-wrap:wrap;align-items:center;margin-bottom:34px;padding:18px 20px;background:#fff;border:1px solid var(--line);border-radius:var(--radius);}
.filter-bar select,.filter-bar input{font-family:'Manrope',sans-serif;font-size:14px;padding:10px 14px;border-radius:9px;border:1px solid var(--line);background:var(--cream);color:var(--text);}
.filter-bar label{font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:var(--text-soft);display:block;margin-bottom:5px;}
.filter-group{display:flex;flex-direction:column;}
.filter-group.grow{flex:1;min-width:180px;}
@media(max-width:760px){
  .filter-bar{padding:10px 12px;gap:6px;margin-bottom:20px;}
  .filter-bar .filter-group{flex:1 1 calc(50% - 3px);min-width:0;}
  .filter-bar select{font-size:13px;padding:7px 10px;width:100%;}
  .filter-bar .btn-sm{font-size:12px;padding:7px 12px;width:100%;text-align:center;}
}
/* article card */
.article-card{display:flex;flex-direction:column;background:#fff;border:1px solid var(--line);border-radius:var(--radius);overflow:hidden;box-shadow:var(--shadow);transition:.2s;}
.article-card:hover{transform:translateY(-4px);}
.article-media{aspect-ratio:16/10;display:flex;align-items:center;justify-content:center;}.article-media img{width:100%;height:100%;object-fit:cover;}
.article-media svg{width:40%;}
.article-body{display:flex;flex-direction:column;padding:20px;}
.badge-kat{display:inline-block;font-family:'JetBrains Mono',monospace;font-size:10.5px;font-weight:600;letter-spacing:.04em;padding:4px 10px;border-radius:100px;background:var(--yellow-soft);color:#8A5A00;margin-bottom:10px;text-transform:uppercase;}
.article-body h4{font-size:16.5px;line-height:1.45;margin:0 0 8px;display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden;}
.article-body p{font-size:13.5px;line-height:1.65;color:var(--text-soft);margin:0 0 10px;display:-webkit-box;-webkit-line-clamp:4;-webkit-box-orient:vertical;overflow:hidden;}
.article-meta{font-size:12.5px;color:var(--text-soft);margin-top:10px;}
.article-meta .cat{color:var(--green-primary);font-weight:700;}
.article-link{display:inline-flex;align-items:center;gap:6px;margin-top:auto;padding-top:12px;color:var(--green-primary);font-weight:700;font-size:13px;text-decoration:none;}
.article-link svg{transition:transform .2s;}
.article-link:hover{text-decoration:underline;}
.article-link:hover svg{transform:translateX(3px);}

/* testimonial */
.test-card{background:#fff;border:1px solid var(--line);border-radius:var(--radius);padding:26px;box-shadow:var(--shadow);}
.stars{color:var(--yellow-potato);font-size:14px;margin-bottom:10px;letter-spacing:2px;}
.test-quote{font-style:italic;color:var(--text);font-size:15px;}
.test-person{display:flex;align-items:center;gap:12px;margin-top:16px;}
.avatar{width:42px;height:42px;border-radius:50%;background:var(--green-soft);color:var(--green-primary);display:flex;align-items:center;justify-content:center;font-weight:700;font-family:'Fraunces',serif;}
.test-person b{display:block;font-size:14px;}
.test-person span{font-size:12.5px;color:var(--text-soft);}

/* faq accordion */
.faq-item{border-bottom:1px solid var(--line);}
.faq-q{display:flex;justify-content:space-between;align-items:center;padding:20px 4px;cursor:pointer;font-weight:700;font-size:15.5px;}
.faq-q .plus{transition:.2s;color:var(--green-primary);font-size:20px;}
.faq-a{max-height:0;overflow:hidden;transition:.25s ease;font-size:14.5px;}
.faq-a-inner{padding:0 4px 20px;color:var(--text-soft);}

/* step flow */
.flow{display:flex;gap:0;overflow-x:auto;padding-bottom:10px;}
.flow-step{flex:1;min-width:170px;text-align:center;position:relative;padding:0 14px;}
.flow-step .num{width:46px;height:46px;border-radius:50%;background:var(--green-primary);color:#fff;display:flex;align-items:center;justify-content:center;font-family:'Fraunces',serif;font-weight:600;margin:0 auto 14px;position:relative;z-index:2;}
.flow-step::after{content:"";position:absolute;top:23px;left:calc(50% + 30px);right:calc(-50% + 30px);height:2px;background:var(--line);z-index:1;}
.flow-step:last-child::after{display:none;}
.flow-step h4{font-size:14.5px;margin-bottom:4px;}
.flow-step p{font-size:13px;margin:0;}
@media(max-width:760px){
  .flow{scroll-snap-type:x mandatory;margin:0 -24px;padding-left:24px;padding-right:24px;scrollbar-width:none;}
  .flow::-webkit-scrollbar{display:none;}
  .flow-step{flex:0 0 68%;min-width:0;scroll-snap-align:start;background:#fff;border:1px solid var(--line);border-radius:var(--radius);padding:22px 18px;box-shadow:var(--shadow);}
  .flow-step::after{display:none;}
}

/* gallery */
.gal-item{border-radius:var(--radius);overflow:hidden;aspect-ratio:1/1;position:relative;cursor:pointer;display:flex;align-items:center;justify-content:center;}
.gal-item .gal-label{position:absolute;bottom:0;left:0;right:0;padding:12px 14px;background:linear-gradient(0deg,rgba(0,0,0,.55),transparent);color:#fff;font-size:13px;font-weight:700;}

/* footer */
footer{background:var(--green-deep);color:#C7D6C4;padding:64px 0 24px;}
footer h4{color:#fff;font-size:15px;margin-bottom:16px;font-family:'Manrope',sans-serif;font-weight:700;}
footer a{font-size:14px;color:#C7D6C4;display:block;margin-bottom:9px;cursor:pointer;overflow-wrap:anywhere;}
footer a:hover{color:var(--yellow-potato);}
.foot-grid{display:grid;grid-template-columns:1.4fr 1fr 1fr 1.2fr;gap:32px;}
@media(max-width:800px){.foot-grid{grid-template-columns:repeat(2,minmax(0,1fr));gap:28px;}}
.foot-bottom{border-top:1px solid rgba(255,255,255,.12);margin-top:44px;padding-top:22px;font-size:12.5px;display:flex;justify-content:space-between;flex-wrap:wrap;gap:10px;color:#9EB39A;}
.social-row{display:flex;flex-wrap:wrap;gap:10px;margin-top:6px;}
.social-row a{width:34px;height:34px;border-radius:50%;background:rgba(255,255,255,.08);display:flex;align-items:center;justify-content:center;margin:0;}

/* wa float */
.wa-float{position:fixed;bottom:22px;right:22px;z-index:60;background:#25D366;color:#fff;width:58px;height:58px;border-radius:50%;display:flex;align-items:center;justify-content:center;box-shadow:0 10px 24px -8px rgba(0,0,0,.4);}
.wa-float svg{width:28px;height:28px;}

/* breadcrumb */
.breadcrumb{font-size:13px;color:var(--text-soft);margin-bottom:20px;display:flex;gap:6px;align-items:center;}
.breadcrumb a{color:var(--green-primary);cursor:pointer;font-weight:600;}

/* price display */
.prod-harga{font-family:'Fraunces',serif;font-size:20px;font-weight:600;color:var(--green-primary);margin:4px 0 8px;}
.detail-harga{font-family:'Fraunces',serif;font-size:28px;font-weight:600;color:var(--green-primary);margin:6px 0 14px;}

/* variant list */
.variant-list{display:flex;flex-direction:column;gap:8px;}
.variant-item{display:flex;align-items:center;justify-content:space-between;gap:12px;padding:12px 14px;border:1px solid var(--line);border-radius:10px;background:#fff;flex-wrap:wrap;}
.variant-selectable{border:2px solid var(--line);transition:.15s;}
.variant-selectable:hover{border-color:var(--green-primary);background:var(--green-soft);}
.variant-selectable.active{border-color:var(--green-primary);background:var(--green-soft);box-shadow:0 0 0 1px var(--green-primary);position:relative;}
.variant-selectable.active::after{content:"✓";position:absolute;top:-6px;right:-6px;width:20px;height:20px;border-radius:50%;background:var(--green-primary);color:#fff;font-size:11px;font-weight:700;display:flex;align-items:center;justify-content:center;}
.variant-info{display:flex;flex-direction:column;gap:2px;}
.variant-info b{font-size:14.5px;color:var(--text);}
.variant-harga{font-family:'Fraunces',serif;font-size:17px;font-weight:600;color:var(--green-primary);}
.variant-meta{display:flex;gap:8px;align-items:center;}

/* detail spec table */
.spec-table{width:100%;border-collapse:collapse;font-size:14.5px;}
.spec-table td{padding:11px 6px;border-bottom:1px solid var(--line);}
.spec-table td:first-child{color:var(--text-soft);width:44%;}
.spec-table td:last-child{font-weight:700;}

.toast{position:fixed;bottom:24px;left:50%;transform:translateX(-50%);background:var(--green-deep);color:#fff;padding:14px 24px;border-radius:100px;font-size:14px;font-weight:600;z-index:999;box-shadow:var(--shadow);}
.toast-stack{position:fixed;bottom:80px;right:20px;z-index:999;display:flex;flex-direction:column;gap:8px;pointer-events:none;}
.toast-item{pointer-events:auto;background:var(--green-deep);color:#fff;padding:12px 20px;border-radius:12px;font-size:13px;font-weight:600;box-shadow:0 6px 20px rgba(0,0,0,.2);transform:translateX(120%);opacity:0;transition:.35s cubic-bezier(.22,1,.36,1);max-width:340px;}
.toast-item.in{transform:translateX(0);opacity:1;}
.toast-item.out{transform:translateX(120%);opacity:0;}

/* cart drawer */
.drawer-overlay{position:fixed;inset:0;z-index:100;background:rgba(31,61,34,.55);opacity:0;visibility:hidden;transition:.3s;backdrop-filter:blur(2px);}
.drawer-overlay.open{opacity:1;visibility:visible;}
.drawer{position:fixed;top:0;right:0;bottom:0;width:420px;max-width:92vw;z-index:101;background:#fff;box-shadow:-8px 0 40px rgba(0,0,0,.15);transform:translateX(100%);transition:.4s cubic-bezier(.22,1,.36,1);display:flex;flex-direction:column;}
.drawer.open{transform:translateX(0);}
.drawer-head{display:flex;align-items:center;justify-content:space-between;padding:18px 22px;border-bottom:1px solid var(--line);}
.drawer-head h3{margin:0;font-size:18px;font-family:'Montserrat',sans-serif;color:var(--green-deep);}
.drawer-close{width:36px;height:36px;border-radius:50%;border:none;background:var(--cream);cursor:pointer;font-size:18px;display:flex;align-items:center;justify-content:center;color:var(--text-soft);transition:.2s;}
.drawer-close:hover{background:var(--green-soft);color:var(--green-deep);}
.drawer-body{flex:1;overflow-y:auto;padding:16px 22px;}
.drawer-foot{border-top:1px solid var(--line);padding:16px 22px 22px;display:none;flex-direction:column;gap:10px;}
.drawer-total{display:flex;justify-content:space-between;font-size:17px;font-weight:700;color:var(--green-deep);font-family:'Fraunces',serif;margin-bottom:4px;}
.drawer-total span:last-child{color:var(--green-primary);}

/* cart item */
.cart-item{display:flex;gap:14px;padding:14px 0;border-bottom:1px solid var(--line);}
.cart-item:last-child{border-bottom:none;}
.cart-item-thumb{width:52px;height:52px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:22px;flex:none;background:var(--green-soft);}
.cart-item-info{flex:1;min-width:0;}
.cart-item-name{font-size:14px;font-weight:700;color:var(--text);margin-bottom:2px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
.cart-item-variant{font-size:12px;color:var(--text-soft);margin-bottom:4px;}
.cart-item-price{font-family:'Fraunces',serif;font-size:15px;font-weight:600;color:var(--green-primary);margin-bottom:6px;}
.cart-item-controls{display:flex;align-items:center;gap:8px;}
.qty-ctrl{width:28px;height:28px;border-radius:7px;border:1.5px solid var(--line);background:var(--cream);cursor:pointer;font-size:15px;font-weight:700;display:flex;align-items:center;justify-content:center;color:var(--text);transition:.15s;}
.qty-ctrl:hover{background:var(--green-soft);border-color:var(--green-primary);color:var(--green-primary);}
.qty-val{font-size:15px;font-weight:700;min-width:20px;text-align:center;}
.cart-item-del{background:none;border:none;cursor:pointer;font-size:16px;color:var(--text-soft);padding:4px;align-self:flex-start;transition:.15s;}
.cart-item-del:hover{color:#EF4444;}
.cart-empty-state{text-align:center;padding:60px 20px;color:var(--text-soft);}
.cart-empty-state .empty-icon{font-size:48px;margin-bottom:12px;}
.cart-empty-state .empty-title{font-size:18px;font-weight:700;color:var(--text);margin-bottom:6px;}
.cart-empty-state .empty-sub{font-size:13px;}

/* modal overlay (shared) */
.modal-overlay{position:fixed;inset:0;z-index:110;background:rgba(31,61,34,.55);opacity:0;visibility:hidden;transition:.3s;backdrop-filter:blur(2px);display:flex;align-items:center;justify-content:center;}
.modal-overlay.open{opacity:1;visibility:visible;}
.modal-box{background:#fff;border-radius:18px;width:520px;max-width:92vw;max-height:90vh;overflow-y:auto;box-shadow:0 20px 60px rgba(0,0,0,.2);padding:0;transform:scale(.95);transition:.3s cubic-bezier(.22,1,.36,1);}
.modal-overlay.open .modal-box{transform:scale(1);}
.modal-box-head{display:flex;align-items:center;justify-content:space-between;padding:18px 24px;border-bottom:1px solid var(--line);position:sticky;top:0;background:#fff;z-index:2;border-radius:18px 18px 0 0;}
.modal-box-head h3{margin:0;font-size:18px;font-family:'Montserrat',sans-serif;color:var(--green-deep);}
.modal-box-body{padding:20px 24px;}
.modal-box-foot{border-top:1px solid var(--line);padding:14px 24px;display:flex;justify-content:flex-end;gap:8px;}

/* checkout form */
.checkout-field{margin-bottom:16px;}
.checkout-field label{display:block;font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:.04em;color:var(--text-soft);margin-bottom:5px;}
.checkout-field input,.checkout-field textarea,.checkout-field select{width:100%;padding:11px 14px;border:1.5px solid var(--line);border-radius:10px;font-family:'Manrope',sans-serif;font-size:14px;background:var(--cream);color:var(--text);transition:.15s;}
.checkout-field input:focus,.checkout-field textarea:focus,.checkout-field select:focus{outline:none;border-color:var(--green-primary);background:#fff;}
.checkout-field textarea{resize:vertical;min-height:60px;}
.checkout-total{background:var(--green-soft);border-radius:12px;padding:14px 18px;margin:6px 0 16px;display:flex;justify-content:space-between;align-items:center;}
.checkout-total span{font-size:14px;font-weight:600;color:var(--green-deep);}
.checkout-total strong{font-family:'Fraunces',serif;font-size:22px;color:var(--green-primary);}
.payment-options{display:flex;gap:10px;margin-bottom:16px;}
.payment-option{flex:1;padding:12px;border:2px solid var(--line);border-radius:12px;text-align:center;cursor:pointer;transition:.15s;background:var(--cream);}
.payment-option:hover{border-color:var(--green-primary);}
.payment-option.active{border-color:var(--green-primary);background:var(--green-soft);}
.payment-option .po-icon{font-size:24px;margin-bottom:4px;}
.payment-option .po-label{font-size:12px;font-weight:700;color:var(--text);}

/* tracking modal */
.track-field{margin-bottom:12px;}
.track-field label{display:block;font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:.04em;color:var(--text-soft);margin-bottom:5px;}
.track-field input{width:100%;padding:11px 14px;border:1.5px solid var(--line);border-radius:10px;font-family:'Manrope',sans-serif;font-size:14px;background:var(--cream);}
.track-field input:focus{outline:none;border-color:var(--green-primary);background:#fff;}
.track-result{padding:16px;background:var(--green-soft);border-radius:12px;margin-top:14px;font-size:14px;line-height:1.7;}
.track-result .status-badge{display:inline-flex;padding:4px 14px;border-radius:100px;font-size:12px;font-weight:700;}
.track-result .track-item{display:flex;justify-content:space-between;padding:4px 0;font-size:13px;border-bottom:1px solid var(--line);}
.track-result .track-item:last-child{border-bottom:none;}

/* responsive */
@media(max-width:600px){
  .drawer{width:100vw;max-width:100vw;}
  .modal-box{max-width:100vw;border-radius:14px;margin:10px;max-height:95vh;}
  .modal-box-head{padding:14px 18px;border-radius:14px 14px 0 0;}
  .modal-box-body{padding:16px 18px;}
  .payment-options{flex-direction:column;gap:6px;}
  .cart-item-thumb{width:44px;height:44px;font-size:18px;}
}

@media(max-width:480px){
  .drawer-head,.drawer-body,.drawer-foot{padding-left:16px;padding-right:16px;}
  .modal-box-body{padding:14px 16px;}
}

.tag-check{display:flex;gap:10px;align-items:flex-start;margin-bottom:12px;}
.tag-check svg{width:18px;height:18px;color:var(--green-primary);flex:none;margin-top:2px;}
.tag-check p{margin:0;font-size:14.5px;color:var(--text);}

.honey{position:absolute;left:-9999px;opacity:0;}
.form-field label{font-size:13px;font-weight:700;color:var(--text-soft);display:block;margin-bottom:6px;}
.form-field input,.form-field textarea,.form-field select{width:100%;padding:12px 14px;border-radius:9px;border:1px solid var(--line);font-family:'Manrope',sans-serif;font-size:14.5px;background:#fff;}
.form-field{margin-bottom:18px;}

.rfq-banner{background:var(--yellow-soft);border:1px solid var(--yellow-potato);border-radius:var(--radius);padding:22px 26px;display:flex;justify-content:space-between;align-items:center;gap:20px;flex-wrap:wrap;}

.lokasi-grid{display:grid;grid-template-columns:1fr 1fr;gap:40px;}
@media(max-width:760px){.lokasi-grid{grid-template-columns:1fr;gap:24px;}}

/* maps: hide embedded iframe on mobile, show a lightweight fallback card instead */
.map-fallback{display:none;align-items:center;justify-content:center;flex-direction:column;gap:10px;border-radius:var(--radius);text-align:center;padding:20px;}
@media(max-width:760px){
  .map-embed{display:none;}
  .map-fallback{display:flex;}
}
</style>
@stack('styles')
</head>
<body>
<script>
function toggleInfoMenu(e) {
  if (e) e.preventDefault();
  var dd = document.querySelector('.nav-dropdown');
  if (dd) dd.classList.toggle('open');
}
function toggleSearch(e) {
  if (e) e.preventDefault();
  var box = document.getElementById('navSearch');
  if (box) {
    box.classList.toggle('open');
    if (box.classList.contains('open')) {
      var inp = box.querySelector('input');
      if (inp) inp.focus();
    }
  }
}
document.addEventListener('DOMContentLoaded', function() {
    var burger = document.querySelector('.burger');
    var navLinks = document.querySelector('.nav-links');
    var navDropdown = document.querySelector('.nav-dropdown');

    if (burger) {
      burger.addEventListener('click', function() {
        navLinks?.classList.toggle('open');
        navDropdown?.classList.remove('open');
      });
    }

    navLinks?.querySelectorAll('a:not(.nav-dropdown-toggle)').forEach(function(a) {
      a.addEventListener('click', function() {
        navLinks.classList.remove('open');
      });
    });

    var ddMenu = document.querySelector('.nav-dropdown-menu');
    if (ddMenu) {
      ddMenu.querySelectorAll('a').forEach(function(a) {
        a.addEventListener('click', function() {
          navDropdown?.classList.remove('open');
          navLinks?.classList.remove('open');
        });
      });
    }

    document.addEventListener('click', function(e) {
      if (navDropdown && !navDropdown.contains(e.target)) {
        navDropdown.classList.remove('open');
      }
    });

    document.querySelectorAll('.faq-q').forEach(function(el) {
        el.addEventListener('click', function() {
            var answer = this.nextElementSibling;
            var plus = this.querySelector('.plus');
            if (answer.style.maxHeight && answer.style.maxHeight !== '0px') {
                answer.style.maxHeight = '0';
                if (plus) plus.textContent = '+';
            } else {
                document.querySelectorAll('.faq-a').forEach(function(a) { a.style.maxHeight = '0'; });
                document.querySelectorAll('.faq-q .plus').forEach(function(p) { p.textContent = '+'; });
                answer.style.maxHeight = answer.scrollHeight + 'px';
                if (plus) plus.textContent = '–';
            }
        });
    });

    var heroSlider = document.getElementById('heroSlider');
    if (heroSlider) {
        var slides = heroSlider.querySelectorAll('.hero-slide');
        var dots = heroSlider.querySelectorAll('.hero-dots span');
        var current = 0;
        var timer = null;

        function goTo(index) {
            if (!slides.length) return;
            current = (index + slides.length) % slides.length;
            slides.forEach(function(s, i) { s.classList.toggle('active', i === current); });
            dots.forEach(function(d, i) { d.classList.toggle('active', i === current); });
        }

        function next() { goTo(current + 1); }
        function prev() { goTo(current - 1); }
        function startAuto() {
            timer = setInterval(next, 5000);
        }
        function stopAuto() {
            if (timer) { clearInterval(timer); timer = null; }
        }
        function restartAuto() {
            stopAuto();
            startAuto();
        }

        heroSlider.addEventListener('mouseenter', stopAuto);
        heroSlider.addEventListener('mouseleave', restartAuto);

        var btnPrev = document.getElementById('heroPrev');
        var btnNext = document.getElementById('heroNext');
        if (btnPrev) btnPrev.addEventListener('click', function() { prev(); restartAuto(); });
        if (btnNext) btnNext.addEventListener('click', function() { next(); restartAuto(); });

        dots.forEach(function(d, i) {
            d.addEventListener('click', function() { goTo(i); restartAuto(); });
        });

        if (slides.length > 1) startAuto();
    }
});
</script>

@yield('content')

<footer>
  <div class="container foot-grid">
    <div>
      <div class="logo" style="margin-bottom:14px">
        <img src="{{ $settingValue('LOGO_URL', asset('images/logo.png')) }}" alt="{{ $settingValue('APP_NAME', 'Fredian Farm') }}" class="logo-img" style="height:44px">
      </div>
      <p style="font-size:14px;max-width:260px">{{ $settingValue('FOOTER_TAGLINE', 'Produsen dan distributor bibit kentang bersertifikat sejak 2012 — Dieng, Jawa Tengah.') }}</p>
      <div class="social-row" style="margin-top:14px">
        @forelse ($mediaSosials as $ms)
          <a href="{{ $ms->url }}" target="_blank" rel="noopener" aria-label="{{ $ms->platform }}">@include('partials.social-icon', ['platform' => $ms->platform, 'size' => 15])</a>
        @empty
          <a href="https://www.tiktok.com/@fredianfarm" target="_blank" rel="noopener" aria-label="TikTok"><svg width="15" height="15" viewBox="0 0 24 24" fill="#fff"><path d="M16.6 5.8a4.6 4.6 0 01-3.3-1.4v9.9a4.9 4.9 0 11-4.9-4.9c.3 0 .5 0 .8.1v2.5a2.4 2.4 0 102 2.4V2h2.5a4.6 4.6 0 003.3 3.9v2.5a7 7 0 01-.4-2.6z"/></svg></a>
        @endforelse
      </div>
    </div>
    <div>
      <h4>Navigasi</h4>
      <a href="{{ route('about') }}">Tentang Kami</a>
      <a href="{{ route('produk.index') }}">Produk</a>
      <a href="{{ route('blog.index') }}">Blog</a>
      <a href="{{ route('galeri') }}">Galeri</a>
    </div>
    <div>
      <h4>Layanan</h4>
      <a href="{{ route('cara-pesan') }}">Cara Pemesanan</a>
      <a href="{{ route('faq') }}">FAQ</a>
      <a href="{{ route('kontak') }}">RFQ Partai Besar</a>
      <a href="{{ route('privasi') }}">Kebijakan Privasi</a>
    </div>
    <div>
      <h4>Hubungi Kami</h4>
      @php
        $waFooter = preg_replace('/[^0-9]/', '', \App\Models\Setting::getValue('NOMOR_WA', '0812-3456-7890'));
        if (str_starts_with($waFooter, '0')) {
            $waFooter = '62' . substr($waFooter, 1);
        }
        $emailFooter = \App\Models\Setting::getValue('EMAIL', 'halo@fredianfarm.co.id');
        $alamatFooter = \App\Models\Setting::getValue('ALAMAT', 'Dieng, Jawa Tengah');
      @endphp
      <a href="https://wa.me/{{ $waFooter }}" target="_blank">WA {{ \App\Models\Setting::getValue('NOMOR_WA', '0812-3456-7890') }}</a>
      <a href="mailto:{{ $emailFooter }}">{{ $emailFooter }}</a>
      <a>{{ $alamatFooter }}</a>
    </div>
  </div>
  <div class="container foot-bottom">
    <span>{{ $settingValue('FOOTER_TEXT', '© ' . date('Y') . ' Fredian Farm. Seluruh hak cipta dilindungi.') }}</span>
  </div>
</footer>

<a class="wa-float" href="https://wa.me/{{ preg_replace('/[^0-9]/', '', \App\Models\Setting::getValue('NOMOR_WA', '6281234567890')) }}" target="_blank" rel="noopener" aria-label="Chat WhatsApp">
  <svg viewBox="0 0 24 24" fill="#fff"><path d="M12 2a10 10 0 00-8.6 15L2 22l5.1-1.3A10 10 0 1012 2zm5.6 14.2c-.2.6-1.3 1.2-1.8 1.2-.5.1-1 .1-1.6-.1-.4-.1-.9-.3-1.5-.6-2.7-1.2-4.5-3.9-4.6-4.1-.1-.2-1.1-1.5-1.1-2.8 0-1.3.7-2 .9-2.2.2-.2.5-.3.7-.3h.5c.2 0 .4 0 .6.4.2.5.7 1.8.8 1.9.1.2.1.3 0 .5-.1.2-.1.3-.3.5l-.4.5c-.1.2-.3.3-.1.6.2.3.8 1.3 1.7 2.1 1.2 1 2.1 1.4 2.4 1.5.3.1.5.1.6-.1.2-.2.7-.8.9-1 .2-.3.4-.2.6-.1l1.7.8c.2.1.3.2.4.3.1.2.1.8-.1 1.4z"/></svg>
</a>

<!-- CART DRAWER OVERLAY -->
<div class="drawer-overlay" id="cartOverlay" onclick="closeCart()"></div>

<!-- CART DRAWER -->
<div class="drawer" id="cartDrawer">
  <div class="drawer-head">
    <h3>Keranjang</h3>
    <button class="drawer-close" onclick="closeCart()">✕</button>
  </div>
  <div class="drawer-body" id="cartBody">
    <div class="cart-empty-state">
      <div class="empty-icon">
        <svg width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="var(--text-soft)" stroke-width="1.5"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.7 13.4a2 2 0 002 1.6h9.7a2 2 0 002-1.6L23 6H6"/></svg>
      </div>
      <div class="empty-title">Keranjang Kosong</div>
      <div class="empty-sub">Belum ada produk yang dipilih.<br>Mulai belanja sekarang!</div>
    </div>
  </div>
  <div class="drawer-foot" id="cartFoot">
    <div class="drawer-total">
      <span>Total</span>
      <span id="cartTotal">Rp 0</span>
    </div>
    <button class="btn btn-primary" onclick="openCheckout()" style="width:100%">Checkout & Isi Data</button>
    <button class="btn btn-accent" onclick="quickWaCheckout()" style="width:100%">Langsung Pesan via WhatsApp</button>
  </div>
</div>

<!-- CHECKOUT MODAL -->
<div class="modal-overlay" id="checkoutOverlay" onclick="closeCheckout(event)">
  <div class="modal-box">
    <div class="modal-box-head">
      <h3>Checkout</h3>
      <button class="drawer-close" onclick="closeCheckout()">✕</button>
    </div>
    <div class="modal-box-body">
      <div class="checkout-field">
        <label>Nama Lengkap <span style="color:#EF4444">*</span></label>
        <input type="text" id="cfName" placeholder="Masukkan nama Anda" required>
      </div>
      <div class="checkout-field">
        <label>Nomor WhatsApp <span style="color:#EF4444">*</span></label>
        <input type="tel" id="cfWa" placeholder="08xxxxxxxxxx" required>
      </div>
      <div class="checkout-field">
        <label>Alamat Pengiriman Lengkap <span style="color:#EF4444">*</span></label>
        <textarea id="cfAddr" rows="3" placeholder="Jalan, desa/kelurahan, kecamatan, kota, provinsi, kode pos" required></textarea>
      </div>
      <div style="font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:.04em;color:var(--text-soft);margin-bottom:6px">Metode Pembayaran</div>
      <div class="payment-options">
        <div class="payment-option active" data-method="transfer" onclick="selectPayment(this)">
          <div class="po-icon">🏦</div>
          <div class="po-label">Transfer Bank</div>
        </div>
        <div class="payment-option" data-method="cod" onclick="selectPayment(this)">
          <div class="po-icon">💵</div>
          <div class="po-label">COD (Bayar di Tempat)</div>
        </div>
      </div>
      <div class="checkout-total">
        <span>Total Pesanan</span>
        <strong id="checkoutTotal">Rp 0</strong>
      </div>
      <div id="checkoutError" style="color:#EF4444;font-size:13px;display:none;margin-bottom:10px"></div>
    </div>
    <div class="modal-box-foot">
      <button class="btn btn-ghost" onclick="closeCheckout()">Batal</button>
      <button class="btn btn-primary" onclick="submitOrder()">Kirim Pesanan via WhatsApp</button>
    </div>
  </div>
</div>

<!-- TRACKING MODAL -->
<div class="modal-overlay" id="trackOverlay" onclick="closeTrack(event)">
  <div class="modal-box">
    <div class="modal-box-head">
      <h3>Lacak Pesanan</h3>
      <button class="drawer-close" onclick="closeTrack()">✕</button>
    </div>
    <div class="modal-box-body">
      <div class="track-field">
        <label>Nomor Pesanan</label>
        <input type="text" id="trackId" placeholder="Contoh: FRD-20260720-0001">
      </div>
      <div class="track-field">
        <label>Nomor WhatsApp (sesuai saat order)</label>
        <input type="tel" id="trackWa" placeholder="08xxxxxxxxxx">
      </div>
      <button class="btn btn-primary" onclick="cekPesanan()" style="width:100%">Cari Pesanan</button>
      <div class="track-result" id="trackResult" style="display:none"></div>
    </div>
  </div>
</div>

<!-- TOAST STACK -->
<div class="toast-stack" id="toastStack"></div>

@stack('scripts')

<script>
// ═══ CART STATE ═══
let cart = [];

function loadCart() {
  try {
    const saved = localStorage.getItem('fredianfarm_cart');
    if (saved) cart = JSON.parse(saved);
  } catch(e) { cart = []; }
  updateCartBadge();
}

function saveCart() {
  try { localStorage.setItem('fredianfarm_cart', JSON.stringify(cart)); } catch(e) {}
}

function addToCart(produkId, variantId, nama, variantNama, harga, berat, stokStatus) {
  const key = variantId ? produkId + '-' + variantId : produkId + '';
  const ex = cart.find(x => x.key === key);
  if (ex) {
    ex.qty++;
  } else {
    cart.push({ key, produk_id: produkId, variant_id: variantId, nama, variant_nama: variantNama, harga, berat, stok_status: stokStatus, qty: 1 });
  }
  saveCart();
  updateCartBadge();
  showToast((variantNama || nama) + ' ditambahkan');
}

function updateCartBadge() {
  const total = cart.reduce((s, x) => s + x.qty, 0);
  document.querySelectorAll('.cart-badge').forEach(el => {
    el.textContent = total;
    el.style.display = total > 0 ? 'flex' : 'none';
  });
}

function openCart() {
  document.getElementById('cartOverlay').classList.add('open');
  document.getElementById('cartDrawer').classList.add('open');
  renderCart();
}

function closeCart() {
  document.getElementById('cartOverlay').classList.remove('open');
  document.getElementById('cartDrawer').classList.remove('open');
}

function renderCart() {
  const body = document.getElementById('cartBody');
  const foot = document.getElementById('cartFoot');
  if (!cart.length) {
    body.innerHTML = '<div class="cart-empty-state"><div class="empty-icon"><svg width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="var(--text-soft)" stroke-width="1.5"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.7 13.4a2 2 0 002 1.6h9.7a2 2 0 002-1.6L23 6H6"/></svg></div><div class="empty-title">Keranjang Kosong</div><div class="empty-sub">Belum ada produk yang dipilih.<br>Mulai belanja sekarang!</div></div>';
    foot.style.display = 'none';
    return;
  }
  foot.style.display = 'flex';
  const total = cart.reduce((s, x) => s + x.harga * x.qty, 0);
  document.getElementById('cartTotal').textContent = 'Rp ' + fmt(total);
  body.innerHTML = cart.map(item => `
    <div class="cart-item">
      <div class="cart-item-thumb"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M21 8l-9-5-9 5v8l9 5 9-5V8z"/><path d="M3.3 8l8.7 4.9L20.7 8M12 12.9V21"/></svg></div>
      <div class="cart-item-info">
        <div class="cart-item-name">${item.nama}</div>
        ${item.variant_nama ? '<div class="cart-item-variant">' + item.variant_nama + '</div>' : ''}
        <div class="cart-item-price">Rp ${fmt(item.harga)}</div>
        <div class="cart-item-controls">
          <button class="qty-ctrl" onclick="chQty('${item.key}',-1)">−</button>
          <span class="qty-val">${item.qty}</span>
          <button class="qty-ctrl" onclick="chQty('${item.key}',1)">+</button>
        </div>
      </div>
      <button class="cart-item-del" onclick="delItem('${item.key}')" title="Hapus"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M3 6h18M8 6V4a2 2 0 012-2h4a2 2 0 012 2v2m3 0v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6"/></svg></button>
    </div>
  `).join('');
}

function chQty(key, d) {
  const item = cart.find(x => x.key === key);
  if (!item) return;
  item.qty += d;
  if (item.qty <= 0) cart = cart.filter(x => x.key !== key);
  saveCart();
  updateCartBadge();
  renderCart();
}

function delItem(key) {
  cart = cart.filter(x => x.key !== key);
  saveCart();
  updateCartBadge();
  renderCart();
  showToast('Produk dihapus dari keranjang');
}

// ═══ CHECKOUT ═══
let selectedPayment = 'transfer';

function selectPayment(el) {
  document.querySelectorAll('.payment-option').forEach(x => x.classList.remove('active'));
  el.classList.add('active');
  selectedPayment = el.dataset.method;
}

function openCheckout() {
  if (!cart.length) { showToast('Keranjang masih kosong'); return; }
  closeCart();
  const total = cart.reduce((s, x) => s + x.harga * x.qty, 0);
  document.getElementById('checkoutTotal').textContent = 'Rp ' + fmt(total);
  document.getElementById('checkoutError').style.display = 'none';
  document.getElementById('checkoutOverlay').classList.add('open');
}

function closeCheckout(e) {
  if (!e || e.target === document.getElementById('checkoutOverlay')) {
    document.getElementById('checkoutOverlay').classList.remove('open');
  }
}

function closeTrack(e) {
  if (!e || e.target === document.getElementById('trackOverlay')) {
    document.getElementById('trackOverlay').classList.remove('open');
  }
}

async function submitOrder() {
  const name = document.getElementById('cfName').value.trim();
  const wa = document.getElementById('cfWa').value.trim();
  const addr = document.getElementById('cfAddr').value.trim();
  const errEl = document.getElementById('checkoutError');
  errEl.style.display = 'none';

  if (!name || !wa || !addr) {
    errEl.textContent = 'Mohon isi semua data';
    errEl.style.display = 'block';
    return;
  }

  const total = cart.reduce((s, x) => s + x.harga * x.qty, 0);
  const items = cart.map(x => ({
    produk_id: x.produk_id,
    variant_id: x.variant_id,
    nama: x.nama,
    variant_nama: x.variant_nama,
    harga: x.harga,
    qty: x.qty,
    berat: x.berat,
    stok_status: x.stok_status,
  }));

  try {
    const res = await fetch('{{ route("checkout") }}', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
      body: JSON.stringify({ customer_name: name, customer_wa: wa, customer_address: addr, payment_method: selectedPayment, items: JSON.stringify(items), subtotal: total }),
    });
    const data = await res.json();
    if (!data.ok) {
      errEl.textContent = data.error || data.errors?.[Object.keys(data.errors||{})[0]]?.[0] || 'Gagal memproses pesanan';
      errEl.style.display = 'block';
      return;
    }
    if (data.wa_url) window.open(data.wa_url, '_blank');
    cart = []; saveCart(); updateCartBadge();
    closeCheckout();
    showToast('Pesanan berhasil dikirim via WhatsApp!');
  } catch (e) {
    errEl.textContent = 'Gagal terhubung ke server. Coba lagi.';
    errEl.style.display = 'block';
  }
}

async function quickWaCheckout() {
  if (!cart.length) { showToast('Keranjang masih kosong'); return; }
  const total = cart.reduce((s, x) => s + x.harga * x.qty, 0);
  const items = cart.map(x => ({
    produk_id: x.produk_id,
    variant_id: x.variant_id,
    nama: x.nama,
    variant_nama: x.variant_nama,
    harga: x.harga,
    qty: x.qty,
    berat: x.berat,
    stok_status: x.stok_status,
  }));
  try {
    const res = await fetch('{{ route("checkout") }}', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
      body: JSON.stringify({ customer_name: '-', customer_wa: '-', customer_address: '-', payment_method: 'transfer', items: JSON.stringify(items), subtotal: total }),
    });
    const data = await res.json();
    if (data.wa_url) window.open(data.wa_url, '_blank');
  } catch(e) {}
  cart = []; saveCart(); updateCartBadge();
  closeCart();
}

// ═══ TRACKING ═══
const esc = v => String(v ?? '').replace(/[&<>"']/g, c => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c]));
function openTrack() { document.getElementById('trackOverlay').classList.add('open'); }

async function cekPesanan() {
  const id = document.getElementById('trackId').value.trim();
  const wa = document.getElementById('trackWa').value.trim();
  const resEl = document.getElementById('trackResult');
  resEl.style.display = 'block';
  if (!id || !wa) {
    resEl.innerHTML = '<div style="text-align:center;padding:10px;color:#EF4444">Isi nomor pesanan dan nomor WA</div>';
    return;
  }
  resEl.innerHTML = '<div style="text-align:center;padding:10px;color:var(--text-soft)">Mencari pesanan...</div>';
  try {
    const res = await fetch('{{ route("tracking") }}?order_number=' + encodeURIComponent(id) + '&customer_wa=' + encodeURIComponent(wa));
    const d = await res.json();
    if (!d.ok || !d.data) {
      resEl.innerHTML = '<div style="text-align:center;padding:20px;color:#EF4444"><div style="font-weight:700;margin-bottom:4px">Pesanan Tidak Ditemukan</div><div style="font-size:13px;color:var(--text-soft)">Periksa kembali nomor pesanan dan nomor WA Anda.</div></div>';
      return;
    }
    const o = d.data;
    const statusMap = { baru: {bg:'#FEF3C7',color:'#D97706',label:'Baru'}, diproses:{bg:'#EFF6FF',color:'#2563EB',label:'Diproses'}, dikirim:{bg:'#DCFCE7',color:'#16A34A',label:'Dikirim'}, selesai:{bg:'#F3F4F6',color:'#6B7280',label:'Selesai'}, dibatalkan:{bg:'#FEE2E2',color:'#EF4444',label:'Dibatalkan'} };
    const s = statusMap[o.status] || {bg:'#F3F4F6',color:'#6B7280',label:o.status};
    let itemsHtml = '';
    let itemTotal = 0;
    if (Array.isArray(o.items)) {
      itemsHtml = o.items.map(it => {
        const name = esc(it.nama) + (it.variant_nama ? ' (' + esc(it.variant_nama) + ')' : '');
        itemTotal += it.harga * it.qty;
        return '<div class="track-item"><span>' + name + ' ×' + Number(it.qty) + '</span><span>Rp ' + fmt(it.harga * it.qty) + '</span></div>';
      }).join('');
    }
    const waNumber = '{{ \App\Models\Setting::getValue("NOMOR_WA", "6281234567890") }}';
    const waClean = waNumber.replace(/[^0-9]/g, '').replace(/^0/, '62');
    resEl.innerHTML = `
      <div style="margin-bottom:12px">
        <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:6px">
          <div><strong style="font-size:15px">${esc(o.order_number)}</strong><br><span style="font-size:12px;color:var(--text-soft)">${esc(o.created_at)}</span></div>
          <span class="status-badge" style="background:${s.bg};color:${s.color}">${esc(s.label)}</span>
        </div>
        <div style="font-size:14px;margin-top:4px"><strong>${esc(o.customer_name)}</strong></div>
      </div>
      <div style="margin-bottom:12px">
        <div style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.04em;color:var(--text-soft);margin-bottom:6px">PESANAN</div>
        ${itemsHtml || '<div style="font-size:13px;color:var(--text-soft)">' + esc(Array.isArray(o.items) ? '' : String(o.items || '')) + '</div>'}
        <div style="display:flex;justify-content:space-between;padding:6px 0 0;margin-top:4px;border-top:1.5px solid var(--line);font-weight:700;font-size:15px">
          <span>Total</span><span style="color:var(--green-primary)">Rp ${esc(o.grand_total)}</span>
        </div>
      </div>
      ${o.payment_method ? '<div style="font-size:13px;margin-bottom:8px">' + (o.payment_method === 'cod' ? 'Pembayaran: COD (Bayar di Tempat)' : 'Pembayaran: Transfer Bank') + '</div>' : ''}
      ${o.courier && o.tracking_number ? `
      <div style="background:${s.bg};border-radius:10px;padding:12px 14px;font-size:13px;margin-bottom:12px">
        <strong>Pengiriman:</strong> ${esc(o.courier)}<br>
        <strong>Resi:</strong> ${esc(o.tracking_number)}<br>
        <a href="https://cekresi.com/${encodeURIComponent(o.tracking_number)}" target="_blank" style="color:var(--green-primary);font-weight:700;font-size:12px">Lacak paket →</a>
      </div>` : o.status === 'dikirim' || o.status === 'selesai' ? `
      <div style="background:var(--cream);border-radius:10px;padding:12px 14px;font-size:13px;color:var(--text-soft);margin-bottom:12px">Nomor resi belum tersedia, hubungi admin via WhatsApp</div>` : ''}
      <a href="https://wa.me/${waClean}?text=${encodeURIComponent('Halo Fredian Farm! Saya ingin tanya soal pesanan ' + o.order_number)}" target="_blank" class="btn btn-primary" style="width:100%;text-decoration:none">Hubungi Admin</a>
    `;
  } catch(e) {
    resEl.innerHTML = '<div style="text-align:center;padding:10px;color:#EF4444">Gagal menghubungi server. Coba lagi.</div>';
  }
}

// ═══ TOAST ═══
function showToast(msg) {
  const stack = document.getElementById('toastStack');
  const el = document.createElement('div');
  el.className = 'toast-item';
  el.innerHTML = msg;
  stack.appendChild(el);
  requestAnimationFrame(() => { requestAnimationFrame(() => el.classList.add('in')); });
  setTimeout(() => {
    el.classList.add('out');
    setTimeout(() => el.remove(), 350);
  }, 3000);
}

// ═══ HELPERS ═══
function fmt(n) { return Number(n).toLocaleString('id-ID'); }

// ═══ INIT ═══
document.addEventListener('DOMContentLoaded', loadCart);
</script>
</body>
</html>
