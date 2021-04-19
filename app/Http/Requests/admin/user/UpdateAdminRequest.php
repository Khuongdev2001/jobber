<?php

namespace App\Http\Requests\admin\user;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminRequest extends FormRequest
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
        return
            [
                "User_Email" => "required|email",
                "Fullname" => "required",
                "User_Password" => "required",
                "Level" => "required|in:4,5,6"
            ];
    }

    public function messages()
    {
        return
            [
                "Fullname.required" => "Họ và tên không được bỏ trống",
                "User_Email.required" => "Email không được bỏ trống",
                "User_Email.email" => "Sai định dạng Email",
                "User_Password.required" => "Mật khẩu không được bỏ trống",
                "Level.required" => "Quyền không được bỏ trống"
            ];
    }
}
