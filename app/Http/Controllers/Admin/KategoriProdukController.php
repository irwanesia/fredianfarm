<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriProduk;
use App\Http\Requests\Admin\StoreKategoriProdukRequest;
use App\Http\Requests\Admin\UpdateKategoriProdukRequest;

class KategoriProdukController extends Controller
{
    public function index()
    {
        $kategoris = KategoriProduk::orderBy('urutan')->orderBy('nama')->paginate(15);
        return view('admin.kategori-produk.index', compact('kategoris'));
    }

    public function create()
    {
        return view('admin.kategori-produk.form');
    }

    public function store(StoreKategoriProdukRequest $request)
    {
        KategoriProduk::create($request->validated());

        return redirect()->route('admin.kategori-produk.index')
            ->with('success', 'Kategori produk berhasil ditambahkan.');
    }

    public function edit(KategoriProduk $kategoriProduk)
    {
        return view('admin.kategori-produk.form', compact('kategoriProduk'));
    }

    public function update(UpdateKategoriProdukRequest $request, KategoriProduk $kategoriProduk)
    {
        $kategoriProduk->update($request->validated());

        return redirect()->route('admin.kategori-produk.index')
            ->with('success', 'Kategori produk berhasil diperbarui.');
    }

    public function destroy(KategoriProduk $kategoriProduk)
    {
        if ($kategoriProduk->produks()->exists()) {
            return back()->with('error', 'Kategori tidak bisa dihapus karena masih memiliki produk.');
        }

        $kategoriProduk->delete();

        return redirect()->route('admin.kategori-produk.index')
            ->with('success', 'Kategori produk berhasil dihapus.');
    }
}
