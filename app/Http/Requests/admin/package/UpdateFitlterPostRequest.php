<?php

namespace App\Http\Requests\admin\package;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFitlterPostRequest extends FormRequest
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
                "Package_Value" => "required",
                "Package_Price" => "required"
            ];
    }
}
