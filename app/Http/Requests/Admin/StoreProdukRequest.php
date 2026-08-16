<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreProdukRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'kategori_id' => 'required|exists:kategori_produk,id',
            'jenis' => 'nullable|string|max:255',
            'varietas' => 'nullable|string|max:255',
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'jenis_wadah' => 'nullable|string|max:255',
            'umur_simpan' => 'nullable|string|max:255',
            'harga' => 'nullable|numeric|min:0',
            'stok_status' => 'nullable|string|in:tersedia,terbatas,pre_order',
            'berat' => 'nullable|numeric|min:0',
            'link_tiktok' => 'nullable|url|max:500',
            'link_shopee' => 'nullable|url|max:500',
            'is_active' => 'boolean',
            'foto' => 'nullable|array',
            'foto.*' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'variants' => 'nullable|array',
            'variants.*.id' => 'nullable|integer|exists:produk_variants,id',
            'variants.*.nama' => 'required|string|max:255',
            'variants.*.harga' => 'required|numeric|min:0',
            'variants.*.berat' => 'nullable|numeric|min:0',
            'variants.*.stok_status' => 'nullable|string|in:tersedia,terbatas,pre_order',
            'variants.*.urutan' => 'nullable|integer|min:0',
            'variants.*.hapus' => 'nullable|boolean',
        ];
    }
}
