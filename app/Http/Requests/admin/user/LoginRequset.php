<?php

namespace App\Http\Requests\admin\user;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequset extends FormRequest
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
            "User_Email" => "required|email",
            "User_Password" => "required"
        ];
    }

    public function messages()
    {
        return [
            "User_Email.required" => "Email không được bỏ trống",
            "User_Email.email" => "Email không đúng định dạng",
            "User_Password.required" => "Mật khẩu Không được bỏ trống"
        ];
    }
}
