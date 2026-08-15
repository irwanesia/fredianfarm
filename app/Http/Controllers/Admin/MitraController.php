<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Mitra;
use App\Http\Requests\Admin\StoreMitraRequest;
use App\Http\Requests\Admin\UpdateMitraRequest;
class MitraController extends Controller
{
    public function index() { $mitras = Mitra::orderBy('urutan')->orderBy('nama')->paginate(15); return view('admin.mitra.index', compact('mitras')); }
    public function create() { return view('admin.mitra.form'); }
    public function store(StoreMitraRequest $request) { Mitra::create($request->validated()); return redirect()->route('admin.mitra.index')->with('success', 'Mitra berhasil ditambahkan.'); }
    public function edit(Mitra $mitra) { return view('admin.mitra.form', compact('mitra')); }
    public function update(UpdateMitraRequest $request, Mitra $mitra) { $mitra->update($request->validated()); return redirect()->route('admin.mitra.index')->with('success', 'Mitra berhasil diperbarui.'); }
    public function destroy(Mitra $mitra) { $mitra->delete(); return redirect()->route('admin.mitra.index')->with('success', 'Mitra berhasil dihapus.'); }
}
