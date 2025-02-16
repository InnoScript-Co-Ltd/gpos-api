<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class ItemCreateRequest extends FormRequest
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
        $categories = implode(',', Category::pluck('id')->toArray());

        return [
            'name' => 'required | string | unique:items,name',
            'description' => 'nullable | string',
            'sku' => 'nullable | string | unique:items,sku',
            'category_id' => "required | in:$categories",
            'photo' => 'nullable | string',
            'qty' => 'nullable | numeric ',
            'price' => 'nullable | numeric',
            'qrcode' => 'nullable | string',
        ];
    }
}
