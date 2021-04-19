<?php

namespace App\Http\Requests\candidate\user;

use Illuminate\Foundation\Http\FormRequest;

class UploadCvRequest extends FormRequest
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
            "cv" => "required|file|mimetypes:application/pdf",
            "Cv_Title" => "required"
        ];
    }

    public function messages()
    {
        return
            [
                "Cv_Title.required" => "Tiêu đề cv không được bỏ trống",
                "cv.mimetypes" => "Chỉ chấp nhận cv là định dạng pdf"
            ];
    }
}
