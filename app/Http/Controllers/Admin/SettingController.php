<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

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
            "settings.LOGO_URL" => "nullable|string|max:500",
            "settings.FOOTER_TEXT" => "nullable|string|max:500",
            "settings.LINK_TIKTOK" => "nullable|url|max:500",
            "settings.LINK_SHOPEE" => "nullable|url|max:500",
        ]);

        foreach ($data["settings"] as $key => $value) {
            Setting::updateOrCreate(
                ["key" => $key],
                ["value" => $value]
            );
        }

        return redirect()->route("admin.setting.index")
            ->with("success", "Pengaturan berhasil disimpan.");
    }
}
