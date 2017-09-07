<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateOrgUserNewRequest extends Request
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
            'mobile_new' => 'required|unique:users',
            'password' => 'required|min:6|max:32',
            'org_id_new' => 'required'
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
            'mobile' => trans('validation.mobile'),
        ];
    }

    public function attributes()
    {
        return [
            'name' => trans('labels.user.name'),
            'mobile_new' => trans('labels.app_user.mobile'),
            'password' => trans('labels.user.password'),
            'org_id_new' => trans('labels.user.org_id'),
        ];
    }
}
