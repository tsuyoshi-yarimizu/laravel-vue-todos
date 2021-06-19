<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TodoUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'task_name' => 'max:128',
            'task_detail' => 'max:1024',
            'expire' => 'date_format:Y-m-d',
        ];
    }
}
