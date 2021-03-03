<?php

namespace App\Http\Requests\Tour;

use Illuminate\Foundation\Http\FormRequest;

class AddRequest extends FormRequest
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
            'title'=>'required' ,
            'content' => 'required',
            'avatar' => 'required',
            'avatar.*'=>'image|mimes:jpeg,jpg,png,gif"max:10240',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Tiêu đề không được bỏ trống',
            'content.required' => 'Nội dung không được để trống',
            'avatar.required'=>'Hình ảnh không được để trống',         
        ];
    }
}
