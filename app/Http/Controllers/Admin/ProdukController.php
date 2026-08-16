<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\KategoriProduk;
use App\Models\GambarProduk;
use App\Models\ProdukVariant;
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
        $jenisList = $this->nilaiDistinct('jenis');
        $varietasList = $this->nilaiDistinct('varietas');
        return view('admin.produk.form', compact('kategoris', 'jenisList', 'varietasList'));
    }

    public function store(StoreProdukRequest $request)
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active');
        $data['deskripsi'] = Purifier::clean($data['deskripsi'] ?? '');

        $produk = Produk::create($data);

        $this->simpanVarians($produk, $request->input('variants'));

        if ($request->hasFile('foto')) {
            $this->simpanFoto($produk, $request->file('foto'));
        }

        return redirect()->route('admin.produk.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Produk $produk)
    {
        $kategoris = KategoriProduk::where('is_active', true)->orderBy('nama')->get();
        $jenisList = $this->nilaiDistinct('jenis');
        $varietasList = $this->nilaiDistinct('varietas');
        $produk->load('gambar', 'variants');
        return view('admin.produk.form', compact('produk', 'kategoris', 'jenisList', 'varietasList'));
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

        $this->simpanVarians($produk, $request->input('variants'));

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

    private function nilaiDistinct(string $kolom): array
    {
        return Produk::query()
            ->whereNotNull($kolom)
            ->where($kolom, '!=', '')
            ->distinct()
            ->orderBy($kolom)
            ->pluck($kolom)
            ->values()
            ->all();
    }

    private function simpanVarians(Produk $produk, ?array $rows): void
    {
        if (!is_array($rows)) {
            return;
        }

        $nextUrutan = ($produk->variants()->max('urutan') ?? 0) + 1;

        foreach ($rows as $row) {
            $nama = trim((string) ($row['nama'] ?? ''));
            if ($nama === '') {
                continue;
            }

            $id = (int) ($row['id'] ?? 0);

            if (!empty($row['hapus']) && $id) {
                ProdukVariant::where('id', $id)->where('produk_id', $produk->id)->delete();
                continue;
            }

            $data = [
                'nama' => $nama,
                'harga' => (float) ($row['harga'] ?? 0),
                'berat' => $row['berat'] !== '' && $row['berat'] !== null ? (string) $row['berat'] : null,
                'stok_status' => $row['stok_status'] ?? 'tersedia',
                'urutan' => $row['urutan'] !== '' && $row['urutan'] !== null ? (int) $row['urutan'] : $nextUrutan,
            ];

            if ($id) {
                ProdukVariant::where('id', $id)->where('produk_id', $produk->id)->update($data);
            } else {
                $data['produk_id'] = $produk->id;
                ProdukVariant::create($data);
            }

            $nextUrutan++;
        }
    }
}
