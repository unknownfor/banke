<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class FreeStudyRequest extends Request
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
            'title' => 'required',
            'shot_content' => 'required',
            'content' => 'required',
            'type' => 'required',
            'url' => 'required',
            'img_url' => 'required',
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
            'title'          => trans('labels.freestudy.title'),
            'shot_content'          => trans('labels.freestudy.shot_content'),
            'content'          => trans('labels.freestudy.content'),
            'type'          => trans('freestudy.banner.type'),
            'url'          => trans('labels.freestudy.url'),
            'img_url'        => trans('labels.freestudy.img_url'),
        ];
    }
}
