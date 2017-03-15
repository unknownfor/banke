<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateOrgRebatesRequest extends Request
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
//            'id' => 'numeric',
            'org_id' => 'required',
            'student_mobile' => 'required',
            'account' => 'required',
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'numeric' => trans('validation.numeric'),
            'required' => trans('validation.required'),
            'unique' => trans('validation.unique'),
            'min' => trans('validation.min.string'),
            'max' => trans('validation.max.string'),
            'email' => trans('validation.email'),
        ];
    }

    public function attributes()
    {
        return [
            'org_id' => trans('labels.id'),
            'student_mobile' => trans('labels.orgrebates.student_mobile'),
            'account' => trans('labels.orgrebates.account'),
            'status' => trans('labels.orgrebates.address')
        ];
    }
}
