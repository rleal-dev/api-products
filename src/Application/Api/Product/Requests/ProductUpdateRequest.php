<?php

namespace App\Api\Product\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'description'    => ['nullable', 'min:5', 'unique:products,description,' . $this->segment(4)],
            'category_id'    => ['nullable', 'numeric', 'exists:categories,id'],
            'dimensions'     => ['nullable', 'max:100'],
            'code'           => ['nullable', 'max:100'],
            'reference'      => ['nullable', 'max:100'],
            'quantity_stock' => ['nullable', 'numeric'],
            'price'          => ['nullable', 'numeric'],
            'is_active'      => ['nullable', 'boolean'],
        ];
    }
}
