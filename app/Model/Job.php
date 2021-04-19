<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Job extends Model
{
    public $table = "jobs";
    public $timestamps = false;
    public $primaryKey = "Job_ID";
    public $fillable = ["Job_ID", "Job_Slug", "Employer_ID", "Job_Title", "Specialize_ID", "Job_Level", "Number_People", "Job_Experience", "Job_Interest", "Wage_To", "Wage_From", "Job_Type_Title", "Job_Type", "Job_Description", "Job_Required", "Required_Gender", "Job_Limit", "Package_Post_Buy", "Package_Effect_Buy", "Job_Address", "Job_Province", "Job_Status", "Package_Effect_Expire", "Package_Post_Expire", "Job_Created_At", "Job_Updated_At", "Job_Level_Title", "Job_Experience_Title", "Ip"];

    public static function getJobConfirmAdmin()
    {
        return DB::select("SELECT `Job_Status`,`Job_ID`,`Job_Created_At`,`jobs`.`Job_Title`,`employers`.`Company_Name`,`effect_packages`.`Package_Name` as `Package_Effect` ,`post_packages`.`Package_Name` as `Package_Post`  FROM `jobs` LEFT JOIN `employers` ON `jobs`.`Employer_ID` = `employers`.`Employer_ID` LEFT JOIN `employer_packages` as `Employer_Post_Packages` ON `Employer_Post_Packages`.`ID`= `jobs`.`Package_Post_Buy` LEFT JOIN `packages` as `post_packages` ON `post_packages`.`Package_ID`=`employer_post_packages`.`Package_ID` LEFT JOIN `employer_packages` as `employer_effect_packages` ON `jobs`.`Package_Effect_Buy`=`employer_effect_packages`.`ID` LEFT JOIN `packages` as `effect_packages` ON `effect_packages`.`Package_ID`=`employer_effect_packages`.`Package_ID` WHERE `jobs`.`Job_Status` IN (1,2)");
    }

    public static function getJobDetailByID($id)
    {
        return self::select(["Job_ID", "Job_Title", "Number_People", "Company_Name", "Company_Logo", "Job_Level", "Job_Experience", "Wage_To", "Wage_From", "Job_Type_Title", "Job_Description", "Job_Required", "Job_Interest", "Required_Gender", "specializes.Name", "Job_Limit", "Job_Address", "provinces.Province_Name", "Job_Created_At"])->leftJoin("employers", "jobs.Employer_ID", "=", "employers.Employer_ID")
            ->leftJoin("specializes", "specializes.Specialize_ID", "=", "jobs.Specialize_ID")
            ->leftJoin("provinces", "provinces.Province_ID", "=", "jobs.Job_Province")->where("Job_ID", $id)->first();
    }

    public function employer()
    {
        return $this->belongsTo("App\Model\Employer", "Employer_ID");
    }

    public function specialize()
    {
        return $this->belongsTo("App\Model\Specialize", "Specialize_ID");
    }

    public function province()
    {
        return $this->belongsTo("App\Model\Province", "Job_Province");
    }

    public static function getStaticByID($id, $time)
    {
        return self::select(DB::raw("COUNT(IF(`Job_Status`= 4 AND `Package_Post_Expire` > {$time},`Job_ID`,null)) as `Active`,COUNT(IF(`Job_Status`= 4 AND `Package_Post_Expire` < {$time},`Job_ID`,null)) as `Expire`, COUNT(IF(`Job_Status`= 0,`Job_ID`,null)) as `Draft`,COUNT(IF(`Job_Status`= 1 OR `Job_Status`=2,`Job_ID`,null)) as `Confirm`,COUNT(IF(`Job_Status`= 3,`Job_ID`,null)) as `Deny`  ,COUNT(IF(`Job_Status`=-1,`Job_ID`,null)) as `Hidden`"))
            ->where("Employer_ID", $id)
            ->first();
    }

    public static function getJobsByID($sql)
    {
        // return self::select(DB::raw("`Job_Status`,`Job_ID`,`Job_Created_At`,`jobs`.`Job_Title`,`employers`.`Company_Name`,`effect_packages`.`Package_Name` as `Package_Effect` ,`post_packages`.`Package_Name` as `Package_Post`  LEFT JOIN `employers` ON `jobs`.`Employer_ID` = `employers`.`Employer_ID` LEFT JOIN `employer_packages` as `Employer_Post_Packages` ON `Employer_Post_Packages`.`ID`= `jobs`.`Package_Post_Buy` LEFT JOIN `packages` as `post_packages` ON `post_packages`.`Package_ID`=`employer_post_packages`.`Package_ID` LEFT JOIN `employer_packages` as `employer_effect_packages` ON `jobs`.`Package_Effect_Buy`=`employer_effect_packages`.`ID` LEFT JOIN `packages` as `effect_packages` ON `effect_packages`.`Package_ID`=`employer_effect_packages`.`Package_ID`"))->get();
        return self::select(DB::raw("`Job_Status`,`Job_ID`,`Job_Created_At`,`jobs`.`Job_Title`,`effect_packages`.`Package_Name` as `Package_Effect` ,`post_packages`.`Package_Name` as `Package_Post`,Package_Post_Expire,Job_Created_At,Job_Slug,jobs.Ip as Ip"))
            ->leftJoin("employers", "jobs.Employer_ID", "=", "employers.Employer_ID")
            ->leftJoin("employer_packages as Employer_Post_Packages", "Employer_Post_Packages.ID", "=", "jobs.Package_Post_Buy")
            ->leftJoin("packages as post_packages", "post_packages.Package_ID", "=", "employer_post_packages.Package_ID")
            ->leftJoin("employer_packages as employer_effect_packages", "jobs.Package_Effect_Buy", "=", "employer_effect_packages.ID")
            ->leftJoin("packages as effect_packages", "effect_packages.Package_ID", "=", "employer_effect_packages.Package_ID")
            ->whereRaw($sql)
            ->paginate(15);
    }

    public static function getJobServiceModel($package)
    {
        return self::select(DB::raw("`Job_Status`,`Company_Logo`,`Company_Name`,`Wage_To`,`Wage_From`,`Job_Slug`,`Job_ID`,`Job_Created_At`,`jobs`.`Job_Title`, employer_effect_packages.Package_ID as Effect, Province_Name "))
            ->leftJoin("employers", "jobs.Employer_ID", "=", "employers.Employer_ID")
            ->leftJoin("provinces", "provinces.Province_ID", "=", "jobs.Job_Province")
            ->leftJoin("specializes", "specializes.Specialize_ID", "=", "jobs.Specialize_ID")
            ->leftJoin("employer_packages as Employer_Post_Packages", "Employer_Post_Packages.ID", "=", "jobs.Package_Post_Buy")
            ->leftJoin("employer_packages as employer_effect_packages", "jobs.Package_Effect_Buy", "=", "employer_effect_packages.ID")
            ->where([["Employer_Post_Packages.Package_ID", $package], ["Package_Post_Expire", ">", time()], ["Job_Status", 4]])
            ->inRandomOrder()
            ->get();
    }

    public static function getJobTypeModel($type)
    {
        return self::select(DB::raw("`Job_Status`,`Company_Logo`,`Company_Name`,`Wage_To`,`Wage_From`,`Job_Slug`,`Job_ID`,`Job_Created_At`,`jobs`.`Job_Title`, employer_effect_packages.Package_ID as Effect, Province_Name "))
            ->leftJoin("employers", "jobs.Employer_ID", "=", "employers.Employer_ID")
            ->leftJoin("provinces", "provinces.Province_ID", "=", "jobs.Job_Province")
            ->leftJoin("specializes", "specializes.Specialize_ID", "=", "jobs.Specialize_ID")
            ->leftJoin("employer_packages as Employer_Post_Packages", "Employer_Post_Packages.ID", "=", "jobs.Package_Post_Buy")
            ->leftJoin("employer_packages as employer_effect_packages", "jobs.Package_Effect_Buy", "=", "employer_effect_packages.ID")
            ->where([["jobs.Job_Type", $type], ["Package_Post_Expire", ">", time()], ["Job_Status", 4]])
            ->inRandomOrder()
            ->get();
    }

    public static function getJobBySlugModel($slug)
    {
        return self::select(["Company_Slug", "Job_Slug", "Job_ID", "Job_Title", "jobs.Specialize_ID", "Job_Level_Title", "Job_Level_Title", "Number_People", "Job_Experience_Title", "Wage_To", "Wage_From", "Job_Type_Title", "Job_Description", "Job_Required", "Job_Interest", "Required_Gender", "Job_Limit", "Job_Created_At", "Province_Name", "Job_Limit", "Company_Logo", "Company_Name", "Job_Address"])
            ->leftJoin("employers", "jobs.Employer_ID", "=", "employers.Employer_ID")
            ->leftJoin("provinces", "provinces.Province_ID", "=", "jobs.Specialize_ID")
            ->where([["Job_Slug", $slug], ["Package_Post_Expire", ">", time()], ["Job_Status", 4]])
            ->first();
    }

    public static function getJobsSameBySpecialize($specialize, $id)
    {

        return self::select(DB::raw("`Company_Logo`,`Company_Name`,`Job_Slug`,`Job_ID`,`Job_Created_At`,`jobs`.`Job_Title`,`Province_Name`"))
            ->leftJoin("employers", "jobs.Employer_ID", "=", "employers.Employer_ID")
            ->leftJoin("provinces", "provinces.Province_ID", "=", "jobs.Specialize_ID")
            ->where([["jobs.Job_Province", $specialize], ["Package_Post_Expire", ">", time()], ["Job_Status", 4], ["Job_ID", "<>", $id]])
            ->limit(3)
            ->inRandomOrder()
            ->get();
    }

    /**
     * 
     * 
     */
    public static  function getJobsByWhereRawModel($where)
    {
        return self::select(DB::raw("`Job_Status`,`Company_Logo`,`Company_Name`,`Wage_To`,`Wage_From`,`Job_Slug`,`Job_ID`,`Job_Created_At`,`jobs`.`Job_Title`, Province_Name "))
            ->leftJoin("employers", "jobs.Employer_ID", "=", "employers.Employer_ID")
            ->leftJoin("provinces", "provinces.Province_ID", "=", "jobs.Specialize_ID")
            ->leftJoin("specializes", "specializes.Specialize_ID", "=", "jobs.Specialize_ID")
            ->leftJoin("employer_packages", "employer_packages.ID", "=", "jobs.Package_Post_Buy")
            ->where([["Package_Post_Expire", ">", time()], ["Job_Status", 4]])
            ->whereRaw($where)
            ->inRandomOrder()
            ->paginate(10);
    }
}
