<?php

namespace App\Http\Controllers\employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\History;
class HistoryController extends Controller
{
    public function index(Request $request){
        $historys=History::where([["User_ID",session("employer.User_ID")],["History_Content","LIKE","%{$request->search}%"]])->select(["History_Content","History_Created_At"])->orderBy("History_Created_At","Desc")->paginate(10);
        return view("employer.history.index",compact("historys"));
    }
}
