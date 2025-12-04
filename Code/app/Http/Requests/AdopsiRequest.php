<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdopsiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'user_id' => ['required', 'exists:users,id'],
            'hewan_id' => ['required', 'exists:hewan,id'],
            'tanggal_adopsi' => ['required', 'date'],
            'status' => ['required', 'in:pending,diterima,selesai,ditolak'],
        ];
    }
}
