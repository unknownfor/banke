<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class TaskRequest extends Request
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
            'cycle' => 'required',
            'award_coin' => 'required',
            'award_type' => 'required',
            'status' => 'required',
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
            'title'          => trans('labels.activity.title'),
            'course'          => trans('labels.activity.course'),
            'city'          => trans('labels.activity.city'),
            'url_type'          => trans('activity.activity.type'),
            'cover'          => trans('labels.activity.cover'),
            'status'        => trans('labels.activity.status'),
        ];
    }
}
