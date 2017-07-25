<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ActivityRequest extends Request
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
            'desc' => 'required',
            'city' => 'required',
            'url_type' => 'required',
            'url' => 'required',
            'cover' => 'required',
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
            'title'          => trans('labels.activity.title'),
            'desc'          => trans('labels.activity.desc'),
            'city'          => trans('labels.activity.city'),
            'url_type'          => trans('activity.banner.type'),
            'url'          => trans('labels.activity.url'),
            'cover'          => trans('labels.activity.cover'),
            'status'        => trans('labels.activity.status'),
        ];
    }
}
