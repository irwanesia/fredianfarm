<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\MediaSosial;
use App\Http\Requests\Admin\StoreMediaSosialRequest;
use App\Http\Requests\Admin\UpdateMediaSosialRequest;
class MediaSosialController extends Controller
{
    public function index() { $medias = MediaSosial::orderBy('urutan')->orderBy('platform')->paginate(15); return view('admin.media-sosial.index', compact('medias')); }
    public function create() { return view('admin.media-sosial.form'); }
    public function store(StoreMediaSosialRequest $request) { MediaSosial::create($request->validated()); return redirect()->route('admin.media-sosial.index')->with('success', 'Media sosial berhasil ditambahkan.'); }
    public function edit(MediaSosial $mediaSosial) { return view('admin.media-sosial.form', compact('mediaSosial')); }
    public function update(UpdateMediaSosialRequest $request, MediaSosial $mediaSosial) { $mediaSosial->update($request->validated()); return redirect()->route('admin.media-sosial.index')->with('success', 'Media sosial berhasil diperbarui.'); }
    public function destroy(MediaSosial $mediaSosial) { $mediaSosial->delete(); return redirect()->route('admin.media-sosial.index')->with('success', 'Media sosial berhasil dihapus.'); }
}
