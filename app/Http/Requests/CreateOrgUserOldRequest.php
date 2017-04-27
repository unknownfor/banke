<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateOrgUserOldRequest extends Request
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
            'mobile_old' => 'required|mobile',
            'org_id_old' => 'required'
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
            'mobile_old' => trans('labels.app_user.mobile'),
            'org_id_old' => trans('labels.user.org_id'),
        ];
    }
}
