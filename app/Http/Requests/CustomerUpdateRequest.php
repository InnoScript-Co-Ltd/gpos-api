<?php

namespace App\Http\Requests;

use App\Models\Customer;
use Illuminate\Foundation\Http\FormRequest;

class CustomerUpdateRequest extends FormRequest
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

        $customer = Customer::findOrFail(request('id'));
        $customerId = $customer->id;
        return [
            'name' => 'nullable | string',
            'email' => "nullable | email | unique:customers,email,$customerId",
            'phone' => 'nullable | string',
        ];
    }
}
