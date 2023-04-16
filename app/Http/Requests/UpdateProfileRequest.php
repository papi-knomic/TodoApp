<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return (bool)auth()->user();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'string',
            'last_name' => 'string',
            'username' => [
                'string',
                Rule::unique('users', 'username')->ignore(auth()->id()),
            ],
            'email' => [
                'email',
                Rule::unique('users', 'email')->ignore(auth()->id()),
            ],
        ];
    }
}
