<?php
namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;
class UpdateMediaSosialRequest extends FormRequest {
    public function authorize(): bool { return true; }
    public function rules(): array {
        return [
            'platform' => 'required|string|max:255',
            'url' => 'required|string|max:500',
            'icon' => 'nullable|string|max:255',
            'urutan' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ];
    }
}
