<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateCourseRequest extends Request
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
            'org_id' => 'required|numeric',
            'price' => 'required|numeric',
            'period' => 'required|numeric|min:1',
            'status' => 'required',
//            'checkin_award' => 'numeric',
//            'task_award' => 'numeric',
        ];
    }

    public function messages()
    {
        return [
            'numeric' => trans('validation.numeric'),
            'required' => trans('validation.required'),
            'org_id' => trans('validation.unique'),
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
//            'period' => trans('labels.course.period'),
            'status' => trans('labels.course.status'),
        ];
    }
}
