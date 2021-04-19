<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class CandidateSave extends Model
{
    const CREATED_AT = "Created_At";
    const UPDATED_AT = "Updated_At";
    public $primaryKey = "ID";
    public $table = "candidate_saves";
    public $fillable = ["ID", "Candidate_ID", "Employer_ID", "Status", "Created_At", "Updated_At"];
    public static function updateOrCreate($candiateID, $employerID)
    {
        return self::where([["Candidate_ID", $candiateID], ["Employer_ID", $employerID]])->first() ?: new self;
    }

    public static function getCandidateSaveModel($whereRaw, $orderBy = "desc")
    {
        return self::leftJoin("candidates", "candidate_saves.Candidate_ID", "=", "candidates.Candidate_ID")
            ->leftJoin("users", "candidates.User_ID", "=", "users.User_ID")
            ->leftJoin("specializes", "Specializes.Specialize_ID", "=", "candidates.Specialize_ID")
            ->leftJoin("provinces", "candidates.Province_ID", "=", "provinces.Province_ID")
            ->select(["candidates.Candidate_ID", "Avatar", "Fullname", "Name", "Province_Name", "Experience", "candidate_saves.Created_At"])
            ->where([["Employer_ID", session("employer.Employer_ID")], ["candidate_saves.Status", 1]])
            ->whereRaw($whereRaw)
            ->orderBy("candidate_saves.Created_At", $orderBy)
            ->paginate(10);
    }
}
