<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name'=>'required',
            'slug'=>'required',
            'language_id'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Trường này không được để trống',
            'slug.required' => 'Trường này không được để trống',
            'language_id.required' => 'Trường này không được để trống',
        ];
    }
}