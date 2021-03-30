<?php

namespace App\Http\Requests\admin\user;

use Illuminate\Foundation\Http\FormRequest;

class AddAdminRequest extends FormRequest
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
            "Fullname" => "required",
            "User_Email" => "required|email|unique:users",
            "User_Password" => "required",
            "Level" => "required|in:4,5"
        ];
    }

    public function messages()
    {
        return [
            "Fullname.required" => "Họ và tên không được bỏ trống",
            "User_Email.required" => "Email không được bỏ trống",
            "User_Email.email" => "Sai định dạng Email",
            "User_Email.unique" => "Email đã tồn tại hệ thống",
            "User_Password.required" => "Mật khẩu không được bỏ trống",
            "Level.required" => "Quyền không được bỏ trống"
        ];
    }
}
