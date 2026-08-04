<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\KategoriProduk;
use App\Models\GambarProduk;
use App\Http\Requests\Admin\StoreProdukRequest;
use App\Http\Requests\Admin\UpdateProdukRequest;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Format;
use Illuminate\Support\Facades\Storage;
use Mews\Purifier\Facades\Purifier;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::with('kategori')->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.produk.index', compact('produks'));
    }

    public function create()
    {
        $kategoris = KategoriProduk::where('is_active', true)->orderBy('nama')->get();
        return view('admin.produk.form', compact('kategoris'));
    }

    public function store(StoreProdukRequest $request)
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active');
        $data['deskripsi'] = Purifier::clean($data['deskripsi'] ?? '');

        $produk = Produk::create($data);

        if ($request->hasFile('foto')) {
            $this->simpanFoto($produk, $request->file('foto'));
        }

        return redirect()->route('admin.produk.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Produk $produk)
    {
        $kategoris = KategoriProduk::where('is_active', true)->orderBy('nama')->get();
        $produk->load('gambar');
        return view('admin.produk.form', compact('produk', 'kategoris'));
    }

    public function update(UpdateProdukRequest $request, Produk $produk)
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active');
        $data['deskripsi'] = Purifier::clean($data['deskripsi'] ?? '');

        if ($request->filled('hapus_foto')) {
            $produk->load('gambar');
            $ids = array_map('intval', $request->input('hapus_foto'));
            $produk->gambar->whereIn('id', $ids)->each(function ($g) {
                if ($g->url) {
                    Storage::disk('public')->delete($this->pathFromUrl($g->url));
                }
                $g->delete();
            });
        }

        $produk->update($data);

        if ($request->hasFile('foto')) {
            $this->simpanFoto($produk, $request->file('foto'));
        }

        return redirect()->route('admin.produk.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Produk $produk)
    {
        $produk->load('gambar');
        foreach ($produk->gambar as $g) {
            if ($g->url) {
                Storage::disk('public')->delete($this->pathFromUrl($g->url));
            }
        }
        $produk->delete();

        return redirect()->route('admin.produk.index')
            ->with('success', 'Produk berhasil dihapus.');
    }

    private function simpanFoto(Produk $produk, array $files): void
    {
        $manager = new ImageManager(new Driver());
        $lastUrutan = $produk->gambar()->max('urutan') ?? -1;
        $urutan = $lastUrutan + 1;

        Storage::disk('public')->makeDirectory('produk', 0755, true);

        foreach ($files as $file) {
            $image = $manager->decode($file);

            $filename = 'produk/' . uniqid() . '_' . time() . '.webp';
            $image->encodeUsingFormat(Format::WEBP, 80)->save(Storage::disk('public')->path($filename));

            GambarProduk::create([
                'produk_id' => $produk->id,
                'url' => Storage::disk('public')->url($filename),
                'urutan' => $urutan++,
            ]);
        }
    }

    private function pathFromUrl(?string $url): string
    {
        $base = '/storage/';
        if ($url && str_contains($url, $base)) {
            return substr($url, strpos($url, $base) + strlen($base));
        }
        return $url ?? '';
    }
}
