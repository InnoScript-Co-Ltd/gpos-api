<?php

namespace App\Http\Requests;

use App\Enums\GeneralStatusEnum;
use App\Helpers\Enum;
use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdateRequest extends FormRequest
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
        $category = Category::findOrFail(request('id'));
        $categoryId = $category->id;

        $generalStatus = implode(',', (new Enum(GeneralStatusEnum::class))->values());

        return [
            'name' => "nullable | string | unique:categories,name,$categoryId",
            'description' => 'nullable | string',
            'status' => "nullable | string | in:$generalStatus",
        ];
    }
}
