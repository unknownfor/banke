<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateDrawbackRequest extends Request
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
            'order_id' => 'required',
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
            'order_id' => trans('labels.drawback.order_id'),
            'student_mobile' => trans('labels.drawback.student_mobile'),
            'account' => trans('labels.drawback.account'),
            'status' => trans('labels.drawback.status')
        ];
    }
}
