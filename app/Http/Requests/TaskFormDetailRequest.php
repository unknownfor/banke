<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class TaskFormDetailRequest extends Request
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
            'seq_no' => 'required',
            'user_type' => 'required',
            'status' => 'required',
            'selected_task' => 'required',
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
            'seq_no'          => trans('labels.taskformdetail.seq_no'),
            'user_type'          => trans('labels.taskformdetail.user_type'),
            'status'          => trans('activity.taskformdetail.status'),
            'selected_task'          => trans('activity.taskformdetail.selected_task'),
        ];
    }
}
