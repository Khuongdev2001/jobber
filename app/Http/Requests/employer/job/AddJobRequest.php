<?php

namespace App\Http\Requests\employer\job;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CheckService;

class AddJobRequest extends FormRequest
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
                "Job_Title" => "required",
                "Specialize_ID" => "required|exists:specializes,Specialize_ID",
                "Job_Type" => "required|in:" . implode(",", __("user.validate_Job_Type")),
                "Job_Level" => "nullable|in:" . implode(",", __("user.validate_Regency")),
                "Number_People" => "nullable|integer",
                "Job_Experience" => "in:" . implode(",", __("user.validate_Experience")),
                "Job_Province" => "required|exists:Provinces,Province_ID",
                "Job_Address" => "required|min:10",
                "Wage_From" => "nullable|integer",
                "Wage_To" => "nullable|gt:Wage_From",
                "Job_Description" => "required|min:10",
                "Job_Required" => "required|min:10",
                "Required_Gender" => "in:0,1,2",
                "Package_Effect_Buy" => ["nullable", new CheckService([
                    "field" => "ID",
                    "betweenTo" => 7,
                    "betweenFrom" => 9
                ])],
                // required_if => trường này sẽ bắt buộc nếu có package effect buy 
                "Package_Post_Buy" => ["nullable", Rule::requiredIf(function () {
                    return $this->Package_Effect_Buy;
                }), new CheckService([
                    "field" => "ID",
                    "betweenTo" => 1,
                    "betweenFrom" => 6
                ])],
                "Job_Limit" => "nullable|date",
                "Job_Interest"=>"nullable"
            ];
    }

    public function messages()
    {
        return
            [
                "Job_Title.required" => "Tiêu đề tin không được bỏ trống",
                "Specialize_ID.required" => "Nghành công không được bỏ trống",
                "Job_Type.required" => "Không được bỏ trống",
                "Number_People.interger" => "Số lượng tuyển không hợp lệ",
                "Job_Province.required" => "Tỉnh thành không được bỏ trống",
                "Job_Address.required" => "Địa chỉ công việc không được bỏ trống",
                "Wage_From.interger" => "Mức lương từ không hợp lệ",
                "Wage_To.gt" => "Mức lương đến không được nhỏ hơn mức lương từ",
                "Job_Description.required" => "Mô tả công việc không được bỏ trống",
                "Job_Required.required" => "Yêu cầu công việc không đươc bỏ trống",
                "Job_Required.min" => "Yêu cầu câu việc ít nhất 10 từ"
            ];
    }
}
