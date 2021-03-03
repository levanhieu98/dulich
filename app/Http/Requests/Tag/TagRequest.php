<?php

namespace App\Http\Requests\Tag;

use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
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
            'name' => "required|min:3|max:30",
            'slug' => "required|max:30",
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Trường này không được để trống',
            'name.min' => 'Trường này tối thiểu 3 ký tự',
            'name.max' => 'Trường này tối thiểu 30 ký tự',
            'slug.required' => 'Trường này không được để trống',
            'slug.max' => 'Trường này tối thiểu 30 ký tự',
        ];
    }
}