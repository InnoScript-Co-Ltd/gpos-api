<?php

namespace App\Http\Requests;

use App\Enums\GenderTypeEnum;
use App\Enums\UserStatusEnum;
use App\Helpers\Enum;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
        $user = User::findOrFail(request('id'));
        $userId = $user->id;

        $userStatusEnum = implode(',', (new Enum(UserStatusEnum::class))->values());
        $genderTypeEnum = implode(',', (new Enum(GenderTypeEnum::class))->values());

        return [
            'name' => 'nullable | string',
            'profile' => 'nullable | file',
            'email' => "nullable | email | unique:users,email,$userId",
            'gender' => "nullable | string | in:$genderTypeEnum",
            'dob' => 'nullable | date',
            'phone' => "nullable | string | unique:users,phone,$userId",
            'password' => 'nullable | string | min:6 | max:18',
            'status' => "nullable | string | in:$userStatusEnum",
        ];
    }
}
