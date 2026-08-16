<?php
namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;
class StoreBannerRequest extends FormRequest {
    public function authorize(): bool { return true; }
    public function rules(): array {
        return [
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:1000',
            'media_type' => 'nullable|in:image,video',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:8192',
            'video' => 'nullable|file|mimes:mp4|max:25600',
            'link_url' => 'nullable|string|max:500',
            'link_text' => 'nullable|string|max:100',
            'link_url_2' => 'nullable|string|max:500',
            'link_text_2' => 'nullable|string|max:100',
            'urutan' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ];
    }
}
