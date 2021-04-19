<?php

namespace App\Http\Requests\admin\post;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCatPostRequest extends FormRequest
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
                "Cat_Title" => "required|max:150"
            ];
    }

    public function messages()
    {
        return
            [
                "Cat_Title.required" => "Tiêu đề không được bỏ trống",
                "Cat_Title.max" => "Tiêu đề nhỏ hơn 150"
            ];
    }
}
