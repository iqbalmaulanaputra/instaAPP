<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\Password;

class UpdatePasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ];
    }

    public function messages(): array
    {
        return [
            'current_password.current_password' => 'Kata sandi saat ini salah.',
            'password.confirmed' => 'Konfirmasi kata sandi baru tidak cocok.',
        ];
    }
}
