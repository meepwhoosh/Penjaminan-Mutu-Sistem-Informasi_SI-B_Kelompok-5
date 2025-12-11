<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            
            // --- TAMBAHKAN INI ---
            'nomor_hp' => ['nullable', 'string', 'max:15'], // Sesuaikan max dengan database
            'alamat' => ['nullable', 'string', 'max:500'],
            'tanggal_lahir' => ['nullable', 'date'],
            // ---------------------
        ];
    }
}