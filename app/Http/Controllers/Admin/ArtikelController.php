<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use App\Models\KategoriArtikel;
use App\Http\Requests\Admin\StoreArtikelRequest;
use App\Http\Requests\Admin\UpdateArtikelRequest;
use Mews\Purifier\Facades\Purifier;

class ArtikelController extends Controller
{
    public function index()
    {
        $artikels = Artikel::with('kategori', 'user')->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.artikel.index', compact('artikels'));
    }

    public function create()
    {
        $kategoris = KategoriArtikel::where('is_active', true)->orderBy('nama')->get();
        return view('admin.artikel.form', compact('kategoris'));
    }

    public function store(StoreArtikelRequest $request)
    {
        $data = $request->validated();
        $data['konten'] = Purifier::clean($data['konten'] ?? '');
        $data['user_id'] = auth()->id();
        $data['is_published'] = $request->boolean('is_published');
        $data['ai_generated'] = $request->boolean('ai_generated');

        if ($data['is_published'] && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        Artikel::create($data);

        return redirect()->route('admin.artikel.index')
            ->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function edit(Artikel $artikel)
    {
        $kategoris = KategoriArtikel::where('is_active', true)->orderBy('nama')->get();
        return view('admin.artikel.form', compact('artikel', 'kategoris'));
    }

    public function update(UpdateArtikelRequest $request, Artikel $artikel)
    {
        $data = $request->validated();
        $data['konten'] = Purifier::clean($data['konten'] ?? '');
        $data['is_published'] = $request->boolean('is_published');
        $data['ai_generated'] = $request->boolean('ai_generated');

        if ($data['is_published'] && empty($artikel->published_at)) {
            $data['published_at'] = now();
        }

        $artikel->update($data);

        return redirect()->route('admin.artikel.index')
            ->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Artikel $artikel)
    {
        $artikel->delete();

        return redirect()->route('admin.artikel.index')
            ->with('success', 'Artikel berhasil dihapus.');
    }
}
