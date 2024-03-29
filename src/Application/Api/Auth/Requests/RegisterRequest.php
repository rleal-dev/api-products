<?php

namespace App\Api\Auth\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'min:5', 'max:150'],
            'email' => ['required', 'email', 'max:150', 'unique:users'],
            'password' => ['required', 'min:8', 'confirmed'],
        ];
    }
}
