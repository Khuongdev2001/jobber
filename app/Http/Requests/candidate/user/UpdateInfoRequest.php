<?php

namespace App\Http\Requests\candidate\user;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInfoRequest extends FormRequest
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
                "Regency" => "int:{$validate_Regency}",
                "Specialize_ID" => "nullable|exists:specializes,Specialize_ID",
                "Province_ID" => "nullable|exists:provinces,Province_ID",
                "Wage_From" => "nullable|integer",
                "Wage_To" => "nullable|integer|gt:Wage_From",
                "Birthday" => "nullable|date",
                "Address" => "nullable",
                "Experience" => "nullable|in:" . implode(",", __("user.validate_Experience")),
                "Marriage" => "nullable|in:" . implode(",", __("user.validate_Marriage")),
                "Description"=>"nullable",
                "continue"=>"required"
            ];
    }
    public function messages()
    {
        return

            [
                "Fullname.required" => "Họ và tên không được bỏ trống",
                "Phone" => "Số điện thoại phải là số",
                "Wage_From.interger" => "Mức lương từ không hợp lệ",
                "Wage_To.interger" => "Mức lương đến không hợp lệ",
                "Wage_To.gt" => "Mức lương đến không được nhỏ hơn mức lương từ",
                "Birthday.date" => "Phải là định dạng thời gian"
            ];
    }
}
