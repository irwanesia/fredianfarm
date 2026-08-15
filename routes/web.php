<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TinyMceUploadController;
use App\Http\Controllers\Admin\KategoriProdukController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\KategoriArtikelController;
use App\Http\Controllers\Admin\ArtikelController;
use App\Http\Controllers\Admin\ArtikelAiController;
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\Admin\TestimoniController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\MediaSosialController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KontakController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\SeoController;
use App\Http\Controllers\Admin\PenggunaController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\BankController;
use App\Http\Controllers\Admin\MitraController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\SitemapController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/about', [PublicController::class, 'about'])->name('about');
Route::get('/tentang/sejarah', [PublicController::class, 'aboutSejarah'])->name('about.sejarah');
Route::get('/tentang/visi-misi', [PublicController::class, 'aboutVisiMisi'])->name('about.visi-misi');
Route::get('/tentang/lokasi', [PublicController::class, 'aboutLokasi'])->name('about.lokasi');
Route::get('/tentang/sertifikasi', [PublicController::class, 'aboutSertifikasi'])->name('about.sertifikasi');
Route::get('/produk', [PublicController::class, 'produkIndex'])->name('produk.index');
Route::get('/produk/{slug}', [PublicController::class, 'produkShow'])->name('produk.show');
Route::get('/blog', [PublicController::class, 'blogIndex'])->name('blog.index');
Route::get('/blog/{slug}', [PublicController::class, 'blogShow'])->name('blog.show');
Route::get('/cara-pesan', [PublicController::class, 'caraPesan'])->name('cara-pesan');
Route::get('/galeri', [PublicController::class, 'galeri'])->name('galeri');
Route::get('/testimoni', [PublicController::class, 'testimoni'])->name('testimoni');
Route::get('/faq', [PublicController::class, 'faq'])->name('faq');
Route::get('/cari', [PublicController::class, 'search'])->name('cari');
Route::get('/kontak', [PublicController::class, 'kontak'])->name('kontak');
Route::post('/kontak', [PublicController::class, 'kontakStore'])->middleware(\Spatie\Honeypot\ProtectAgainstSpam::class, 'throttle:10,1')->name('kontak.store');
Route::get('/privasi', [PublicController::class, 'privasi'])->name('privasi');
Route::post('/checkout', [PublicController::class, 'checkout'])->middleware('throttle:10,1')->name('checkout');
Route::get('/tracking', [PublicController::class, 'tracking'])->middleware('throttle:10,1')->name('tracking');
Route::get('/robots.txt', [SitemapController::class, 'robots'])->name('robots.txt');
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap.xml');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1')->name('login.post');
});

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('logout', function (Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    })->name('logout');
    Route::get('search', function (Request $request) {
        $q = $request->input('q');
        return view('admin.search', compact('q'));
    })->name('search');
    Route::post('tinymce-upload', TinyMceUploadController::class)->name('tinymce.upload');
    Route::resource('kategori-produk', KategoriProdukController::class);
    Route::resource('produk', ProdukController::class);
    Route::resource('kategori-artikel', KategoriArtikelController::class);
    Route::resource('artikel', ArtikelController::class);
    Route::post('ai-artikel/{action}', ArtikelAiController::class)->middleware('throttle:5,60')->name('ai-artikel');
    Route::resource('galeri', GaleriController::class);
    Route::resource('testimoni', TestimoniController::class);
    Route::resource('faq', FaqController::class);
    Route::resource('banner', BannerController::class);

    Route::middleware('role:admin')->group(function () {
        Route::resource('media-sosial', MediaSosialController::class);
        Route::get('setting', [SettingController::class, 'index'])->name('setting.index');
        Route::post('setting', [SettingController::class, 'update'])->name('setting.update');
        Route::get('kontak', [KontakController::class, 'index'])->name('kontak.index');
        Route::patch('kontak/{kontak}/toggle', [KontakController::class, 'toggle'])->name('kontak.toggle');
        Route::delete('kontak/{kontak}', [KontakController::class, 'destroy'])->name('kontak.destroy');
        Route::get('seo', [SeoController::class, 'index'])->name('seo.index');
        Route::post('seo', [SeoController::class, 'update'])->name('seo.update');
        Route::resource('pengguna', PenggunaController::class)->except(['show']);
        Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
        Route::post('orders', [OrderController::class, 'store'])->name('orders.store');
        Route::get('orders/{order}', [OrderController::class, 'show'])->name('orders.show');
        Route::put('orders/{order}', [OrderController::class, 'update'])->name('orders.update');
        Route::delete('orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
        Route::get('orders/{order}/confirm', [OrderController::class, 'confirm'])->name('orders.confirm');
        Route::resource('banks', BankController::class);
        Route::resource('mitra', MitraController::class);
    });
});
