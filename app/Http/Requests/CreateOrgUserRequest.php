<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateOrgUserRequest extends Request
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
            'mobile' => 'required|mobile|unique:users,mobile',
            'password' => 'required|min:6|max:32',
            'status' => 'required',
            'org_id' => 'required'
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
            'id' => trans('labels.id'),
            'name' => trans('labels.user.name'),
            'mobile' => trans('labels.user.mobile'),
            'password' => trans('labels.user.password'),
            'status' => trans('labels.user.status'),
            'org_id' => trans('labels.user.org_id'),
        ];
    }
}
