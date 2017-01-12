<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class OrderRequest extends Request
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
            'uid' => 'required',
            'org_id' => 'required',
            'course_id' => 'required',
            'tuition_amount' => 'required|numeric',
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
            'uid'          => trans('labels.signup.uid'),
            'org_id'          => trans('labels.signup.org_id'),
            'course_id'   => trans('labels.signup.course_id'),
            'tuition_amount' => trans('labels.signup.tuition_amount'),
            'status'        => trans('labels.signup.status'),
        ];
    }
}
