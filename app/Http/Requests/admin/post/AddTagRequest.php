<?php

namespace App\Http\Requests\admin\post;

use Illuminate\Foundation\Http\FormRequest;

class AddTagRequest extends FormRequest
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
            "Tag_Title" => "required"
        ];
    }

    public function messages()
    {
        return 
        [
            "Tag_Title.required"=>"Tiêu đề tag không được bỏ trống"
        ];
    }
}
