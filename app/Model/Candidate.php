<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    public $table = "candidates";
    public $primaryKey = "Candidate_ID";
    public $timestamps = false;
    public $fillable = ["Candidate_ID", "User_ID", "Cover", "Specialize_ID", "Province_ID", "Is_Notification_Job", "Is_Notification_Post", "Address", "Marriage", "Experience", "Wage_From", "Wage_To", "Is_Hidden", "Description"];

    public function user()
    {
        return $this->belongsTo("App\Model\User", "User_ID");
    }

    public function province()
    {
        return $this->belongsTo("App\Model\Province", "Province_ID");
    }

    public function specialize()
    {
        return $this->belongsTo("App\Model\Specialize", "Specialize_ID");
    }

    public function cvs()
    {
        return $this->hasMany("App\Model\Cv", "Candidate_ID");
    }

    public function getCvDefault()
    {
        // điểu kiện where
        return $this->hasMany("App\Model\Cv", "Candidate_ID")->whereIsDefault(1);
    }

    public static function getCandidateByID($id)
    {
        return self::leftJoin("users", "users.User_ID", "=", "candidates.User_ID")->select(["users.User_ID", "User_Email", "users.Fullname as Fullname", "Avatar", "Gender", "Phone", "Birthday", "Cover", "Specialize_ID", "Province_ID", "Is_Notification_Job", "Is_Notification_Post", "Address", "Marriage", "Experience", "Wage_From", "Wage_To", "Is_Hidden", "Description", "candidates.Candidate_ID"])->where("candidates.Candidate_ID", $id)->first();
    }

    public static function getCandidateFilterByID($id)
    {
        return self::leftJoin("users", "users.User_ID", "=", "candidates.User_ID")->select(["users.User_ID", "User_Email", "users.Fullname as Fullname", "Avatar", "Gender", "Phone", "Birthday", "Address", "Experience", "Wage_From", "Wage_To", "Description", "candidates.Candidate_ID", "Name", "Province_Name"])->where("candidates.Candidate_ID", $id)
            ->leftJoin("specializes", "candidates.Specialize_ID", "=", "specializes.Specialize_ID")
            ->leftJoin("provinces", "candidates.Province_ID", "=", "provinces.Province_ID")
            ->first();
    }

    public static function getCandidateModel($whereRaw)
    {
        return self::select("Fullname", "specializes.Name", "Wage_From", "Wage_To", "Province_Name", "Avatar", "candidates.Candidate_ID")
            ->leftJoin("users", "users.User_ID", "=", "candidates.User_ID")
            ->leftJoin("specializes", "candidates.Specialize_ID", "=", "specializes.Specialize_ID")
            ->leftJoin("provinces", "candidates.Province_ID", "=", "provinces.Province_ID")
            ->whereRaw($whereRaw)
            ->paginate(4);
    }
}
