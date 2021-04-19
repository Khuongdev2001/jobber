<?php

namespace App\Http\Requests\employer\user;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployerRequest extends FormRequest
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
        $validate_Regency =  implode(",", __("user.validate_Regency"));
        return 
        [
            "Fullname" => "required|max:100",
            "Phone" => "nullable|regex:/^[0-9]{0,15}$/",
            "Gender" => "in:0,1",
            "Regency" => "int:{$validate_Regency}"
        ];
    }

    public function messages()
    {
        return
        [
            "Fullname.required"=>"Họ và tên không được bỏ trống",
            "Phone"=>"Số điện thoại phải là số",
        ];
    }
}
