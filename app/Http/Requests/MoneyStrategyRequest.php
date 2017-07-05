<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class MoneyStrategyRequest extends Request
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
            'content' => 'required',
            'cover_img' => 'required',
            'author' => 'required',
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
            'title'          => trans('labels.moneystrategy.title'),
            'content'        => trans('labels.moneystrategy.content'),
            'cover_img'        => trans('labels.moneystrategy.cover_img'),
            'author'        => trans('labels.moneystrategy.author'),
        ];
    }
}
