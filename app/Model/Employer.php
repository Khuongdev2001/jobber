<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    public $table = "employers";
    public $primaryKey = "Employer_ID";
    public $fillable = ["Employer_ID", "Company_Slug", "User_ID", "Regency", "Company_Name", "Company_Phone", "Company_Address", "Business_License", "Company_Provinces", "Company_Size", "Specialize_ID", "Company_Contactor", "Company_Email", "Company_Website", "Company_Description", "Company_Logo", "Company_Cover", "Company_Is_Confirm"];
    public function specialize()
    {
        return $this->belongsTo("App\Model\Specialize", "Specialize_ID");
    }

    public function province()
    {
        return $this->belongsTo("App\Model\Province", "Company_Provinces");
    }
    public function user(){
        return $this->belongsTo("App\Model\User","User_ID");
    }

    public static function getCompanyPaginate($search)
    {
        return Employer::leftJoin("users", "users.User_ID", "=", "employers.User_ID")->select(["Company_Logo", "Company_Slug", "Company_Name", "Employer_ID", "Company_Address", "Company_Description"])->where([["Is_Block", 0], ["Company_Name", "LIKE", "%{$search}%"], ["Company_Is_Confirm", 1]])->paginate(5);
    }

    public static function getCompanyByID($slug)
    {
        return Employer::leftJoin("users", "users.User_ID", "=", "employers.User_ID")->select(["Company_Logo", "Company_Slug", "Company_Name", "Employer_ID", "Company_Address", "Company_Description", "Company_Website", "Company_Size", "Company_Cover"])->where([["Is_Block", 0], ["Company_Slug", $slug], ["Company_Is_Confirm", 1]])->first();
    }
}
