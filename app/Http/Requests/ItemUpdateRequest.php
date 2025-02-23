<?php

namespace App\Http\Requests;

use App\Enums\GeneralStatusEnum;
use App\Helpers\Enum;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Foundation\Http\FormRequest;

class ItemUpdateRequest extends FormRequest
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
        $item = Item::findOrFail(request('id'));
        $itemId = $item->id;
        $generalStatus = implode(',', (new Enum(GeneralStatusEnum::class))->values());

        return [
            'name' => "nullable | string | unique:items,name,$itemId",
            'description' => 'nullable | string',
            'category_id' => "nullable | in:$categories",
            'sku' => "nullable | string | unique:items,sku,$itemId",
            'photo' => 'nullable | file',
            'qty' => 'nullable | numeric ',
            'price' => 'nullable | numeric',
            'qrcode' => 'nullable | string',
            'status' => "nullable | string | in:$generalStatus",
        ];
    }
}
