<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Artikel;
use App\Models\Kontak;
class DashboardController extends Controller
{
    public function index()
    {
        $totalProduk = Produk::count();
        $artikelPublished = Artikel::where('is_published', true)->count();
        $pesanBaru = Kontak::where('dibaca', false)->count();
        $produks = Produk::with('kategori')->where('is_active', true)->orderBy('nama')->get();
        $artikels = Artikel::with('kategori')->where('is_published', true)->orderBy('published_at', 'desc')->take(4)->get();
        $kontaks = Kontak::orderBy('created_at', 'desc')->take(4)->get();

        $chartLabels = [];
        $chartKontak = [];
        $chartArtikel = [];
        for ($i = 13; $i >= 0; $i--) {
            $day = now()->subDays($i)->startOfDay();
            $chartLabels[] = $day->translatedFormat('d M');
            $chartKontak[] = Kontak::whereBetween('created_at', [$day, $day->copy()->endOfDay()])->count();
            $chartArtikel[] = Artikel::whereBetween('published_at', [$day, $day->copy()->endOfDay()])->count();
        }

        return view('admin.dashboard', compact(
            'totalProduk', 'artikelPublished', 'pesanBaru',
            'produks', 'artikels', 'kontaks',
            'chartLabels', 'chartKontak', 'chartArtikel'
        ));
    }
}
