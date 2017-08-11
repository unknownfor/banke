<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use  Illuminate\Contracts\Validation\Validator;

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
            'checkin_award' => 'numeric',
            'task_award' => 'required|numeric',
            'group_buying_award'=>'required|numeric',
            'share_group_buying_award'=>'required|numeric',
            'share_comment_course_award'=>'required|numeric',
            'share_group_buying_counts'=>'required|numeric',
            'share_comment_course_counts'=>'required|numeric',
            'sort' => 'numeric',
            'deposit' => 'required|numeric',
            'cover' => 'required',
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
            'group_buying_award' => trans('labels.course.group_buying_award'),
            'share_group_buying_award' => trans('labels.course.share_group_buying_award'),
            'share_comment_course_award' => trans('labels.course.share_comment_course_award'),
            'share_group_buying_counts' => trans('labels.course.share_group_buying_counts'),
            'share_comment_course_counts' => trans('labels.course.share_comment_course_counts'),
            'sort' => trans('labels.course.sort'),
            'checkin_award' => trans('labels.course.checkin_award'),
            'task_award' => trans('labels.course.task_award'),
            'z_award_amount' => trans('labels.course.z_award_amount'),
             'enddated_at' => trans('labels.course.enddated_at'),
             'deposit' => trans('labels.course.deposit'),
             'cover' => trans('labels.course.cover'),
        ];
    }
}
