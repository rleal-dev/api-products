<?php

namespace App\Api\User\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'name' => ['nullable', 'min:5', 'max:150'],
            'email' => ['nullable', 'email', 'max:150', 'unique:users,email,' . $this->segment(4)],
            'password' => ['nullable', 'min:8', 'confirmed'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }

    /**
     * Filter the validation data.
     *
     * @return array
     */
    public function filtered(): array
    {
        return $this->filled('password')
            ? $this->all()
            : $this->except(['password', 'password_confirmation']);
    }
}
