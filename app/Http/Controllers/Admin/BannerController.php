<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Http\Requests\Admin\StoreBannerRequest;
use App\Http\Requests\Admin\UpdateBannerRequest;
class BannerController extends Controller
{
    public function index() { $banners = Banner::orderBy('urutan')->orderBy('created_at', 'desc')->paginate(15); return view('admin.banner.index', compact('banners')); }
    public function create() { return view('admin.banner.form'); }
    public function store(StoreBannerRequest $request) { Banner::create($request->validated()); return redirect()->route('admin.banner.index')->with('success', 'Banner berhasil ditambahkan.'); }
    public function edit(Banner $banner) { return view('admin.banner.form', compact('banner')); }
    public function update(UpdateBannerRequest $request, Banner $banner) { $banner->update($request->validated()); return redirect()->route('admin.banner.index')->with('success', 'Banner berhasil diperbarui.'); }
    public function destroy(Banner $banner) { $banner->delete(); return redirect()->route('admin.banner.index')->with('success', 'Banner berhasil dihapus.'); }
}
