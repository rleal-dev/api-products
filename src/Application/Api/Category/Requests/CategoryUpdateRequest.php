<?php

namespace App\Api\Category\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdateRequest extends FormRequest
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
            'description' => ['nullable', 'min:5', 'unique:categories,description,' . $this->segment(4)],
            'is_active' => ['nullable', 'boolean'],
        ];
    }
}
