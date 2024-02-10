<?php

namespace App\Http\Requests;

use App\Enums\TaskSortEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaskListRequest extends FormRequest
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
            'sort' => [
                'nullable',
                'string',
                Rule::in(array_values(TaskSortEnum::toArray()))
            ],
            'order' => 'nullable|string|in:asc,desc',
            'page' => 'required|numeric',
        ];
    }
}
