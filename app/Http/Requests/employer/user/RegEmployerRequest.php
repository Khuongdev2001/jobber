<?php

namespace App\Http\Requests\employer\user;

use Illuminate\Foundation\Http\FormRequest;

class RegEmployerRequest extends FormRequest
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
                "Fullname" => "required|max:50",
                "User_Email" => "required|email|unique:users|max:50",
                "User_Password" => "required|max:50",
                "Re_User_Password" => "required|same:User_Password",
                "Company_Name" => "required|max:50",
                "Specialize_ID" => "required|exists:Specializes,Specialize_ID",
                "Company_Address" => "required|max:200",
                "Gender" => "required|in:0,1,2",
                // "geetest_challenge" => "geetest"
            ];
    }

    public function messages()
    {
        return
            [
                "Fullname.required" => "Họ tên không được để trống",
                "User_Email.required" => "Email không được bỏ trống",
                "User_Email.unique" => "Email đã đăng ký hệ thống",
                "User_Password.required" => "Mật khẩu không được bỏ trống",
                "Re_User_Password.same" => "Mật khẩu xác thực không khớp",
                "Re_User_Password.required" => "Mật khẩu xác thực không được bỏ trống",
                "Company_Name.required" => "Tên công ty không được bỏ trống",
                "Specialize_ID.required" => "Nghành nghề không được bỏ trống",
                "Company_Address.required" => "Địa chỉ công ty không được bỏ trống",
                "Gender.required" => "Giới tính không được bỏ trống",
            ];
    }
}
