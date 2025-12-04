<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HewanRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        if ($this->has('jenis')) {
            $this->merge([
                'jenis' => strtolower($this->input('jenis')),
            ]);
        }
    }

    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'nama' => ['required', 'string', 'max:100'],
            'jenis' => ['required', 'in:kucing,anjing'],
            'ras' => ['nullable', 'string', 'max:50'],
            'deskripsi' => ['nullable', 'string', 'max:1000'],
            // Usia disimpan sebagai string (mis. "2 years", "6 months") namun izinkan input angka
            'usia' => ['nullable', 'max:50'],
            'gender' => ['nullable', 'in:jantan,betina'],
            'warna' => ['nullable', 'string', 'max:50'],
            'kepribadian' => ['nullable', 'string', 'max:255'],
            'foto' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'status' => ['required', 'in:tersedia,diadopsi'],
        ];
    }
}
