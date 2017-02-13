<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateCourseRequest extends Request
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
            'org_id' => 'required|numeric',
            'price' => 'required|numeric',
//            'percent' => 'required|numeric',
            'period' => 'required|numeric|min:1',
            'sort' => 'numeric',
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
            'name' => trans('labels.course.name'),
            'org_id' => trans('labels.course.org_id'),
            'price' => trans('labels.course.price'),
//            'percent' => trans('labels.course.percent'),
            'period' => trans('labels.course.period'),
            'sort' => trans('labels.course.sort')
        ];
    }
}
