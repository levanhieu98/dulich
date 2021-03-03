<?php

namespace App\Http\Requests\Roles;

use Illuminate\Foundation\Http\FormRequest;

class AddRoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
        // return auth()->user()->can('user-update');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|unique:roles',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Trường này không được để trống',
            'name.min' => 'Vai trò tối thiểu 3 ký tự',
            'name.require' => 'Vai trò này đã tồn tại',
        ];
    }
}
