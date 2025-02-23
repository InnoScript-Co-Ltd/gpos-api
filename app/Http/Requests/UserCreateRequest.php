<?php

namespace App\Http\Requests;

use App\Enums\GenderTypeEnum;
use App\Helpers\Enum;
use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
        $genderTypeEnum = implode(',', (new Enum(GenderTypeEnum::class))->values());

        return [
            'name' => 'required | string | min:6 | max:24',
            'gender' => "required | string | in:$genderTypeEnum",
            'email' => 'required | email | unique:users,email',
            'password' => 'required | min:6 | max:18 | confirmed',
        ];
    }
}
