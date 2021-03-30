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
}
