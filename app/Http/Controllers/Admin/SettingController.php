<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all();
        return view("admin.setting.index", compact("settings"));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            "settings.APP_NAME" => "nullable|string|max:255",
            "settings.ALAMAT" => "nullable|string|max:1000",
            "settings.NOMOR_WA" => "nullable|string|max:20",
            "settings.EMAIL" => "nullable|email|max:255",
            "settings.FOOTER_TEXT" => "nullable|string|max:500",
            "settings.FOOTER_TAGLINE" => "nullable|string|max:500",
            "settings.LINK_TIKTOK" => "nullable|url|max:500",
            "settings.LINK_SHOPEE" => "nullable|url|max:500",
            "settings.SEJARAH" => "nullable|string",
            "settings.VISI" => "nullable|string",
            "settings.MISI" => "nullable|string",
            "settings.NIB" => "nullable|string|max:255",
            "settings.SERTIFIKAT" => "nullable|string|max:255",
            "settings.IZIN" => "nullable|string|max:255",
            "settings.ANGGOTA" => "nullable|string|max:255",
            "settings.LOKASI_MAPS_EMBED" => "nullable|url|max:1000",
            "settings.JAM_OPERASIONAL" => "nullable|string|max:255",
            "logo" => "nullable|image|mimes:jpg,jpeg,png,webp|max:2048",
            "reset_logo" => "nullable|in:1",
            "sejarah_image" => "nullable|image|mimes:jpg,jpeg,png,webp|max:2048",
            "reset_sejarah_image" => "nullable|in:1",
        ]);

        foreach ($data["settings"] as $key => $value) {
            Setting::updateOrCreate(
                ["key" => $key],
                ["value" => $value]
            );
        }

        if (!empty($data["reset_logo"])) {
            Setting::updateOrCreate(
                ["key" => "LOGO_URL"],
                ["value" => ""]
            );
        } elseif ($request->hasFile("logo")) {
            $filename = "logo-" . uniqid() . "." . $request->file("logo")->getClientOriginalExtension();
            $request->file("logo")->storeAs("logo", $filename, "public");
            Setting::updateOrCreate(
                ["key" => "LOGO_URL"],
                ["value" => Storage::disk("public")->url("logo/" . $filename)]
            );
        }

        if (!empty($data["reset_sejarah_image"])) {
            Setting::updateOrCreate(
                ["key" => "SEJARAH_IMAGE"],
                ["value" => ""]
            );
        } elseif ($request->hasFile("sejarah_image")) {
            $filename = "tentang-" . uniqid() . "." . $request->file("sejarah_image")->getClientOriginalExtension();
            $request->file("sejarah_image")->storeAs("tentang", $filename, "public");
            Setting::updateOrCreate(
                ["key" => "SEJARAH_IMAGE"],
                ["value" => Storage::disk("public")->url("tentang/" . $filename)]
            );
        }

        return redirect()->route("admin.setting.index")
            ->with("success", "Pengaturan berhasil disimpan.");
    }
}
