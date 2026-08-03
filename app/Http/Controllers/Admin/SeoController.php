<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SeoController extends Controller
{
    public function index()
    {
        $settings = Setting::whereIn('key', ['META_TITLE', 'META_DESCRIPTION', 'ROBOTS_TXT', 'OG_IMAGE'])->get()->keyBy('key');
        return view('admin.seo.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'settings.META_TITLE' => 'nullable|string|max:200',
            'settings.META_DESCRIPTION' => 'nullable|string|max:1000',
            'settings.ROBOTS_TXT' => 'nullable|string|max:5000',
            'og_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        foreach (['META_TITLE', 'META_DESCRIPTION', 'ROBOTS_TXT'] as $key) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $data['settings'][$key] ?? '']
            );
        }

        if ($request->hasFile('og_image')) {
            $filename = 'og-' . uniqid() . '.' . $request->file('og_image')->getClientOriginalExtension();
            $request->file('og_image')->storeAs('seo', $filename, 'public');
            Setting::updateOrCreate(
                ['key' => 'OG_IMAGE'],
                ['value' => Storage::disk('public')->url('seo/' . $filename)]
            );
        }

        return redirect()->route('admin.seo.index')->with('success', 'Pengaturan SEO tersimpan.');
    }
}
