<?php

namespace App\Http\Controllers\employer;

use App\Model\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view("employer.home.index");
    }
}
