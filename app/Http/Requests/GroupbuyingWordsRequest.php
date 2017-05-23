<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class GroupbuyingWordsRequest extends Request
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
            'img_url_app' => 'required',
            'img_url_web' => 'required',
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
            'img_url_app'   => trans('labels.groupbuyingwords.img_url_app'),
            'img_url_web'   => trans('labels.groupbuyingwords.img_url_web'),
            'status'        => trans('labels.news.status'),
        ];
    }
}
