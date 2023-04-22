<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTodoRequest extends FormRequest
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
            'title' => 'nullable|string',
            'description' => 'nullable|string',
            'priority' => 'nullable|in:low,medium,high',
            'deadline' => ['date_format:Y-m-d H:i:s', 'after:now'],
            'category_id' => [
                'nullable',
                Rule::exists('todo_categories', 'id')->where(function ($query) {
                    $query->where('user_id', auth()->id());
                })
            ],
        ];
    }
}
