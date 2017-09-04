<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class TaskFormRequest extends Request
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
            'name' => 'required',
            'seq_no' => 'required',
            'user_type' => 'required',
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required'  => trans('validation.required'),
            'unique'    => trans('validation.unique'),
            'numeric'   => trans('validation.numeric'),
        ];
    }

    public function attributes()
    {
        return [
            'name'          => trans('labels.taskform.name'),
            'seq_no'          => trans('labels.taskform.seq_no'),
            'user_type'          => trans('labels.taskform.user_type'),
            'status'          => trans('activity.taskform.status'),
        ];
    }
}
