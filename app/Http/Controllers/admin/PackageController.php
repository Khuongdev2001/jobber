<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\FitlterPackage;
use App\Model\PostPackage;
use App\Http\Requests\admin\package\UpdateFitlterPostRequest;

class PackageController extends Controller
{
    public function config()
    {
        $postPackages = PostPackage::get();
        $fitlerPackage = FitlterPackage::first();
        return view("admin.package.config", compact("postPackages", "fitlerPackage"));
    }

    public function updatePackagePost(Request $request)
    {
        foreach ($request->Package_ID as $id) {
            PostPackage::find($id)->update(["Package_Price" => request("Package_Value.{$id}")]);
        };
        return redirect($request->continue)->with("success", ["title" => "Thông báo", "message" => "Cập nhật thành công!"]);
    }

    public function updateFitlterPost(UpdateFitlterPostRequest $request)
    {
        FitlterPackage::find(1)->update([
            "Package_Price" => $request->Package_Price,
            "Package_Value" => $request->Package_Value
        ]);
        return redirect($request->continue)->with("success",["title"=>"Thông báo","message"=>"Cập nhật gói lọc hồ sơ thành công!"]);
    }
}
