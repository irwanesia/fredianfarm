<?php
namespace App\Http\Controllers;
use App\Models\Produk;
use App\Models\Artikel;
use App\Models\KategoriArtikel;
use App\Models\Testimoni;
use App\Models\Faq;
use App\Models\Banner;
use App\Models\KategoriProduk;
use App\Models\Kontak;
use App\Models\Setting;
use App\Models\Galeri;
use App\Models\Order;
use App\Models\ProdukVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class PublicController extends Controller
{
    public function home()
    {
        $produks = Produk::where('is_active', true)->with('kategori', 'variants', 'gambar')->get();
        $artikels = Artikel::where('is_published', true)->with('kategori')->orderBy('published_at', 'desc')->get();
        $testimonis = Testimoni::where('is_active', true)->get();
        $faqs = Faq::where('is_active', true)->orderBy('urutan')->get();
        $banners = Banner::where('is_active', true)->orderBy('urutan')->orderBy('created_at', 'desc')->get();
        $mitras = \App\Models\Mitra::where('is_active', true)->orderBy('urutan')->get();
        $settings = Setting::all()->keyBy('key');
        return view('public.home', compact('produks', 'artikels', 'testimonis', 'faqs', 'banners', 'mitras', 'settings'));
    }

    public function about()
    {
        $settings = Setting::all()->keyBy('key');
        return view('public.about', compact('settings'));
    }

    public function aboutSejarah()
    {
        $settings = Setting::all()->keyBy('key');
        return view('public.tentang.sejarah', compact('settings'));
    }

    public function aboutVisiMisi()
    {
        $settings = Setting::all()->keyBy('key');
        $misi = array_values(array_filter(array_map('trim', explode("\n", Setting::getValue('MISI', '')))));
        return view('public.tentang.visi-misi', compact('settings', 'misi'));
    }

    public function aboutLokasi()
    {
        $settings = Setting::all()->keyBy('key');
        return view('public.tentang.lokasi', compact('settings'));
    }

    public function aboutSertifikasi()
    {
        $settings = Setting::all()->keyBy('key');
        return view('public.tentang.sertifikasi', compact('settings'));
    }

    public function produkIndex(Request $request)
    {
        $query = Produk::where('is_active', true)->with('kategori');
        if ($request->filled('kategori')) {
            $query->whereHas('kategori', fn($q) => $q->where('slug', $request->kategori));
        }
        if ($request->filled('jenis')) {
            $query->where('jenis', $request->jenis);
        }
        if ($request->filled('varietas')) {
            $query->where('varietas', $request->varietas);
        }
        if ($request->filled('stok')) {
            $query->where('stok_status', $request->stok);
        }
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function($sub) use ($q) {
                $sub->where('nama', 'like', "%{$q}%")
                    ->orWhere('deskripsi', 'like', "%{$q}%");
            });
        }
        $produks = $query->with('variants', 'gambar')->get();
        $kategoris = KategoriProduk::where('is_active', true)->orderBy('urutan')->get();
        $jenisList = Produk::where('is_active', true)
            ->whereNotNull('jenis')->where('jenis', '!=', '')
            ->distinct()->orderBy('jenis')->pluck('jenis')->values()->all();
        $varietasQuery = Produk::where('is_active', true)
            ->whereNotNull('varietas')->where('varietas', '!=', '');
        if ($request->filled('jenis')) {
            $varietasQuery->where('jenis', $request->jenis);
        }
        $varietasList = $varietasQuery->distinct()->orderBy('varietas')->pluck('varietas')->values()->all();
        return view('public.produk.index', compact('produks', 'kategoris', 'jenisList', 'varietasList'));
    }

    public function produkShow($slug)
    {
        $produk = Produk::where('slug', $slug)->where('is_active', true)->with('kategori', 'variants', 'gambar')->firstOrFail();
        $produkLain = Produk::where('is_active', true)->where('id', '!=', $produk->id)->with('kategori', 'gambar')->take(3)->get();
        return view('public.produk.show', compact('produk', 'produkLain'));
    }

    public function blogIndex(Request $request)
    {
        $query = Artikel::where('is_published', true)->with('kategori', 'user');
        if ($request->filled('kategori')) {
            $query->whereHas('kategori', fn($q) => $q->where('slug', $request->kategori));
        }
        $artikels = $query->orderBy('published_at', 'desc')->paginate(9);
        $kategoris = KategoriArtikel::where('is_active', true)->orderBy('urutan')->get();
        return view('public.blog.index', compact('artikels', 'kategoris'));
    }

    public function blogShow($slug)
    {
        $artikel = Artikel::where('slug', $slug)->where('is_published', true)->with('kategori', 'user')->firstOrFail();
        $artikelTerkait = Artikel::where('is_published', true)
            ->where('id', '!=', $artikel->id)
            ->where('kategori_id', $artikel->kategori_id)
            ->with('kategori')->take(3)->get();
        $artikelPopuler = Artikel::where('is_published', true)
            ->where('id', '!=', $artikel->id)
            ->inRandomOrder()->take(5)->get();
        $artikelTerbaru = Artikel::where('is_published', true)
            ->where('id', '!=', $artikel->id)
            ->orderBy('published_at', 'desc')->take(5)->get();
        $faqs = Faq::where('is_active', true)->orderBy('urutan')->get();
        return view('public.blog.show', compact('artikel', 'artikelTerkait', 'artikelPopuler', 'artikelTerbaru', 'faqs'));
    }

    public function search(Request $request)
    {
        $q = trim((string) $request->input('q'));
        $produks = collect();
        $artikels = collect();

        if ($q !== '') {
            $produks = Produk::where('is_active', true)
                ->with('kategori', 'variants', 'gambar')
                ->where(function ($sub) use ($q) {
                    $sub->where('nama', 'like', "%{$q}%")
                        ->orWhere('deskripsi', 'like', "%{$q}%");
                })
                ->orderBy('nama')->get();

            $artikels = Artikel::where('is_published', true)
                ->with('kategori', 'user')
                ->where(function ($sub) use ($q) {
                    $sub->where('judul', 'like', "%{$q}%")
                        ->orWhere('konten', 'like', "%{$q}%");
                })
                ->orderBy('published_at', 'desc')->get();
        }

        return view('public.search', compact('q', 'produks', 'artikels'));
    }

    public function caraPesan()
    {
        return view('public.cara-pesan');
    }

    public function galeri(Request $request)
    {
        $query = \App\Models\Galeri::where('is_active', true)->orderBy('urutan')->orderBy('created_at', 'desc');

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        $galeris = $query->get();
        $kategoris = \App\Models\Galeri::where('is_active', true)
            ->whereNotNull('kategori')
            ->distinct()
            ->pluck('kategori');

        return view('public.galeri', compact('galeris', 'kategoris'));
    }

    public function testimoni()
    {
        $testimonis = Testimoni::where('is_active', true)->get();
        return view('public.testimoni', compact('testimonis'));
    }

    public function faq()
    {
        $faqs = Faq::where('is_active', true)->orderBy('urutan')->get();
        return view('public.faq', compact('faqs'));
    }

    public function kontak()
    {
        $settings = Setting::all()->keyBy('key');
        return view('public.kontak', compact('settings'));
    }

    public function kontakStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'no_wa' => 'required|string|max:20',
            'pesan' => 'required|string',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        Kontak::create($request->only('nama', 'email', 'no_wa', 'pesan'));
        return back()->with('success', 'Pesan berhasil dikirim. Tim kami akan menghubungi Anda via WhatsApp.');
    }

    public function privasi()
    {
        return view('public.privasi');
    }

    public function checkout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_name' => 'required|string|max:255',
            'customer_wa' => 'required|string|max:20',
            'customer_address' => 'required|string',
            'payment_method' => 'required|in:transfer,cod',
            'items' => 'required|json',
        ]);

        if ($validator->fails()) {
            return response()->json(['ok' => false, 'errors' => $validator->errors()], 422);
        }

        $items = json_decode($request->items, true);
        if (!is_array($items) || empty($items)) {
            return response()->json(['ok' => false, 'error' => 'Keranjang kosong'], 400);
        }

        $cleanItems = [];
        $subtotal = 0;
        foreach ($items as $it) {
            $produkId = (int)($it['produk_id'] ?? 0);
            $variantId = (int)($it['variant_id'] ?? 0);
            $qty = max(1, (int)($it['qty'] ?? 1));

            $nama = '-';
            $variantNama = null;
            $harga = 0;
            $berat = null;

            if ($variantId) {
                $var = ProdukVariant::with('produk')->find($variantId);
                if ($var && $var->is_active && (int)$var->produk_id === $produkId && (int)$var->produk->is_active === 1) {
                    $nama = $var->produk->nama ?? '-';
                    $variantNama = $var->nama;
                    $harga = (float)$var->harga;
                    $berat = $var->berat;
                }
            } elseif ($produkId) {
                $prod = Produk::find($produkId);
                if ($prod && $prod->is_active) {
                    $nama = $prod->nama;
                    $harga = (float)$prod->harga;
                    $berat = $prod->berat;
                }
            }

            if ($nama === '-') {
                continue;
            }

            $subtotal += $harga * $qty;
            $cleanItems[] = [
                'produk_id' => $produkId,
                'variant_id' => $variantId ?: null,
                'nama' => $nama,
                'variant_nama' => $variantNama,
                'harga' => $harga,
                'qty' => $qty,
                'berat' => $berat,
            ];
        }

        if (empty($cleanItems)) {
            return response()->json(['ok' => false, 'error' => 'Produk tidak ditemukan pada keranjang'], 422);
        }

        $last = Order::orderBy('id', 'desc')->first();
        $nextId = $last ? $last->id + 1 : 1;
        $orderNumber = 'FRD-' . date('Ymd') . '-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);

        $order = Order::create([
            'order_number' => $orderNumber,
            'order_source' => 'wa',
            'customer_name' => $request->customer_name,
            'customer_wa' => $request->customer_wa,
            'customer_address' => $request->customer_address,
            'items' => $cleanItems,
            'subtotal' => $subtotal,
            'shipping_cost' => 0,
            'grand_total' => $subtotal,
            'payment_method' => $request->payment_method,
            'payment_status' => 'pending',
            'status' => 'baru',
        ]);

        $waNumber = Setting::getValue('NOMOR_WA', '6281234567890');
        $waClean = preg_replace('/[^0-9]/', '', $waNumber);
        if (substr($waClean, 0, 1) === '0') {
            $waClean = '62' . substr($waClean, 1);
        }

        $itemsStr = '';
        foreach ($cleanItems as $it) {
            $name = $it['nama'] ?? '-';
            $vname = $it['variant_nama'] ?? null;
            $qty = (int)($it['qty'] ?? 1);
            $price = (float)($it['harga'] ?? 0);
            $label = $name . ($vname ? ' (' . $vname . ')' : '');
            $itemsStr .= "• {$label} x{$qty} = Rp " . number_format($price * $qty, 0, ',', '.') . "\n";
        }

        $total = number_format($order->grand_total, 0, ',', '.');
        $method = $request->payment_method === 'cod' ? 'COD (Bayar di Tempat)' : 'Transfer Bank';

        $waMsg = "Halo Fredian Farm! 👋\n\nSaya ingin memesan:\n{$itemsStr}\n💰 *Total: Rp {$total}*\n\n📝 *Data Pemesan:*\nNama: {$request->customer_name}\nWA: {$request->customer_wa}\nAlamat: {$request->customer_address}\n\nPembayaran: {$method}\n\nMohon info estimasi pengiriman. Terima kasih!";

        return response()->json([
            'ok' => true,
            'order' => $order,
            'wa_url' => 'https://wa.me/' . $waClean . '?text=' . urlencode($waMsg),
        ]);
    }

    public function tracking(Request $request)
    {
        $request->validate([
            'order_number' => 'required|string|max:30',
            'customer_wa' => 'required|string|max:20',
        ]);

        $order = Order::where('order_number', $request->order_number)
            ->where('customer_wa', $request->customer_wa)
            ->first();

        if (!$order) {
            return response()->json(['ok' => false, 'error' => 'Pesanan tidak ditemukan'], 404);
        }

        return response()->json([
            'ok' => true,
            'data' => [
                'order_number' => $order->order_number,
                'customer_name' => $order->customer_name,
                'created_at' => $order->created_at->format('d M Y H:i'),
                'items' => $order->items,
                'subtotal' => $order->subtotal,
                'shipping_cost' => $order->shipping_cost,
                'grand_total' => $order->grand_total,
                'payment_method' => $order->payment_method,
                'status' => $order->status,
                'courier' => $order->courier,
                'tracking_number' => $order->tracking_number,
            ],
        ]);
    }
}
