<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
            'survey_number'     => 'required|unique:projects|max:10',
            'programmer'        => 'required',
            'project_manager'   => 'required',
            'detail'            => 'required',
            'feldstart'         => 'required',
            'status'            => 'required',
        ];
    }
}
