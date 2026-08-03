<?php
namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;
class StoreBannerRequest extends FormRequest {
    public function authorize(): bool { return true; }
    public function rules(): array {
        return [
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:1000',
            'url' => 'nullable|string|max:255',
            'link_url' => 'nullable|string|max:500',
            'link_text' => 'nullable|string|max:100',
            'link_url_2' => 'nullable|string|max:500',
            'link_text_2' => 'nullable|string|max:100',
            'urutan' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ];
    }
}
