<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateKategoriArtikelRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama' => ['required', 'string', 'max:255', Rule::unique('kategori_artikel', 'nama')->ignore($this->kategori_artikel)],
            'deskripsi' => 'nullable|string|max:1000',
            'urutan' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ];
    }
}
