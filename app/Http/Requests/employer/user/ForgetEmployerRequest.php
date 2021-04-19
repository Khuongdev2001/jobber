<?php

namespace App\Http\Requests\employer\user;

use Illuminate\Foundation\Http\FormRequest;

class ForgetEmployerRequest extends FormRequest
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
                "User_Email" => "required|email"
            ];
    }

    public function messages()
    {
        return
            [
                "User_Email.required" => "Email không được bỏ trống",
                "User_Email.email" => "Không phải định dạng email"
            ];
    }
}
