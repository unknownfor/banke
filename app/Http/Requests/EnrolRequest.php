<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class EnrolRequest extends Request
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
            'id' => 'numeric',
            'name' => 'required',
            'org_id' => 'required',
            'course_id' => 'required',
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
            'id'            => trans('labels.id'),
            'name'          => trans('labels.enrol.name'),
            'org_id'          => trans('labels.enrol.org'),
            'course_id'          => trans('labels.enrol.course'),
            'status'        => trans('labels.enrol.status'),
        ];
    }
}
