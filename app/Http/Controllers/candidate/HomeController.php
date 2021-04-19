<?php

namespace App\Http\Controllers\candidate;

use App\Http\Controllers\Controller;
use App\Model\Job;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $setHome = true;
        return view("candidate.home.index", compact("setHome"));
    }

    public function getJobService($type)
    {
        $packages = [
            "viec-lam-tot-nhat" => 2,
            "viec-lam-hap-dan" => 3,
            "viec-lam-tuyen-dung-gap" => 4,
            "viec-lam-luong-cao" => 5,
            "viec-lam-cap-quan-ly" => 6
        ];

        $package = isset($packages[$type]) ? $packages[$type] : $packages["viec-lam-tot-nhat"];
        return $this->response(200, ["jobs" => Job::getJobServiceModel($package)]);
    }

    public function getJobType($type)
    {
        $types = [
            "viec-lam-tu-xa" => 4,
            "ban-thoi-gian" => 2,
            "viec-lam-thuc-tap" => 3
        ];
        $type=isset($types[$type]) ? $types[$type] : $types["ban-thoi-gian"];
        return $this->response(200, ["jobs" => Job::getJobTypeModel($type)]);
    }
}
