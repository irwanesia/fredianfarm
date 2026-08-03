<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriArtikel;
use App\Http\Requests\Admin\StoreKategoriArtikelRequest;
use App\Http\Requests\Admin\UpdateKategoriArtikelRequest;

class KategoriArtikelController extends Controller
{
    public function index()
    {
        $kategoris = KategoriArtikel::orderBy('urutan')->orderBy('nama')->paginate(15);
        return view('admin.kategori-artikel.index', compact('kategoris'));
    }

    public function create()
    {
        return view('admin.kategori-artikel.form');
    }

    public function store(StoreKategoriArtikelRequest $request)
    {
        KategoriArtikel::create($request->validated());

        return redirect()->route('admin.kategori-artikel.index')
            ->with('success', 'Kategori artikel berhasil ditambahkan.');
    }

    public function edit(KategoriArtikel $kategoriArtikel)
    {
        return view('admin.kategori-artikel.form', compact('kategoriArtikel'));
    }

    public function update(UpdateKategoriArtikelRequest $request, KategoriArtikel $kategoriArtikel)
    {
        $kategoriArtikel->update($request->validated());

        return redirect()->route('admin.kategori-artikel.index')
            ->with('success', 'Kategori artikel berhasil diperbarui.');
    }

    public function destroy(KategoriArtikel $kategoriArtikel)
    {
        if ($kategoriArtikel->artikels()->exists()) {
            return back()->with('error', 'Kategori tidak bisa dihapus karena masih memiliki artikel.');
        }

        $kategoriArtikel->delete();

        return redirect()->route('admin.kategori-artikel.index')
            ->with('success', 'Kategori artikel berhasil dihapus.');
    }
}
