<?php

namespace App\Http\Controllers\candidate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\candidate\user\RegRequest;
use App\Http\Requests\candidate\user\LoginRequest;
use App\Http\Requests\candidate\user\UpdateInfoRequest;
use App\Http\Requests\candidate\user\UploadImageRequest;
use App\Http\Requests\candidate\user\UploadCvRequest;
use Illuminate\Support\Facades\Hash;
use App\Jobs\candidate\UserActiveJob;
use Laravel\Socialite\Facades\Socialite;
use App\Model\User;
use App\Model\Candidate;
use App\Model\Cv;
use App\Model\SeenProfile;
use Illuminate\Support\Str;
use Exception;

class UserController extends Controller
{
    public function reg()
    {
        return view("candidate.user.reg");
    }

    public function doReg(RegRequest $request)
    {
        $userRequest = $request->validated();
        $userRequest["Re_Sendmail"] = strtotime("+5 minutes");
        $userRequest["User_Password"] = Hash::make($request->User_Password);
        $userRequest["Level"] = 1;
        $userRequest["Token"] = createToken();
        $user = User::create($userRequest);
        $userRequest["User_ID"] = $user->User_ID;
        Candidate::create($userRequest);
        dispatch(new UserActiveJob(__("mail.candidate.user.active.subject", ["Fullname" => $userRequest["Fullname"]]), $userRequest));
        return redirect()->back()->with("success", ["title" => "Thông báo", "message" => "Vui lòng kiểm tra hòm thư để kích hoạt tài khoản"]);
    }

    public function active(Request $request)
    {
        $candidate = User::where([["User_Active", 0], ["Token", $request->Token]])->first();
        if (!$candidate) {
            return redirect()->route("reg")->with("error", ["title" => "Thông báo", "message" => "Tài khoản đã kích hoạt hoặc lỗi"]);
        }
        $candidate->User_Active = 1;
        $candidate->save();
        return redirect()->route("reg")->with("success", ["title" => "Thông báo", "message" => "Kích hoạt thành công !"]);
    }

    public function login()
    {
        return view("candidate.user.login");
    }

    public function doLogin(LoginRequest $request)
    {
        $candidate = User::where([["User_Email", $request->User_Email], ["Is_Block", 0]])->first();
        if (!$candidate || !Hash::check($request->User_Password, $candidate->User_Password)) {
            return redirect()->back()->with("error", ["title" => "Thông báo", "message" => "Login thất bại"]);
        }
        if (!$candidate->User_Active) {
            if ($candidate->Re_Sendmail > time()) {
                $minute = round(($candidate->Re_Sendmail - time()) / 60);
                return redirect()->back()->with("error", ["title" => "Thông báo", "message" => "Vui lòng check kỹ mail và đợi {$minute} phút thực hiện thao tác"]);
            }
            $candidate->Token = createToken();
            $candidate->Re_Sendmail = strtotime("+5 minutes");
            $candidate->save();
            dispatch(new UserActiveJob(__("mail.candidate.user.active.subject", ["Fullname" => $candidate["Fullname"]]), $candidate));
            return redirect()->back()->with("success", ["title" => "Thông báo", "message" => "Vui lòng kiểm tra hòm thư để kích hoạt tài khoản"]);
        }
        User::updateSessionCandidate($candidate->User_ID);
        return redirect()->route("home")->with("success", ["title" => "Thông báo", "message" => "Đăng nhập thành công"]);
    }

    public function loginFacebook()
    {
        return Socialite::driver("facebook")->redirect();
    }

    public function callbackFacebook()
    {
        try {
            $userRequest = Socialite::driver("facebook")->user();
        } catch (Exception $e) {
            return redirect()->route("login")->with("error", ["title" => "Thông báo", "message" => "Bạn Chưa Đồng Ý"]);
        };
        // chỉ có facebook có email mới đăng ký
        if (!$userRequest->email) {
            abort(404);
        }
        $user = User::findOrCreateUser($userRequest->email);
        $user->User_Email = $userRequest->email;
        $user->Fullname = $userRequest->name;
        // $user->Avatar = $userRequest->avatar;
        $user->Level = 1;
        $user->Type_Login = 1;
        $user->save();
        $candidate = Candidate::where("Candidate_ID", $user->User_ID)->first();
        // nếu không có sẽ tạo trong bảng candidate 
        if (!$candidate) {
            Candidate::create(["User_ID" => $user->User_ID]);
        }
        User::updateSessionCandidate($user->User_ID);
        return redirect()->route("home")->with("success", ["title" => "Thông báo", "message" => "Đăng nhập thành công"]);
    }

    public function info($email = "")
    {
        $employerSeens = SeenProfile::getEmployerSeenByCandidateID(session("candidate.Candidate_ID"));
        $candidate = Candidate::getCandidateByID(session("candidate.Candidate_ID"));
        if (!$candidate) {
            abort(404);
        }
        $setSearchMenu = true;
        return view("candidate.user.info", compact("setSearchMenu", "candidate", "employerSeens"));
    }

    public function updateInfo(UpdateInfoRequest $request)
    {
        $candidate = $request->validated();
        User::find(session("candidate.User_ID"))->update(
            [
                "Fullname" => $candidate["Fullname"],
                "Phone" => $candidate["Phone"],
                "Gender" => $candidate["Gender"],
                "Birthday" => $candidate["Birthday"]
            ]
        );
        unset($candidate["Fullname"], $candidate["Phone"], $candidate["Gender"], $candidate["Birthday"], $candidate["continue"]);
        Candidate::where("User_ID", session("candidate.User_ID"))->update($candidate);
        User::updateSessionCandidate();
        return redirect($request->continue)->with("success", ["title" => "Thông báo", "message" => "Cập nhật thành công {$request->Fullname}"]);
    }

    public function uploadImage(UploadImageRequest $request, $cover = "")
    {
        $object["imageRequest"] = $request->thumbnail;
        $object["path"] = "candidate/imgs/avatars/";
        $candidate = User::find(session("candidate.User_ID"));
        $object["imageDatabase"] = $candidate->Avatar;
        $object["imageName"] = session("candidate.Fullname");
        if ($cover) {
            $candidate = Candidate::find(session("candidate.Candidate_ID"));
            $object["path"] = "candidate/imgs/covers/";
            $object["imageDatabase"] = $candidate->Cover;
        }
        $file = uploadImageBase64($object);
        if ($cover) {
            $candidate->Cover = $file;
            $candidate->save();
            return $this->response(200, ["thumbnail" => asset($file)], "Thêm thành công ảnh bìa");
        }
        $candidate->Avatar = $file;
        $candidate->save();
        User::updateSessionCandidate();
        return $this->response(200, ["thumbnail" => asset($file)], "Thêm thành công ảnh đại diện");
    }

    public function uploadCv(UploadCvRequest $request)
    {
        $extension = $request->file("cv")->extension();
        $dir = "candidate/cvs";
        $fileName = Str::slug(session("candidate.Fullname")) . time() . "." . $extension;
        $request->file("cv")->move("public/" . $dir, $fileName);
        Cv::create(["Cv_Title" => $request->Cv_Title, "File" => "{$dir}/{$fileName}", "Candidate_ID" => session("candidate.Candidate_ID")]);
        return redirect($request->continue)->with("success", ["title" => "Thông báo", "message" => "Cập nhật thành công cv"]);
    }

    public function actionCv($id, $option)
    {
        // get cv by id
        $cv = Cv::getCvByID($id, session("candidate.Candidate_ID"));
        $countCv = Cv::countCvDefaultByID(session("candidate.Candidate_ID"));
        if (!$cv) {
            abort(404);
        }
        $message = [
            "Đã đặt cv là mặt định",
            "Đã hủy đặt cv mặt định",
            "Đã xóa thành công cv"
        ];
        // chỉ cho 1 cv đặt làm mặt định
        if ($countCv && !$option) {
            return redirect()->back()->with("error", ["title" => "Thông báo", "message" => "Không thể đặt cv mặt định vì đã có 1 cv khác làm mặt định"]);
        }
        $cv->Is_Default = !$option;
        // delete cv
        if ($option == 2) {
            if (is_file("public/{$cv->File}")) {
                unlink("public/{$cv->File}");
            };
            $cv->delete();
            return redirect()->back()->with("success", ["title" => "Thông báo", "message" => $message[$option]]);
        }
        $cv->save();
        return redirect()->back()->with("success", ["title" => "Thông báo", "message" => $message[$option]]);
    }

    public function logout()
    {
        session()->forget('candidate');
        return redirect()->route("home")->with("success", ["title" => "Thông báo", "message" => "Đăng xuất thành công"]);
    }
}
