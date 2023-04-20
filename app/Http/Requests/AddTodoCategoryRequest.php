<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddTodoCategoryRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|string|unique:todo_categories,title,NULL,id,user_id,' . auth()->id(),
        ];
    }

    public function messages()
    {
        return [
          'title.unique' => 'Category title already exists'
        ];
    }
}
