<?php

namespace App\Http\Requests\employer\company;

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
        $companySize = implode(",", __("user.validate_Company_Size"));
        return
            [
                "Company_Name" => "required|max:100",
                "Company_Phone" => "nullable|regex:/^[0-9]{0,15}$/",
                "Company_Address" => "required|max:200",
                "Company_Size" => "in:{$companySize}",
                "Specialize_ID" => "required|exists:specializes,Specialize_ID",
                "Province_ID" => "nullable|exists:provinces,Province_ID",
                "Company_Contactor" => "max:100",
                "Company_Email" => "nullable|email",
                "Company_Website" => "max:100",
                "Company_Description" => "nullable",
            ];
    }

    public function messages()
    {
        return
            [
                "Company_Name.required" => "Tên công ty không được bỏ trống",
                "Company_Phone.regex" => "Sai định dạng số điện thoại",
                "Company_Address.required" => "Địa chỉ công ty không được bỏ trống",
                "Specialize_ID.required" => "Nghành kinh doanh không được bỏ trống",
                "Company_Email.email" => "Sai định dạng email",
            ];
    }
}
