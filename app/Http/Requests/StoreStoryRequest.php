<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;

class StoreStoryRequest extends FormRequest
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
            'image' => ['required', 'image', 'max:5120'],
        ];
    }
}
