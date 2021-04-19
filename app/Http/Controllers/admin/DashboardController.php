<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Model\EmployerPackage;
use Illuminate\Http\Request;
use App\Model\User;

class DashboardController extends Controller
{
    public function index()
    {
        $static = User::getStatic();
        $totalPrice = EmployerPackage::where("Status", 1)->sum("Total_Package_Price");
        $static["Total"] = $totalPrice;
        return view("admin.dashboard.index",compact("static"));
    }
}
