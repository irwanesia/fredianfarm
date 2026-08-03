<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Galeri;
use App\Http\Requests\Admin\StoreGaleriRequest;
use App\Http\Requests\Admin\UpdateGaleriRequest;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Format;
use Illuminate\Support\Facades\Storage;
class GaleriController extends Controller
{
    public function index() { $galeris = Galeri::orderBy('urutan')->orderBy('created_at', 'desc')->paginate(15); return view('admin.galeri.index', compact('galeris')); }
    public function create() { return view('admin.galeri.form'); }
    public function store(StoreGaleriRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $data['url'] = $this->simpanGambar($request->file('image'));
        }
        Galeri::create($data);
        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil ditambahkan.');
    }
    public function edit(Galeri $galeri) { return view('admin.galeri.form', compact('galeri')); }
    public function update(UpdateGaleriRequest $request, Galeri $galeri)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($this->pathFromUrl($galeri->url));
            $data['url'] = $this->simpanGambar($request->file('image'));
        }
        $galeri->update($data);
        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil diperbarui.');
    }
    public function destroy(Galeri $galeri)
    {
        Storage::disk('public')->delete($this->pathFromUrl($galeri->url));
        $galeri->delete();
        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil dihapus.');
    }

    protected function simpanGambar($file): string
    {
        $manager = new ImageManager(new Driver());
        $image = $manager->decode($file);

        Storage::disk('public')->makeDirectory('galeri', 0755, true);

        $filename = 'galeri/' . uniqid() . '_' . time() . '.webp';
        $image->encodeUsingFormat(Format::WEBP, 80)->save(Storage::disk('public')->path($filename));

        return Storage::disk('public')->url($filename);
    }

    protected function pathFromUrl(?string $url): string
    {
        $base = '/storage/';
        if ($url && str_contains($url, $base)) {
            return substr($url, strpos($url, $base) + strlen($base));
        }
        return $url ?? '';
    }
}
