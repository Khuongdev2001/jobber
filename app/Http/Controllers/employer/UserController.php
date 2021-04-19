<?php

namespace App\Http\Controllers\employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\employer\user\RegEmployerRequest;
use App\Http\Requests\employer\user\LoginEmployerRequest;
use App\Http\Requests\employer\user\ForgetEmployerRequest;
use App\Http\Requests\employer\user\DoForgetEmployerRequest;
use App\Http\Requests\employer\user\UpdateEmployerRequest;
use App\Http\Requests\employer\user\ChangePasswordEmployerRequest;
use App\Jobs\employer\UserActiveJob;
use App\Jobs\employer\UserForgetJob;
use Illuminate\Support\Facades\Hash;
use App\Model\User;
use App\Model\Employer;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function reg()
    {
        return view("employer.user.reg");
    }

    public function doReg(RegEmployerRequest $request)
    {
        $userRequest = $request->validated();
        $userRequest["Re_Sendmail"] = strtotime("+5 minutes");
        $userRequest["User_Password"] = Hash::make($request->User_Password);
        $userRequest["Level"] = 2;
        $userRequest["Token"] = createToken();
        $user = User::create($userRequest);
        $userRequest["User_ID"] = $user->User_ID;
        $userRequest["Company_Slug"]=Str::slug($request->Company_Name);
        Employer::create($userRequest);
        dispatch(new UserActiveJob(__("mail.employer.user.active.subject", ["Fullname" => $userRequest["Fullname"]]), $userRequest));
        return redirect()->back()->with("success", ["title" => "Thông báo", "message" => "Vui lòng kiểm tra hòm thư để kích hoạt tài khoản"]);
    }

    public function active(Request $request)
    {
        $employer = User::where([["User_Active", 0], ["Token", $request->Token]])->first();
        if (!$employer) {
            return redirect()->route("employer.reg")->with("error", ["title" => "Thông báo", "message" => "Tài khoản đã kích hoạt hoặc lỗi"]);
        }
        $employer->User_Active = 1;
        $employer->save();
        return redirect()->route("employer.reg")->with("success", ["title" => "Thông báo", "message" => "Kích hoạt thành công !"]);
    }

    public function doLogin(LoginEmployerRequest $request)
    {
        $employer = User::where([["User_Email", $request->User_Email], ["Level", 2], ["Is_Block", 0]])->first();
        if (!$employer || !Hash::check($request->User_Password, $employer->User_Password)) {
            return redirect()->back()->with("error", ["title" => "Thông báo", "message" => "Login thất bại"]);
        }
        if (!$employer->User_Active) {
            if ($employer->Re_Sendmail > time()) {
                $minute = round(($employer->Re_Sendmail - time()) / 60);
                return redirect()->back()->with("error", ["title" => "Thông báo", "message" => "Vui lòng check kỹ mail và đợi {$minute} phút thực hiện thao tác"]);
            }
            $employer->Token = createToken();
            $employer->Re_Sendmail = strtotime("+5 minutes");
            $employer->save();
            dispatch(new UserActiveJob(__("mail.employer.user.active.subject", ["Fullname" => $employer["Fullname"]]), $employer));
            return redirect()->back()->with("success", ["title" => "Thông báo", "message" => "Vui lòng kiểm tra hòm thư để kích hoạt tài khoản"]);
        }
        User::updateSessionEmployer($employer->User_ID);
        return redirect()->route("employer.home")->with("success", ["title" => "Thông báo", "message" => "Đăng nhập thành công"]);
    }

    public function forget(ForgetEmployerRequest $request)
    {

        $employer = User::where([["User_Email", $request->User_Email], ["Level", 2], ["Is_Block", 0]])->first();
        if (!$employer) {
            return redirect()->back()->with("error", ["title" => "Thông báo", "message" => "Không tìm thấy tài khoản bạn vui lòng đăng ký"]);
        }
        if ($employer->Re_Sendmail > time()) {
            $minute = round(($employer->Re_Sendmail - time()) / 60);
            return redirect()->back()->with("error", ["title" => "Thông báo", "message" => "Vui lòng check kỹ mail và đợi {$minute} phút thực hiện thao tác"]);
        }
        $employer->Re_Sendmail = strtotime("+5 minutes");
        $employer->save();
        $employer["User_Password_New"] = PasswordRandom();
        dispatch(new UserForgetJob(__("mail.employer.user.active.subject", ["Fullname" => $employer["Fullname"]]), $employer));
        return redirect()->back()->with("success", ["title" => "Thông báo", "message" => "Vui lòng kiểm tra mail quên mật khẩu"]);
    }

    public function doForget(DoForgetEmployerRequest $request)
    {
        $employer = User::where([["Token", $request->Token], ["Is_Block", 0]])->first();
        if (!$employer) {
            return redirect()->back()->with("error", ["title" => "Thông báo", "message" => "Không tìm thấy tài khoản"]);
        }
        $employer->User_Password = Hash::make($request->User_Password_New);
        $employer->Token = createToken();
        $employer->save();
        return redirect()->route("employer.reg")->with("success", ["title" => "Thông báo", "message" => "Kích hoạt mật khẩu thành công"]);
    }

    public function info()
    {
        // get employer left join user end employer
        $employer = Employer::leftJoin("users", "users.User_ID", "=", "employers.User_ID")->select(["users.User_ID", "User_Email", "Gender", "Fullname", "Avatar", "Phone", "Birthday", "Regency"])->where("users.User_ID", session("employer.User_ID"))->first();
        return view("employer.user.info", compact("employer"));
    }


    public function doUpdate(UpdateEmployerRequest $request)
    {
        $employer = $request->validated();
        User::find(session("employer.User_ID"))->update([
            "Fullname" => $employer["Fullname"],
            "Gender" => $employer["Gender"],
            "Phone" => $employer["Phone"]
        ]);
        Employer::where("User_ID", session("employer.User_ID"))->update([
            "Regency" => $employer["Regency"]
        ]);
        return redirect($request->continue)->with("success", ["title" => "Thông báo", "message" => "Cập nhật thông tin thành công"]);
    }


    public function uploadImageEmployer(Request $request)
    {
        $user = User::find(session("employer.User_ID"));
        if (is_file("public/" . $user->Avatar)) {
            unlink("public/" . $user->Avatar);
        }
        $dataImage = explode(",", $request->thumbnail);
        $file = "employer/img/avatars/" . time() . "_" . Str::slug($user->Fullname) . ".jpg";
        file_put_contents("public/" . $file, base64_decode($dataImage[1]));
        $user->Avatar = $file;
        $user->save();
        User::updateSessionEmployer();
        return $this->response(200, ["thumbnail" => asset($file)], "Cập nhật ảnh thành công !");
    }

    public function changePassword(ChangePasswordEmployerRequest $request)
    {
        $employer = User::find(session("employer.User_ID"));
        if (!Hash::check($request->User_Password_Old, $employer->User_Password)) {
            return redirect()->back()->with("error", ["title" => "Thông báo", "message" => "Thông tin mật khẩu sai"]);
        }
        $employer->User_Password = Hash::make($request->User_Password_New);
        $employer->save();
        return redirect($request->continue)->with("success", ["title" => "Thông báo", "message" => "Cập nhật mật khẩu thành công"]);
    }

    public function logout()
    {
        session()->forget("employer");
        return redirect()->route("employer.home")->with("success", ["title" => "Thông báo", "message" => "Đăng xuất thành công"]);
    }
}
