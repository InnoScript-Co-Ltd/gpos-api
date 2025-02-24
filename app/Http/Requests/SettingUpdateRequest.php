<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'shop_name' => 'nullable | string',
            'logo' => 'nullable | file',
            'phone' => 'nullable | string',
            'email' => 'nullable | string',
            'address' => 'nullable | string',
            'tax' => 'nullable | numeric',
        ];
    }
}
