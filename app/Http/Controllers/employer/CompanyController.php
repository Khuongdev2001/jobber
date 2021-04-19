<?php

namespace App\Http\Controllers\employer;

use App\Http\Controllers\Controller;
use App\Model\Employer;
use Illuminate\Support\Str;
use App\Http\Requests\employer\company\UpdateInfoRequest;

class CompanyController extends Controller
{
    public function info()
    {
        $employer = Employer::where("User_ID", session("employer.User_ID"))->first();
        return view("employer.company.info", compact("employer"));
    }

    public function updateInfo(UpdateInfoRequest $request)
    {
        $employer = Employer::where("User_ID", session("employer.User_ID"))->first();
        $employerRequest = $request->validated();
        if ($request->Company_Logo) {
            $file = uploadImageBase64([
                "imageDatabase" => $employer->Company_Logo,
                "imageRequest" => $request->Company_Logo,
                "imageName" => $request->Company_Name,
                "path" => "employer/img/companys/logos"
            ]);
            $employerRequest["Company_Logo"] = $file;
        }
        if ($request->Company_Cover) {
            $file = uploadImageBase64([
                "imageDatabase" => $employer->Company_Cover,
                "imageRequest" => $request->Company_Cover,
                "imageName" => $request->Company_Name,
                "path" => "employer/img/companys/covers"
            ]);
            $employerRequest["Company_Cover"] = $file;
        }
        unset($employerRequest["Province_ID"]);
        $employerRequest["Company_Provinces"] = $request->Province_ID;
        $employerRequest["Company_Slug"] = Str::slug($request->Company_Name);
        Employer::where("User_ID", session("employer.User_ID"))->update($employerRequest);
        return redirect()->back()->with("success", ["title" => "Thông báo", "message" => "Cập nhật thông tin thành công"]);
    }
}
