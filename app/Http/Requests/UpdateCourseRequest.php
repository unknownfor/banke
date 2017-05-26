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
            'group_buying_award'=>'required|numeric',
            'share_group_buying_award'=>'required|numeric',
            'share_comment_course_award'=>'required|numeric',
            'share_group_buying_counts'=>'required|numeric',
            'share_comment_course_counts'=>'required|numeric',
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
            'group_buying_award' => trans('labels.course.group_buying_award'),
            'share_group_buying_award' => trans('labels.course.share_group_buying_award'),
            'share_comment_course_award' => trans('labels.course.share_comment_course_award'),
            'share_group_buying_counts' => trans('labels.course.share_group_buying_counts'),
            'share_comment_course_counts' => trans('labels.course.share_comment_course_counts'),
        ];
    }
}
