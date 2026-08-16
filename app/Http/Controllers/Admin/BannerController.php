<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Http\Requests\Admin\StoreBannerRequest;
use App\Http\Requests\Admin\UpdateBannerRequest;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Format;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::orderBy('urutan')->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.banner.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banner.form');
    }

    public function store(StoreBannerRequest $request)
    {
        if ($request->hasFile('foto') && $request->hasFile('video')) {
            return back()->withErrors(['media' => 'Pilih salah satu: upload gambar atau video, tidak boleh keduanya.'])->withInput();
        }

        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('foto')) {
            $data['url'] = $this->simpanGambar($request->file('foto'));
            $data['media_type'] = 'image';
        } elseif ($request->hasFile('video')) {
            $data['url'] = $this->simpanVideo($request->file('video'));
            $data['media_type'] = 'video';
        } else {
            $data['url'] = null;
            $data['media_type'] = null;
        }

        Banner::create($data);

        return redirect()->route('admin.banner.index')
            ->with('success', 'Banner berhasil ditambahkan.');
    }

    public function edit(Banner $banner)
    {
        return view('admin.banner.form', compact('banner'));
    }

    public function update(UpdateBannerRequest $request, Banner $banner)
    {
        if ($request->hasFile('foto') && $request->hasFile('video')) {
            return back()->withErrors(['media' => 'Pilih salah satu: upload gambar atau video, tidak boleh keduanya.'])->withInput();
        }

        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active');

        $hapusMedia = $request->boolean('hapus_media');

        if ($request->hasFile('foto') || $request->hasFile('video') || $hapusMedia) {
            $this->hapusFile($banner->url);
        }

        if ($request->hasFile('foto')) {
            $data['url'] = $this->simpanGambar($request->file('foto'));
            $data['media_type'] = 'image';
        } elseif ($request->hasFile('video')) {
            $data['url'] = $this->simpanVideo($request->file('video'));
            $data['media_type'] = 'video';
        } elseif ($hapusMedia) {
            $data['url'] = null;
            $data['media_type'] = null;
        }

        $banner->update($data);

        return redirect()->route('admin.banner.index')
            ->with('success', 'Banner berhasil diperbarui.');
    }

    public function destroy(Banner $banner)
    {
        $this->hapusFile($banner->url);
        $banner->delete();

        return redirect()->route('admin.banner.index')
            ->with('success', 'Banner berhasil dihapus.');
    }

    private function simpanGambar($file): string
    {
        $manager = new ImageManager(new Driver());
        Storage::disk('public')->makeDirectory('banner', 0755, true);

        $image = $manager->decode($file);
        $image->scaleDown(width: 1920);

        $filename = 'banner/foto_' . uniqid() . '_' . time() . '.webp';
        $image->encodeUsingFormat(Format::WEBP, 80)->save(Storage::disk('public')->path($filename));

        return Storage::disk('public')->url($filename);
    }

    private function simpanVideo($file): string
    {
        Storage::disk('public')->makeDirectory('banner', 0755, true);

        $filename = 'banner/video_' . uniqid() . '_' . time() . '.mp4';
        $file->storeAs('banner', basename($filename), 'public');

        return Storage::disk('public')->url($filename);
    }

    private function hapusFile(?string $url): void
    {
        if (!$url) {
            return;
        }
        $base = '/storage/';
        if (str_contains($url, $base)) {
            $path = substr($url, strpos($url, $base) + strlen($base));
            Storage::disk('public')->delete($path);
        }
    }
}
