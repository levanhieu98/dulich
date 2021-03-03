<?php

namespace App\Http\Requests\Users;

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
            'role_id'=>'required',
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Trường này không được để trống',
            'role_id.required' => 'Trường này không được để trống',
            'email.required' => 'Trường này không được để trống',
            'password.required' => 'Trường này không được để trống',
            'email.unique' => 'Email này đã tồn tại',
            'email.email' => 'Email không đúng định dạng',
        ];
    }
}
