<?php

namespace App\Api\Product\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'description'    => ['required', 'min:5', 'unique:products,description,' . $this->segment(4)],
            'category_id'    => ['required', 'numeric', 'exists:categories,id'],
            'dimensions'     => ['required', 'max:100'],
            'code'           => ['required', 'max:100'],
            'reference'      => ['required', 'max:100'],
            'quantity_stock' => ['required', 'numeric'],
            'price'          => ['required', 'numeric'],
            'is_active'      => ['nullable', 'boolean'],
        ];
    }
}
