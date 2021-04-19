<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EmployerPackage extends Model
{
    const CREATED_AT = "Buy_Created_At";
    const UPDATED_AT = "Buy_Updated_At";
    public $table = "employer_packages";
    public $primaryKey = "ID";
    public $fillable = ["ID", "Employer_ID", "Package_ID", "Total", "Total_Current", "Package_Price", "Total_Package_Price", "Code", "Code_Active", "Status", "Buy_Created_At", "Buy_Updated_At"];
    public static function getServiceModel()
    {
        return self::select(DB::raw("Fullname,Code,users.User_ID,Code_Active,SUM(Total_Package_Price) as Total_Price,Buy_Created_At,ID,employer_packages.Status"))
            ->leftJoin("employers", "employers.Employer_ID", "=", "employer_packages.Employer_ID")
            ->leftJoin("users", "employers.User_ID", "=", "users.User_ID")
            ->groupBy("Code")->get();
    }

    public function package()
    {
        return $this->belongsTo("App\Model\Package", "Package_ID");
    }

    public function employer()
    {
        return $this->belongsTo("App\Model\Employer", "Employer_ID");
    }

    public static function getPackagePostModel()
    // SELECT `Package_ID`,SUM(`Total_Current`) as `Total`,`ID` as `Service_ID` FROM `employer_packages` WHERE `Status` = 1 AND `Total_Current` <> 0 AND `Package_ID` BETWEEN 1 AND 5  GROUP BY `Package_ID`
    {
        return self::select(DB::raw("`Package_ID`,SUM(`Total_Current`) as `Total`,`ID` as `Service_ID`"))
            ->whereRaw("`Status` = 1 AND `Total_Current` <> 0 AND `Package_ID` BETWEEN 1 AND 6 AND `Employer_ID` = " . session("employer.Employer_ID"))
            ->groupBy("Package_ID")
            ->get();
    }

    public static function getPackageEffectModel()
    {
        return self::select(DB::raw("`Package_ID`,SUM(`Total_Current`) as `Total`,`ID` as `Service_ID`"))
            ->whereRaw("`Status` = 1 AND `Total_Current` <> 0 AND `Package_ID` BETWEEN 7 AND 9 AND `Employer_ID` = " . session("employer.Employer_ID"))
            ->groupBy("Package_ID")
            ->get();
    }   
}
