<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ApplyJob extends Model
{
    const CREATED_AT = "Created_At";
    const UPDATED_AT = "Updated_At";
    public $table = "apply_jobs";
    public $primaryKey = "ID";
    public $fillable = ["Job_ID", "Apply_Status", "Candidate_ID", "Created_At", "Updated_At"];

    public static function getCandidateApply($jobID)
    {
        return self::select(["Avatar", "Fullname", "Name", "Job_ID", "candidates.Candidate_ID", "Experience", "apply_jobs.Created_At", "Province_Name", "Apply_Status", "User_Email", "apply_jobs.ID"])
            ->leftJoin("candidates", "apply_jobs.Candidate_ID", "=", "candidates.Candidate_ID")
            ->leftJoin("users", "users.User_ID", "=", "candidates.User_ID")
            ->leftJoin("specializes", "specializes.Specialize_ID", "=", "candidates.Specialize_ID")
            ->leftJoin("provinces", "provinces.Province_ID", "=", "candidates.Province_ID")
            ->where("Job_ID", $jobID)
            ->paginate(10);
    }

    // get để update confirm applyjob 
    public static function getCandidateApplyByID($jobID, $candidatID)
    {
        return self::select(["Job_Title", "Fullname", "User_Email", "users.User_ID", "Apply_Status","ID"])
            ->leftJoin("jobs", "jobs.Job_ID", "=", "apply_jobs.Job_ID")
            ->leftJoin("candidates", "candidates.Candidate_ID", "=", "apply_jobs.Candidate_ID")
            ->leftJoin("users", "candidates.User_ID", "=", "users.User_ID")
            ->where([["jobs.Job_ID", $jobID], ["candidates.Candidate_ID", $candidatID], ["Apply_Status", 0]])
            ->first();
    }

    public static function getStaticApply($jobID)
    {
        return self::selectRaw("COUNT(IF(Apply_Status=0,1,null)) as Confirm, COUNT(IF(Apply_Status=1,1,null)) as Agree ,COUNT(IF(Apply_Status=2,1,null)) as Deny")
            ->where("Job_ID", $jobID)
            ->first();
    }
}
