<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class TeachingTeacherRequest extends Request
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
            'org_id' => 'required',
            'sub_org_id' => 'required',
            'goodat_course' => 'required',
            'tags' => 'required',
            'intro' => 'required',
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
            'name'              => trans('labels.teachingteacher.name'),
            'org_id'            => trans('labels.teachingteacher.org_id'),
            'sub_org_id'        => trans('labels.teachingteacher.sub_org_id'),
            'goodat_course'     => trans('labels.teachingteacher.goodat_course'),
            'tags'              => trans('labels.teachingteacher.tags'),
            'intro'             => trans('labels.teachingteacher.intro'),
        ];
    }
}
