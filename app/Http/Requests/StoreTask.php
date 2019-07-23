<?php

namespace HomeSecretary\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeTask extends FormRequest
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
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'deadlineDate' => 'required|date',
            'deadlineTime' => 'required|date_format:H:i',
        ];
    }
}
