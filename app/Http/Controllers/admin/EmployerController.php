<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Model\Employer;
use App\Model\Employer_Filter_Package;
use Illuminate\Http\Request;
use App\Model\EmployerPackage;
use App\Model\User;
use App\Model\Job;
use App\Model\History;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class EmployerController extends Controller
{
    public function service()
    {
        return view("admin.employer.service");
    }

    public function getService(Request $request)
    {
        $services = EmployerPackage::getServiceModel();
        return DataTables::of($services)
            ->editColumn("Code_Active", function ($service) {
                return $service->Code_Active ?? "Chưa kích hoạt";
            })
            ->editColumn("Total_Price", function ($service) {
                return currency($service->Total_Price);
            })
            ->editColumn("Status", function ($service) {
                $convert = [
                    [
                        "class" => "bg-primary",
                        "text" => "Chờ duyệt"
                    ],
                    [
                        "class" => "bg-success",
                        "text" => "Xác nhận"
                    ],
                    [
                        "class" => "bg-danger",
                        "text" => "Từ chối"
                    ]
                ];
                return "<span class='badge {$convert[$service->Status]["class"]}'>{$convert[$service->Status]["text"]}</span>";
            })
            ->editColumn("Action", function ($service) {
                return '<button type="button" class="btn btn-light dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">	<span class="visually-hidden">Toggle Dropdown</span></button>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">
                    <a class="dropdown-item btn-seen" data-url="" href="javascript:;">Xem</a>
                    <a class="dropdown-item btn-accept" data-url="' . route("admin.employer.service.set.status", ["code" => $service->Code, "status" => 1]) . '" href="javascript:;">Đồng Ý</a>
                    <a class="dropdown-item btn-deny" data-url="' . route("admin.employer.service.set.status", ["code" => $service->Code, "status" => 2]) . '" href="javascript:;">Từ Chối</a>
                </div>';
            })
            ->rawColumns(["Action", "Status"])
            ->make(true);
    }

    public function setStatusService($code, $status)
    {
        // chỉ tìm code nào có status chưa xác thực
        // get total filer package để cộng vào employer_Fillter_Package  
        $service = EmployerPackage::selectRaw("sum(Total_Package_Price) as `Total_Package_Price`, `Employer_ID`,ID, SUM(IF(Package_ID=10,Total,null)) as Total_Filter")->where([["code", $code], ["Status", 0]])->first();
        if (!$service->Total_Package_Price) {
            abort(404, "Không tìm thấy gói dịch vụ");
        }
        // vì có 2 chứ năng nên dùng mảng để tách ra message và action
        $content = [
            1 => [
                "message" => " Đã xác nhận đơn hàng {$code} thành công! giá " . currency($service->Total_Package_Price), "type" => "success", "Code_Active" => PasswordRandom()
            ],
            2 => ["message" => " Đã từ chối đơn hàng {$code}", "type" => "error", "Code_Active" => null]
        ];
        // nếu có mua gói lọc hồ sơ mới xử lý
        if ($service->Total_Filter) {
            $filterPackage = Employer_Filter_Package::createOrUpdate($service["Employer_ID"]);
            $filterPackage->Employer_ID = $service["Employer_ID"];
            $filterPackage->Total += $service->Total_Filter;
            $filterPackage->save();
        }
        EmployerPackage::where("code", $code)->update(["Status" => $status, "Code_Active" => $content[$status]["Code_Active"]]);
        History::create([
            "User_ID" => $service->employer->User_ID,
            "History_Content" => "Admin:" . session("admin.Fullname") . $content[$status]["message"]
        ]);
        return redirect()->back()->with($content[$status]["type"], ["title" => "Thông báo", "message" => $content[$status]["message"]]);
    }

    public function job()
    {
        return view("admin.employer.job");
    }


    public function getJob()
    {
        $jobs = Job::getJobConfirmAdmin();
        return DataTables::of($jobs)
            ->editColumn("Job_Title", function ($job) {
                return Str::limit($job->Job_Title, 25);
            })
            ->editColumn("Company_Name", function ($job) {
                return "<span class='badge bg-success'>{$job->Company_Name}</span>";
            })
            ->editColumn("Service", function ($job) {
                $service = "<span class='badge bg-success'>+ {$job->Package_Post} </span><br>";
                if ($job->Package_Effect) {
                    $service .= "<span class='badge bg-danger'>+ {$job->Package_Effect}</span>";
                }
                return $service;
            })
            ->editColumn("Job_Created_At", function ($job) {
                return date("Y-m-d H:i:s", $job->Job_Created_At);
            })
            ->editColumn("Status", function ($job) {
                $convert = [
                    1 => [
                        "class" => "bg-warning",
                        "text" => "Đăng tin"
                    ],
                    2 => [
                        "class" => "bg-danger",
                        "text" => "Chỉnh sửa tin"
                    ]
                ];

                return "<span class='badge {$convert[$job->Job_Status]["class"]}'>{$convert[$job->Job_Status]['text']}</span>";
            })
            ->addColumn("Action", function ($job) {
                return
                    "<div class='box-option'>
                        <a href='javascript:void(0)' job-id='{$job->Job_ID}' class='btn-hero btn-job-detail btn-info-hero shadow btn-seen' data-bs-toggle='tooltip' title='Xem tin đăng'><i class='fas fa-eye'></i></a>
                        <a href='javascript:void(0)' class='btn-hero btn-danger-hero shadow btn-delete' data-bs-toggle='tooltip' title='Xóa nghành'><i class='fas fa-trash-alt'></i></a>
                    </div>";
            })
            ->rawColumns(["Service", "Status", "Company_Name", "Action"])
            ->make(true);
    }

    public function jobInfo(Request $request)
    {
        $job = Job::getJobDetailByID($request->id);
        $job["btnDeny"] = route("admin.employer.job.confirm", ["status" => 3, "id" => $request->id]);
        $job["btnAccpet"] = route("admin.employer.job.confirm", ["status" => 4, "id" => $request->id]);
        if (!$job) {
            return $this->response(404, [], "Lỗi ID", [], false);
        }
        return $this->response(200, $job, "Đã trả về", [], true);
    }

    public function confirmJob($id, $status)
    {
        $job = Job::where("Job_ID", $id)->whereIn("Job_Status", [2, 1])->first();
        if (!$job) {
            return abort(404);
        }
        $convert = [
            3 => ["type" => "error", "message" => "Đã từ chối nội dung tuyển dụng"],
            4 => ["type" => "success", "message" => "Đã đồng ý nội dụng tuyển dụng"]
        ];
        // nếu admin đồng ý đăng
        if ($job->Job_Status == 2) {
            if ($status == 4) {
                $job->Package_Post_Expire += time() - $job->Job_Updated_At;
                if ($job->Package_Effect_Expire) {
                    $job->Package_Effect_Expire += time() - $job->Job_Updated_At;
                }
            } else {
                History::create(["User_ID" => $job->employer->User_ID, "History_Content" => "admin đã từ chối chỉnh chửa {$job->Job_Title} bạn vui lòng chỉnh sủa hợp lý"]);
                return redirect()->back()->with($convert[$status]["type"], ["title" => "Thông báo", "message" => $convert[$status]["message"]]);
            }
        } else {
            if ($status == 4) {
                $job->Package_Post_Expire = strtotime("+7 days");
                if ($job->Package_Effect_Buy) {
                    $job->Package_Effect_Expire = strtotime("+7 days");
                }
            } else {
                $employerPostPackage = EmployerPackage::find($job->Package_Post_Buy);
                $employerPostPackage->Total_Current += 1;
                $employerPostPackage->save();
                $employerEffectPackage = EmployerPackage::find($job->Package_Effect_Buy);
                if ($employerEffectPackage) {
                    $employerEffectPackage->Total_Current += 1;
                    $employerEffectPackage->save();
                }
            }
        }
        $job->Job_Status = $status;
        $job->save();
        History::create(["User_ID" => $job->employer->User_ID, "History_Content" => "Admin đã {$convert[$status]["message"]} {$job->Job_Title}"]);
        return redirect()->back()->with($convert[$status]["type"], ["title" => "Thông báo", "message" => $convert[$status]["message"]]);
    }
}
