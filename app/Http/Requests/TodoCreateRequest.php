<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TodoCreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'todo_name' => 'required|max:128',
            'todo_detail' => 'max:1024',
            'expire' => 'required|date_format:Y-m-d',
        ];
    }
}
