<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateArtikelRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'kategori_id' => 'required|exists:kategori_artikel,id',
            'judul' => 'required|string|max:255',
            'konten' => 'nullable|string',
            'excerpt' => 'nullable|string|max:500',
            'gambar' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
        ];
    }
}
