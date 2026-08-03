<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreKategoriArtikelRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama' => 'required|string|max:255|unique:kategori_artikel,nama',
            'deskripsi' => 'nullable|string|max:1000',
            'urutan' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ];
    }
}
