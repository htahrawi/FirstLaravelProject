<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
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
            'name_ar' => 'required|max:100',
            'name_en' => 'required|max:100',
            'price' => 'required|numeric',
            'detailes_ar' => 'required',
            'detailes_en' => 'required'
        ]; 
    }
    public function messages()
    {
        return[
            'name_ar.required' => __('messages.offer name required'),
            'name_en.required' => __('messages.offer name required'),
            'name_ar.max' => __('messages.offer name must be less than 100 charachter'),
            'name_en.max' => __('messages.offer name must be less than 100 charachter'),
            // 'name_ar.unique' => __('offer name is already exist'),
            // 'name_en.unique' => __('offer name is already exist'),
            'price.required' => __('messages.price is required'),
            'price.numeric' => __('messages.price must be a number'),
            'detailes_ar.required' => __('messages.offer detailes is required'),
            'detailes_en.required' => __('messages.offer detailes is required')
        ];
    }
}
