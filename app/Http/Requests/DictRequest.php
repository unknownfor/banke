<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class DictRequest extends Request
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
            'key' => 'required',
            'value' => 'required',
            'description' => 'required',
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
            'key'          => trans('labels.dict.key'),
            'value'          => trans('labels.dict.value'),
            'description'   => trans('labels.dict.description'),
            'status'        => trans('labels.dict.status'),
        ];
    }
}
