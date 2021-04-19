<?php

namespace App\Http\Requests\admin\post;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
                "Post_Title" => "required|max:155",
                "Cat_ID" => "required|exists:cat_posts,Cat_ID",
                "Tag_ID" => "nullable|exists:tags,Tag_ID",
                "Post_Description" => "required",
                "Post_Content" => "required",
                "Is_Highlight" => "in:1",
                "Is_New" => "in:1"
            ];
    }

    public function messages()
    {
        return
            [
                "Post_Title.required" => "Tiêu đề bài viết không được bỏ trống",
                "Cat_ID.required" => "Danh mục không được bỏ trống",
                "Post_Description.required" => "Mô tả không được bỏ trống",
                "Post_Content.required" => "Nội dung bài viết không được bỏ trống",
            ];
    }
}
