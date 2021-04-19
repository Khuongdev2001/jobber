<?php

namespace App\Http\Controllers\candidate;

use App\Http\Controllers\Controller;
use App\Model\Employer;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        $setSearchCompany = true;
        $companys = Employer::getCompanyPaginate($request->search);
        return view("candidate.company.index", compact("setSearchCompany", "companys"));
    }

    public function info($slug)
    {
        $company = Employer::getCompanyByID($slug);
        if (!$company) {
            abort(404);
        }
        return view("candidate.company.info",compact("company"));
    }
}
