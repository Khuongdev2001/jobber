<?php

namespace App\Http\Controllers\employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\employer\job\AddJobRequest;
use App\Http\Requests\employer\job\UpdateJobRequest;
use Illuminate\Support\Str;
use App\Model\EmployerPackage;
use App\Model\Job;
use App\Model\History;

class JobController extends Controller
{
    public function add()
    {
        $servicePost = EmployerPackage::getPackagePostModel();
        $serviceEffect = EmployerPackage::getPackageEffectModel();
        return view("employer.job.add", compact("servicePost", "serviceEffect"));
    }

    public function doAdd(AddJobRequest $request)
    {
        $jobRequest = $request->validated();
        $status = 0;
        $message = "Tin tuyển dụng đã được lưu!";
        $history = " bạn đang yêu cầu đăng tin tuyển dụng {$jobRequest["Job_Title"]} ";
        if ($request->Package_Post_Buy) {
            $message = "Tin tuyển dụng đang chờ duyệt!";
            $status = 1;
            // tự động trừ 1 vào gói có sẵn 
            $servicePost = EmployerPackage::find($request->Package_Post_Buy);
            $serviceEffect = EmployerPackage::find($request->Package_Effect_Buy);
            $history .= "Vói gói đăng tin {$servicePost->package->Package_Name} -1 còn lại " . $servicePost->Total_Current--;
            $servicePost->save();
            if ($serviceEffect) {
                $history .= " Và gói hiệu ứng {$serviceEffect->package->Package_Name} -1 còn lại" . $serviceEffect->Total_Current--;
                $serviceEffect->save();
            }
            History::create([
                "User_ID" => session("employer.User_ID"),
                "History_Content" => "{$history} Cảm ơn bạn đã tham gia hệ thống chúng tôi"
            ]);
        }
        $jobRequest["Job_Slug"] = Str::slug($jobRequest["Job_Title"]) . "__" . time();
        $jobRequest["Job_Level_Title"] = __("user.Regency.{$jobRequest["Job_Level"]}");
        $jobRequest["Job_Experience_Title"] = __("user.Experience.{$jobRequest["Job_Experience"]}");
        $jobRequest["Job_Type_Title"] = __("user.Job_Type.{$jobRequest["Job_Type"]}");
        $jobRequest["Job_Status"] = $status;
        $jobRequest["Job_Created_At"] = time();
        $jobRequest["Employer_ID"] = session("employer.Employer_ID");
        $jobRequest["Ip"] = $request->ip();
        Job::create($jobRequest);
        return redirect()->back()->with("success", ["title" => "Thông báo", "message" => $message]);
    }


    public function index($option = "", Request $request)
    {
        $convert = [
            "tin-hien-dang" => "Job_Status=4 AND Package_Post_Expire>" . time(),
            "tin-nhap" => "Job_Status = 0",
            "tin-cho-duyet" => "Job_Status In (1,2)",
            "tin-het-han" => "Job_Status=4 AND Package_Post_Expire <" . time(),
            "tin-tu-cho" => "Job_Status=3",
            "tin-bi-an" => "Job_Status=-1"
        ];
        $sql = ($convert[$option] ?? $convert["tin-hien-dang"]) . " AND Job_Title LIKE '%{$request->search}%' AND jobs.Employer_ID =" . session("employer.Employer_ID");
        $jobs = Job::getJobsByID($sql);
        $static = Job::getStaticByID(session("employer.Employer_ID"), time());
        return view("employer.job.index", compact("static", "jobs"));
    }

    public function action($id, $status)
    {
        $job = Job::where([["Job_ID", $id], ["Employer_ID", session("employer.Employer_ID")]])->whereIn("Job_Status", [-1, 4])->first();
        if (!$job || !in_array($status, [-1, 4])) {
            return redirect()->back()->with("error", ["title" => "Thông báo", "message" => "Lỗi 404"]);
        }
        $message = [
            -1 => "Đã Hiện bản tin tuyển dụng",
            4 => "Đã Ẩn bản tin tuyển dụng"
        ];
        $convert = [-1 => 4, 4 => -1];
        $job->Job_Status = $convert[$status];
        $job->save();
        return redirect()->back()->with("success", ["title" => "Thông báo", "message" => "{$message[$status]} {$job->Job_Title}"]);
    }

    public function update($slug)
    {
        $job = Job::where([["Job_Slug", $slug], ["Employer_ID", session("employer.Employer_ID")]])->first();
        return view("employer.job.add", compact("job"));
    }

    public function doUpdate($slug, UpdateJobRequest $request)
    {
        // get job by slug and employer ID
        $job = Job::where([["Job_Slug", $slug], ["Employer_ID", session("employer.Employer_ID")]])->first();
        if (!$job) {
            return redirect()->back()->with("error", ["title" => "Thông báo", "message" => "Lỗi Người dùng"]);
        }
        $jobRequest = $request->validated();
        $message = "Cập nhật thành công tin tuyển dụng {$job->Job_Title}";
        if ($job->Job_Status == 4) {
            $jobRequest["Job_Status"] = 2;
            $message = "Cập nhật thành công tuy nhiên do tin {$job->Job_Title} đang đăng nên cần admin duyệt";
            History::create([
                "User_ID" => session("employer.User_ID"),
                "History_Content" => $message
            ]);
        };
        $jobRequest["Job_Slug"] = Str::slug($jobRequest["Job_Title"]) . "__" . time();
        $jobRequest["Job_Level_Title"] = __("user.Regency.{$jobRequest["Job_Level"]}");
        $jobRequest["Job_Experience_Title"] = __("user.Experience.{$jobRequest["Job_Experience"]}");
        $jobRequest["Job_Type_Title"] = __("user.Job_Type.{$jobRequest["Job_Type"]}");
        $jobRequest["Job_Updated_At"] = time();
        Job::find($job->Job_ID)->update($jobRequest);
        return redirect()->route("employer.job")->with("success", ["title" => "Thông báo", "message" => $message]);
    }
}
