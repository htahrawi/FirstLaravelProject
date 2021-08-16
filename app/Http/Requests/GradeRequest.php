<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GradeRequest extends FormRequest
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
            'name' => 'required|max:100',
            'address' => 'required|min:5',
            'mark' => 'required|numeric'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => __('messages.student name is required'),
            'name.max' => __('messages.max length is 100'),
            'address.required' => __('messages.address is required'),
            'address.min' => __('messages.address can\'t be less than 10'),
            'mark.required' => __('messages.mark is important'),
            'mark.numeric' => __('messages.mark just numeric')
        ];
    }
}
