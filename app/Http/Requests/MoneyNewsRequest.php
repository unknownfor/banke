<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class MoneyNewsRequest extends Request
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
            'business_type' => 'required',
            'amount' => 'required',
            'user_name' => 'required',
            'short_name' => 'required',
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
            'business_type'          => trans('labels.moneynews.business_type'),
            'amount'        => trans('labels.moneynews.amount'),
            'user_name'        => trans('labels.moneynews.user_name'),
            'short_name'        => trans('labels.moneynews.short_name'),
        ];
    }
}
