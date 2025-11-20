<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HewanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'nama' => ['required', 'string', 'max:100'],
            'jenis' => ['required', 'string', 'max:50'],
            'ras' => ['nullable', 'string', 'max:50'],
            'usia' => ['nullable', 'integer'],
            'foto' => ['nullable', 'image', 'max:5120'],
            'status' => ['required', 'in:tersedia,diadopsi'],
        ];
    }
}
