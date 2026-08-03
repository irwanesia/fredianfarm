<?php
namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;
class UpdateTestimoniRequest extends FormRequest {
    public function authorize(): bool { return true; }
    public function rules(): array {
        return [
            'nama' => 'required|string|max:255',
            'daerah' => 'nullable|string|max:255',
            'review' => 'nullable|string|max:2000',
            'rating' => 'nullable|integer|min:1|max:5',
            'foto' => 'nullable|string|max:255',
            'video_url' => 'nullable|string|max:500',
            'is_active' => 'boolean',
        ];
    }
}
