<?php

namespace App\Http\Requests\employer\user;

use Illuminate\Foundation\Http\FormRequest;

class DoForgetEmployerRequest extends FormRequest
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
            "User_Password_New" => "required|max:100"
        ];
    }
}
