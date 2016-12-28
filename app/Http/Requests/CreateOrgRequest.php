<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateOrgRequest extends Request
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
            'name' => 'required',
            'telphone' => 'required',
            'address' => 'required',
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
            'id' => trans('labels.id'),
            'name' => trans('labels.org.name'),
            'telphone' => trans('labels.org.telphone'),
            'address' => trans('labels.org.address')
        ];
    }
}
