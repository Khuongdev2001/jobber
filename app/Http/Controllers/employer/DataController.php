<?php
/**
 *  Đây là controller xử lý dữ liệu trả về cho ajax hoặc select2 
 * 
 */
namespace App\Http\Controllers\employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Specialize;
use App\Model\Province;

class DataController extends Controller
{
    public function getSpecialize(Request $request)
    {
        return
            Specialize::select(["Specialize_ID", "Name"])->where("Name","LIKE","%{$request->Name}%")->get();
    }

    public function getProvince(Request $request)
    {
        return
            Province::select(["Province_ID", "Province_Name"])->where("Province_Name","LIKE","%{$request->Province_Name}%")->get();
    }
}
