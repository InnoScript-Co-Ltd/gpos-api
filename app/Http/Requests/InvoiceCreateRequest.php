<?php

namespace App\Http\Requests;

use App\Models\Item;
use Illuminate\Foundation\Http\FormRequest;

class InvoiceCreateRequest extends FormRequest
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
        $itemIds = implode(',', Item::pluck('id')->toArray());

        return [
            'items' => 'required | array',
            'items.*.id' => "required | in:$itemIds",
            'items.*.name' => 'required | string',
            'items.*.price' => 'required | numeric',
            'items.*.qty' => 'required | numeric',
        ];
    }
}
