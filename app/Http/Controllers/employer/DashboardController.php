<?php

namespace App\Http\Controllers\employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\EmployerPackage;
use App\Model\Employer;

class DashboardController extends Controller
{
    public function index()
    {
        $employer = Employer::where("User_ID", session("employer.User_ID"))->first();
        $services = EmployerPackage::selectRaw("Sum(Total_Current) as Total,Package_ID")->where([["Employer_ID", $employer->Employer_ID], ["status", 1],["Total_Current","<>",0]])->groupBy("Package_ID")->get();
        return view("employer.dashboard.index", compact("services"));
    }
}
