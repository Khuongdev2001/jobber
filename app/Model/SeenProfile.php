<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SeenProfile extends Model
{
    const CREATED_AT = "Created_At";
    const UPDATED_AT = "Updated_At";
    public $table = "seen_profiles";
    public $fillable = ["ID", "Candidate_ID", "Employer_ID", "Created_At", "Updated_At"];
    public static function createOrUpdate($candidate, $employer)
    {
        return self::where([["Candidate_ID", $candidate], ["Employer_ID", $employer]])->first() ?: new self;
    }

    public static function getEmployerSeenByCandidateID($candidateID)
    {
        return self::select("Company_Logo", "Company_Name","Company_Slug")
            ->leftJoin("employers", "seen_profiles.Employer_ID", "=", "employers.Employer_ID")
            ->leftJoin("users", "employers.User_ID", "=", "users.User_ID")
            ->orderBy("seen_profiles.Created_At", "desc")
            ->where("Candidate_ID",$candidateID)
            ->limit(8)
            ->get();
    }
}
