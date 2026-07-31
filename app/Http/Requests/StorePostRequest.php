<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;

class StorePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'caption' => ['nullable', 'string', 'max:2200'],
            'image' => ['required', 'image', 'max:5120'],
        ];
    }
}
