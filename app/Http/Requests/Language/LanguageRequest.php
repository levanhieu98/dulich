<?php

namespace App\Http\Requests\Language;

use Illuminate\Foundation\Http\FormRequest;

class LanguageRequest extends FormRequest
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
            'name' => "required|min:2|max:16|unique:languages",
            'iso' => "required|min:2|max:16|unique:languages",
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Trường này không được để trống',
            'name.min' => 'Trường này tối thiểu 2 ký tự',
            'name.max' => 'Trường này tối thiểu 16 ký tự',
            'name.unique' => 'Ngôn ngữ này đã tồn tại',
            'iso.required' => 'Trường này không được để trống',
            'iso.min' => 'Trường này tối thiểu 2 ký tự',
            'iso.max' => 'Trường này tối thiểu 16 ký tự',
            'iso.unique' => 'Ngôn ngữ này đã tồn tại',
        ];
    }
}