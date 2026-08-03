<?php
namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;
class UpdateGaleriRequest extends FormRequest {
    public function authorize(): bool { return true; }
    public function rules(): array {
        return [
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:1000',
            'kategori' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'url' => 'nullable|string|max:255',
            'urutan' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ];
    }
}
