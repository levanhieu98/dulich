<?php

namespace App\Http\Requests\Blogs;

use Illuminate\Foundation\Http\FormRequest;

class AddBlogRequest extends FormRequest
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
            'description' => 'required',
            'content' => 'required',
            'category_id' => 'required',
            'language_id' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Tiêu đề không được bỏ trống',
            'description.required' => 'Mô tả không được bỏ trống',
            'content.required' => 'Nội dung không được để trống',
            'category_id.required' => 'Danh mục không được để trống',
            'language_id.required' => 'Ngôn ngữ không được để trống',
            'image.mimes' => 'Hình ảnh phải thuộc loại jpeg,jpg,png,gif ',
        ];
    }
}
