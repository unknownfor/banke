<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateOrgSummaryRequest extends Request
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
            'short_name'=>'required',
            'category_id'=>'required'
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
            'name' => trans('labels.orgsummary.name'),
            'short_name' => trans('labels.orgsummary.short_name'),
            'category_id' => trans('labels.orgsummary.category_id'),
        ];
    }
}
