<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Testimoni;
use App\Http\Requests\Admin\StoreTestimoniRequest;
use App\Http\Requests\Admin\UpdateTestimoniRequest;
class TestimoniController extends Controller
{
    public function index() { $testimonis = Testimoni::orderBy('created_at', 'desc')->paginate(15); return view('admin.testimoni.index', compact('testimonis')); }
    public function create() { return view('admin.testimoni.form'); }
    public function store(StoreTestimoniRequest $request) { Testimoni::create($request->validated()); return redirect()->route('admin.testimoni.index')->with('success', 'Testimoni berhasil ditambahkan.'); }
    public function edit(Testimoni $testimoni) { return view('admin.testimoni.form', compact('testimoni')); }
    public function update(UpdateTestimoniRequest $request, Testimoni $testimoni) { $testimoni->update($request->validated()); return redirect()->route('admin.testimoni.index')->with('success', 'Testimoni berhasil diperbarui.'); }
    public function destroy(Testimoni $testimoni) { $testimoni->delete(); return redirect()->route('admin.testimoni.index')->with('success', 'Testimoni berhasil dihapus.'); }
}
