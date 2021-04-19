<?php

namespace App\Http\Controllers\employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Package;
use App\Http\Requests\employer\product\AddProductRequest;
use App\Http\Requests\employer\product\ActiveProductRequest;
use App\Model\Employer;
use Illuminate\Support\Facades\Session;
use App\Model\EmployerPackage;

class ProductController extends Controller
{
    public function buy()
    {
        /**  
         *  index = 1-6 (gói đăng tin) 
         *  index = 7-9 (gói hiệu ứng)
         *  index= 10 (gói lọc hồ sơ)  
         */
        $package = Package::select("Package_Value", "Date_Expired", "Package_Price", "Package_ID")->get();
        return view("employer.product.buy", compact("package"));
    }

    public function addProduct(AddProductRequest $request)
    {
        $package = Package::select("Package_Value", "Package_Price")->where("Package_Type", $request->id)->first();
        $qty = $request->qty;
        $totalQty = $package->Package_Price * $qty;
        $class = "package-post";
        if ($request->id == 10) {
            $qty *= $package->Package_Value;
            $class = "package-filter";
        }
        session()->put(
            "product.info.{$request->id}",
            [
                "Package_ID" => $request->id,
                "Total" => $qty,
                "qty" => $request->qty,
                "Package_Price" => $package->Package_Price,
                "Total_Package_Price" => $totalQty
            ]
        );
        if ($request->qty == 0) {
            Session::forget("product.info.{$request->id}");
        }
        $this->updateTotalProduct();
        return response()->json([
            "qty" => $request->qty,
            "id" => $request->id,
            "price" => currency(session("product.info.{$request->id}.Total_Package_Price")),
            "priceNone" => currency($package->Package_Price),
            "total" => currency(session("product.total.total")),
            "totalRaw" => session("product.total.total"),
            "Total" => session("product.info.{$request->id}.Qty"),
            "class" => $class
        ]);
    }

    public function updateTotalProduct()
    {
        $qty = 0;
        $total = 0;
        foreach (session("product.info") as $key => $item) {
            $qty += $item["qty"];
            $total += $item["Total_Package_Price"];
        }
        Session::put("product.total", [
            "total" => $total,
            "qty" => $qty,
        ]);
    }

    public function doAddProduct()
    {
        $code = createCodeProduct();
        if (!session("product.total.total")) {
            return redirect()->back()->with("error", ["title" => "Thông báo", "message" => "Vui lòng chọn đơn hàng"]);
        }
        /**
         * Insert tối đa 10 lần
         */
        foreach (session("product.info") as $item) {
            $item["Code"] = $code;
            $item["Total_Current"]=$item["Total"];
            $item["Employer_ID"] = session("employer.Employer_ID");
            EmployerPackage::create($item);
        }
        session()->forget("product");
        return redirect()->back()->with("success", ["title" => "Thông báo", "message" => "Chúng tôi sẽ liên hệ bạn thời gian ngắn nhất"]);
    }
    public function activeProduct(ActiveProductRequest $request)
    {
        $employer = Employer::select("Employer_ID")->where("User_ID", session("employer.User_ID"))->first();
        $status = EmployerPackage::where([["Employer_ID", $employer->Employer_ID], ["Code_Active", $request->code]])->update(["status" => 1]);
        if (!$status)
            return redirect()->back()->with("error", ["title" => "Thông báo", "message" => "Kích hoạt thất bại"]);
        return redirect()->back()->with("success", ["title" => "Thông báo", "message" => "Kích hoạt thành công"]);
    }
}
