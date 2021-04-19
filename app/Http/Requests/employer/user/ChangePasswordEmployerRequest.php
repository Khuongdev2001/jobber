<?php

namespace App\Http\Requests\employer\user;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordEmployerRequest extends FormRequest
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
                "User_Password_Old" => "required|max:100",
                "User_Password_New" => "required|max:100",
                "User_Password_Confirm" => "same:User_Password_New"
            ];
    }

    public function messages()
    {

        return
            [
                "User_Password_Old.required" => "Mật khẩu cũ không được bỏ trống",
                "User_Password_New.required" => "Mật khẩu mới không được bỏ trống",
                "User_Password_Confirm.same" => "Mật khẩu xác nhận không khớp"
            ];
    }
}
