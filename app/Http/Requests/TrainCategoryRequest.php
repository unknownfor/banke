<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class TrainCategoryRequest extends Request
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
            'pid' => 'required',
            'hot' => 'required|numeric',
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
            'name'          => trans('labels.traincategory.name'),
            'pid'          => trans('labels.traincategory.pid'),
            'hot'          => trans('labels.traincategory.hot'),
            'status'        => trans('labels.traincategory.status'),
        ];
    }
}
