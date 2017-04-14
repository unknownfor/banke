<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class BannerRequest extends Request
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
            'title' => 'required',
            'type' => 'required',
            'url' => 'required',
            'img_url' => 'required',
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
            'title'          => trans('labels.news.title'),
            'type'          => trans('labels.banner.type'),
            'url'          => trans('labels.banner.url'),
            'img_url'          => trans('labels.banner.img_url'),
            'status'        => trans('labels.news.status'),
        ];
    }
}
