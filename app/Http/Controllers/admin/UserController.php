<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\admin\user\LoginRequset;
use App\Http\Requests\admin\user\AddAdminRequest;
use App\Http\Requests\admin\user\UpdateAdminRequest;
use App\Model\User;
use App\Model\Candidate;
use App\Model\Employer;
use Illuminate\Support\Facades\Hash;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;
use Yajra\DataTables\Contracts\DataTable;

class UserController extends Controller
{
    public function login()
    {
        return view("admin.user.login");
    }

    public function doLogin(LoginRequset $request)
    {
        $user = User::where([
            [
                "User_Email", $request->User_Email,
            ],
            [
                "Is_Block", 0
            ]
        ])->whereIn("Level", [4, 5, 6])->first();
        if (!$user || !Hash::check($request->User_Password, $user->User_Password)) {
            return redirect()->back()->with("error", ["title" => "Cảnh báo!", "message" => "Login thất bại"]);
        }
        session(["admin" => $user]);
    }

    public function indexAdmin()
    {
        return view("admin.user.admin.index");
    }

    public function getIndexAdmin(Request $request)
    {
        $users = User::whereIn("Level", [4, 5, 6])->get();
        return DataTables::of($users)
            ->editColumn("Avatar", function ($user) {
                $url = empty($user->Avatar) ? 'admin/images/avatars/default.jpg' : $user->Avatar;
                return
                    '<a href="javascript:void(0)" class="box-thumbnail">
                        <img class="thumbnail" src="' . asset($url) . '">
                    </a>';
            })
            ->addColumn("check", function ($user) {
                return
                    '<div class="form-check d-flex justify-content-center">
                        <input class="form-check-input" type="checkbox" value="" data-id="' . $user->User_ID . '">
                    </div>';
            })
            ->editColumn("User_Created_At", function ($user) {
                return date("Y-m-d", $user->User_Created_At);
            })
            ->editColumn("Level", function ($user) {
                $convert = [
                    "name" => [
                        4 => "Cấp thấp",
                        5 => "Cấp cao",
                        6 => "Quản trị hệ thống"
                    ],
                    "css" => [
                        4 => "bg-info",
                        5 => "bg-success",
                        6 => "bg-danger"
                    ]
                ];
                return '<span class="badge ' . $convert["css"][$user->Level] . '">' . $convert["name"][$user->Level] . '</span>';
            })
            ->addColumn("action", function ($user) {
                $convert = [
                    [
                        "class" => "btn-success-hero",
                        "icon" => '<i class="fas fa-lock"></i>',
                        "title" => "Khóa tài khoản"
                    ],
                    [
                        "class" => "btn-warning-hero",
                        "icon" => '<i class="fas fa-unlock"></i>',
                        "title" => "Mở khóa tài khoản"
                    ]
                ];
                return
                    '<a href="' . route("admin.user.admin.block", ["id" => $user->User_ID, 'status' => $user->Is_Block, "continue" => route("admin.user.admin")]) . '" class="btn-hero shadow btn-block ' . $convert[$user->Is_Block]["class"] . '" admin-id=' . $user->User_ID . ' data-bs-toggle="tooltip" title="' . $convert[$user->Is_Block]["title"] . '">' . $convert[$user->Is_Block]["icon"] . '</a>
                    <a href="' . route("admin.user.admin.info", ["email" => $user->User_Email]) . '" class="btn-hero btn-info-hero shadow" data-bs-toggle="tooltip" admin-id=' . $user->User_ID . ' title="Cập nhật tài khoản"><i class="fas fa-pen"></i></a>
                    <a href="' . route("admin.user.admin.delete", ["ids" => $user->User_ID, "continue" => route("admin.user.admin")]) . '" class="btn-hero btn-danger-hero shadow btn-delete" admin-id=' . $user->User_ID . ' data-bs-toggle="tooltip" title="Xóa tài khoản"><i class="fas fa-trash-alt"></i></a>';
            })
            ->rawColumns(["action", "Avatar", "check", "Level"])
            ->make(true);
    }

    public function addAdmin()
    {
        return view("admin.user.admin.add");
    }

    public function doAddAdmin(AddAdminRequest $request)
    {
        $user = $request->validated();
        $user["User_Password"] = Hash::make($user["User_Password"]);
        User::create($user);
        return redirect()->back()->with("success", ["title" => "Thông báo", "message" => "Thêm tài khoản thành công"]);
    }

    public function infoAdmin($email)
    {
        $user = User::where("User_Email", $email)->whereIn("Level", [4, 5, 6])->first();
        if (!$user) {
            return redirect()->back();
        }
        return view("admin.user.admin.info", compact("user"));
    }

    public function updateAdmin($id, UpdateAdminRequest $request)
    {
        $user = $request->validated();
        $userDatabase = User::find($id);
        if (!$userDatabase) {
            return redirect()->back()->with("error", ["title" => "Cảnh báo", "message" => "Không tìm thấy tài khoản"]);
        }
        $check = User::where([["User_Email", $user["User_Email"]], ["User_Email", "<>", $userDatabase["User_Email"]]])->first();
        if ($check) {
            return redirect()->back()->with("error", ["title" => "Cảnh báo", "message" => "Email đã trùng hệ thống"]);
        }
        $userSesssion = session("admin");

        // các user khác không có quyền admin sẽ không được chỉnh
        if ($userSesssion["User_ID"] != $userDatabase["User_ID"] && in_array($userSesssion["Level"], [4, 5])) {
            return redirect()->back()->with("error", ["title" => "Cảnh báo", "message" => "Bạn không được quyền"]);
        }
        $userUpdate = ["Level" => $user["Level"] = $user["Level"] == 6 ? "5" : $user["Level"]];
        // user chính bản thân cập nhật các quyền cơ bản không cập nhật level
        if ($userSesssion["User_ID"] == $userDatabase["User_ID"]) {
            unset($user["Level"]);
            $user["User_Password"] = Hash::make($user["User_Password"]);
            $userUpdate = $user;
        }
        User::find($id)->update($userUpdate);
        return redirect()->route("admin.user.admin")->with("success", ["title" => "Thông báo", "message" => "Cập nhật thành công tài khoản"]);
    }

    public function block($id, Request $request)
    {
        // chỉ có admin level 6 mới làm được
        $message = ["Mở Khóa thành công", "Khóa thành công"];
        $user = User::find($id);
        if ($user->User_ID == session("admin.User_ID")) {
            return redirect()->route("admin.user.admin")->with("error", ["title" => "Thông báo", "message" => "Bạn không thể khóa chính bản thân mình"]);
        }
        $user->update(["Is_Block" => !$request->status]);
        return redirect($request->continue)->with("success", ["title" => "Thông báo", "message" => $message[!$request->status]]);
    }


    public function uploadImageAdmin(Request $request)
    {
        $id = session("admin")->User_ID;
        $user = User::find($id);
        if (!$user) {
            return $this->response(404, [], "Không tìm thấy admin", [], false);
        }
        if (is_file("public/" . $user->Avatar)) {
            unlink("public/" . $user->Avatar);
        }
        $dataImage = explode(",", $request->thumbnail);
        $file = "admin/images/avatars/admin/" . time() . "_" . Str::slug($user->Fullname) . ".jpg";
        file_put_contents("public/" . $file, base64_decode($dataImage[1]));
        $user->Avatar = $file;
        $user->save();
        return $this->response(200, ["thumbnail" => asset($file)], "Cập nhật ảnh thành công !");
    }

    public function delete(Request $request)
    {
        $ids = $request->ids;
        $numFile = 0;
        foreach (explode(",", $ids) as $id) {
            // get user by id
            $user = User::find($id);
            if (!$user || $user->User_ID == session("admin.User_ID")) {
                continue;
            };
            $numFile++;
            if (is_file("public/" . $user->Avatar)) {
                unlink("public/" . $user->Avatar);
            };
            $user->delete();
        };
        return redirect($request->continue)->with("success", ["title" => "Thông báo", "message" => "Đã xóa thành công {$numFile} Tài khoản "]);
    }

    public function indexCandidate()
    {
        return view("admin.user.candidate.index");
    }

    public function getIndexCandidate()
    {
        $users = User::whereIn("Level", [1])->get();
        return DataTables::of($users)
            ->editColumn("Avatar", function ($user) {
                $url = empty($user->Avatar) ? 'admin/images/avatars/default.jpg' : $user->Avatar;
                return
                    '<a href="javascript:void(0)" class="box-thumbnail">
                    <img class="thumbnail" src="' . asset($url) . '">
                </a>';
            })
            ->addColumn("check", function ($user) {
                return
                    '<div class="form-check d-flex justify-content-center">
                    <input class="form-check-input" type="checkbox" value="" data-id="' . $user->User_ID . '">
                </div>';
            })
            ->editColumn("User_Created_At", function ($user) {
                return date("Y-m-d", $user->User_Created_At);
            })
            ->editColumn("Type_Login", function ($user) {
                $convert = [
                    "name" => [
                        0 => "Thường",
                        1 => "FaceBook",
                    ],
                    "css" => [
                        0 => "bg-info",
                        1 => "bg-success",
                    ]
                ];
                return '<span class="badge ' . $convert["css"][$user->Type_Login] . '">' . $convert["name"][$user->Type_Login] . '</span>';
            })
            ->addColumn("action", function ($user) {
                $convert = [
                    [
                        "class" => "btn-success-hero",
                        "icon" => '<i class="fas fa-lock"></i>',
                        "title" => "Khóa tài khoản"
                    ],
                    [
                        "class" => "btn-warning-hero",
                        "icon" => '<i class="fas fa-unlock"></i>',
                        "title" => "Mở khóa tài khoản"
                    ]
                ];
                $active = "";
                if (!$user->User_Active) {
                    $active = '<a href="' . route("admin.user.candidate.active", ["id" => $user->User_ID, "continue" => route("admin.user.candidate")]) . '" class="btn-hero btn-success-hero shadow me-1" data-bs-toggle="tooltip" title="Kích hoạt tài khoản"><i class="far fa-check-circle"></i></a>';
                }
                return
                    $active .
                    '<a href="' . route("admin.user.candidate.block", ["id" => $user->User_ID, 'status' => $user->Is_Block, "continue" => route("admin.user.candidate")]) . '" class="btn-hero shadow btn-block ' . $convert[$user->Is_Block]["class"] . '" admin-id=' . $user->User_ID . ' data-bs-toggle="tooltip" title="' . $convert[$user->Is_Block]["title"] . '">' . $convert[$user->Is_Block]["icon"] . '</a>
                     <a href="' . route("admin.user.candidate.info", ["email" => $user->User_Email]) . '" class="btn-hero btn-info-hero shadow" data-bs-toggle="tooltip" admin-id=' . $user->User_ID . ' title="Cập nhật tài khoản"><i class="fas fa-pen"></i></a>
                     <a href="' . route("admin.user.candidate.delete", ["ids" => $user->User_ID, "continue" => route("admin.user.candidate")]) . '" class="btn-hero btn-danger-hero shadow btn-delete" admin-id=' . $user->User_ID . ' data-bs-toggle="tooltip" title="Xóa tài khoản"><i class="fas fa-trash-alt"></i></a>';
            })
            ->rawColumns(["action", "Avatar", "check", "Type_Login"])
            ->make(true);
    }

    public function active($id, Request $request)
    {
        User::find($id)->update([
            "User_Active" => 1
        ]);
        return redirect($request->continue)->with("success", ["title" => "Thông báo", "message" => "Kích hoạt thành công tài khoản"]);
    }

    public function infoCandidate($email)
    {
        $user = Candidate::select(["users.User_ID", "candidates.Candidate_ID", "users.Fullname", "User_Email", "Avatar", "Gender", "Phone", "Birthday", "Specialize_ID", "Province_ID", "Address", "Marriage", "Experience", "Wage_From", "Wage_To", "Description"])->leftJoin('users', 'users.User_ID', '=', 'candidates.User_ID')->where("User_Email", $email)->first();
        return view("admin.user.candidate.info", compact("user"));
    }

    public function indexEmployer()
    {
        return view("admin.user.employer.index");
    }

    public function getIndexEmployer()
    {
        $users = User::whereIn("Level", [2])->get();
        return DataTables::of($users)
            ->editColumn("Avatar", function ($user) {
                $url = empty($user->Avatar) ? 'admin/images/avatars/default.jpg' : $user->Avatar;
                return
                    '<a href="javascript:void(0)" class="box-thumbnail">
                    <img class="thumbnail" src="' . asset($url) . '">
                </a>';
            })
            ->addColumn("check", function ($user) {
                return
                    '<div class="form-check d-flex justify-content-center">
                    <input class="form-check-input" type="checkbox" value="" data-id="' . $user->User_ID . '">
                </div>';
            })
            ->editColumn("User_Created_At", function ($user) {
                return date("Y-m-d", $user->User_Created_At);
            })
            ->addColumn("action", function ($user) {
                $convert = [
                    [
                        "class" => "btn-success-hero",
                        "icon" => '<i class="fas fa-lock"></i>',
                        "title" => "Khóa tài khoản"
                    ],
                    [
                        "class" => "btn-warning-hero",
                        "icon" => '<i class="fas fa-unlock"></i>',
                        "title" => "Mở khóa tài khoản"
                    ]
                ];
                $active = "";
                if (!$user->User_Active) {
                    $active = '<a href="' . route("admin.user.employer.active", ["id" => $user->User_ID, "continue" => route("admin.user.employer")]) . '" class="btn-hero btn-success-hero shadow me-1" data-bs-toggle="tooltip" title="Kích hoạt tài khoản"><i class="far fa-check-circle"></i></a>';
                }
                return
                    $active .
                    '<a href="' . route("admin.user.employer.block", ["id" => $user->User_ID, 'status' => $user->Is_Block, "continue" => route("admin.user.employer")]) . '" class="btn-hero shadow btn-block ' . $convert[$user->Is_Block]["class"] . '" admin-id=' . $user->User_ID . ' data-bs-toggle="tooltip" title="' . $convert[$user->Is_Block]["title"] . '">' . $convert[$user->Is_Block]["icon"] . '</a>
                     <a href="' . route("admin.user.employer.info", ["email" => $user->User_Email]) . '" class="btn-hero btn-info-hero shadow" data-bs-toggle="tooltip" admin-id=' . $user->User_ID . ' title="Cập nhật tài khoản"><i class="fas fa-pen"></i></a>
                     <a href="?module=employer&action=package" class="btn-hero btn-info-hero shadow" data-bs-toggle="tooltip" title="xem gói dịch vụ"><i class="fas fa-cube"></i></a>
                     <a href="' . route("admin.user.candidate.delete", ["ids" => $user->User_ID, "continue" => route("admin.user.candidate")]) . '" class="btn-hero btn-danger-hero shadow btn-delete" admin-id=' . $user->User_ID . ' data-bs-toggle="tooltip" title="Xóa tài khoản"><i class="fas fa-trash-alt"></i></a>';
            })
            ->rawColumns(["action", "Avatar", "check", "Type_Login"])
            ->make(true);
    }

    public function infoEmployer($email){
        
        $user = Employer::select(["users.User_ID", "employers.Employer_ID", "Fullname", "User_Email", "Avatar", "Gender", "Phone", "Birthday", "Specialize_ID", "Regency","Company_Name","Company_Phone","Company_Address","Business_License","Company_Provinces","Company_Size","Company_Contactor","Company_Email","Company_Website","Company_Description","Company_Logo","Company_Cover","Company_Is_Confirm"])->leftJoin('users', 'users.User_ID', '=', 'employers.User_ID')->where("User_Email", $email)->first();
        return view("admin.user.employer.info",compact("user"));
    }
}
