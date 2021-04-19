<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class CandidateJobSave extends Model
{
    const CREATED_AT = "Created_At";
    const UPDATED_AT = "Updated_At";
    public $table = "job_saves";
    public $primaryKey = "ID";
    public $fillable = ["ID", "Candidate_ID", "Job_ID", "Status", "Created_At", "Updated_At"];
    // dùng new self gọi chính lớp đó
    public static function createOrUpdate($jobID, $candidateId)
    {
        $jobSaves = self::where([["Job_ID", $jobID], ["Candidate_ID", $candidateId]])->first();
        return $jobSaves ?: new self;
    }
    public static function getJobSavesByCandidateID($candidateId)
    {
        return self::select(["jobs.Job_ID","Job_Title","Job_Slug","Company_Name","Company_Logo","specializes.Name","jobs.Wage_From","jobs.Wage_To","job_saves.Created_At"])
            ->where([["Package_Post_Expire", ">", time()], ["jobs.Job_Status", "4"], ["job_saves.Status", 1], ["job_saves.Candidate_ID", $candidateId]])
            ->leftJoin("jobs", "jobs.Job_ID", "=", "job_saves.Job_ID")
            ->leftJoin("specializes", "specializes.Specialize_ID", "=" , "jobs.Specialize_ID")
            ->leftJoin("candidates", "candidates.Candidate_ID", "job_saves.Candidate_ID")
            ->leftJoin("employers","jobs.Employer_ID","=","employers.Employer_ID")
            ->paginate(10);
    }
}
