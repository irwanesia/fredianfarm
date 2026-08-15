<?php
namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;
class StoreMitraRequest extends FormRequest {
    public function authorize(): bool { return true; }
    public function rules(): array {
        return [
            'nama' => 'required|string|max:255',
            'urutan' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ];
    }
}
