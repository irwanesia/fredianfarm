<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TinyMceUploadRequest;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Format;
use Illuminate\Support\Facades\Storage;

class TinyMceUploadController extends Controller
{
    public function __invoke(TinyMceUploadRequest $request)
    {
        $file = $request->file('file');

        $manager = new ImageManager(new Driver());
        $image = $manager->decode($file);

        Storage::disk('public')->makeDirectory('artikel', 0755, true);

        $filename = 'artikel/' . uniqid() . '_' . time() . '.webp';
        $path = storage_path('app/public/' . $filename);

        $image->encodeUsingFormat(Format::WEBP, 80)->save($path);

        $url = asset('storage/' . $filename);

        return response()->json([
            'location' => $url,
        ]);
    }
}
