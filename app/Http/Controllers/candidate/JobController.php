<?php

namespace App\Http\Controllers\candidate;

use App\Http\Controllers\Controller;
use App\Model\Candidate;
use Illuminate\Http\Request;
use App\Model\Job;
use App\Model\CandidateJobSave;
use App\Jobs\candidate\ApplyJobJob;
use App\Model\ApplyJob;

class JobController extends Controller
{
    public function __construct()
    {
        $this->middleware(["CheckLoginCandidate"])->only(["jobSave", "editJobSave", "applyJob"]);
    }
    public function info($slug)
    {
        $job = Job::getJobBySlugModel($slug);
        if (!$job) {
            abort(404);
        }
        $setSearchMenu = true;
        // kiểm tả job đang mở  có được thêm vào công việc yêu thích không
        $Candidate_ID = session("candidate.Candidate_ID");
        $check = CandidateJobSave::createOrUpdate($job->Job_ID, $Candidate_ID);
        $checkApply = ApplyJob::where([["Job_ID", $job->Job_ID], ["Candidate_ID", $Candidate_ID]])->count();
        // param1 specialize và param2 not id
        $jobSames = Job::getJobsSameBySpecialize($job->Specialize_ID, $job->Job_ID);
        return view("candidate.job.info", compact("setSearchMenu", "job", "jobSames", "check", "checkApply"));
    }

    /**
     *  thực hiện các thao tác thêm công việc yêu thích hoạt xóa công việc yêu thích
     *  14-4-2021 12:44 AM
     */
    public function editJobSave($jobID, $status = 1)
    {
        // check Job exist
        if (!Job::find($jobID)) {
            abort(404);
        }
        $messages = [
            0 => "Xóa thành công job ",
            1 => "Thêm thành công job yêu thích"
        ];
        $jobSave = CandidateJobSave::createOrUpdate($jobID, session("candidate.Candidate_ID"));
        $jobSave->Candidate_ID = session("candidate.Candidate_ID");
        $jobSave->Job_ID = $jobID;
        $jobSave->Status = $status;
        $jobSave->save();
        return redirect()->back()->with("success", ["title" => "Thông báo", "message" => $messages[$status]]);
    }

    public function jobSave()
    {
        $jobSaves = CandidateJobSave::getJobSavesByCandidateID(session("candidate.Candidate_ID"));
        $setSearchMenu = true;
        return view("candidate.job.saveJobIndex", compact("setSearchMenu", "jobSaves"));
    }

    public function job(Request $request)
    {
        $where = "Job_Title LIKE '%{$request->Job_Title}%'";
        if ($request->Province_ID) {
            $where .= " AND Province_ID = '{$request->Province_ID}'";
        }
        if ($request->Specialize_ID) {
            $where .= " AND jobs.Specialize_ID ='{$request->Specialize_ID}'";
        }
        if ($request->Job_Type) {
            $where .= " AND jobs.Job_Type ='{$request->Job_Type}'";
        }
        if ($request->Job_Experience) {
            $where .= " AND jobs.Job_Experience = '{$request->Experience}'";
        }
        /**
         *  type là loại gói
         *  type2: loại công việc:234
         */
        if ($request->type) {
            $where .= " AND employer_packages.Package_ID = '{$request->type}'";
        }
        if ($request->type2) {
            $where .= " AND jobs.Job_Type = '{$request->type2}'";
        }
        $jobs = Job::getJobsByWhereRawModel($where);
        $setSearchMenu = true;
        return view("candidate.job.index", compact("jobs", "setSearchMenu"));
    }

    public function applyJob($id)
    {
        // get job By id
        $job = Job::select("Job_ID", "Employer_ID", "Job_Title")->find($id);
        if (!$job) {
            abort(404);
        }
        // kiểm tra user đã từng apply job này chưa
        $applyJob = ApplyJob::where([["Job_ID", $id], ["Candidate_ID", session("candidate.Candidate_ID")]])->first();
        if ($applyJob) {
            return redirect()->back()->with("error", ["title" => "Thông báo", "message" => "Bạn đã ứng tuyển công việc nay rồi"]);
        }
        ApplyJob::create(["Job_ID" => $id, "Candidate_ID" => session("candidate.Candidate_ID")]);
        dispatch(new ApplyJobJob($job));
        return redirect()->back()->with("success", ["title" => "Thông báo", "message" => "Bạn đã ứng tuyển thành công vui lòng đợi nhà tuyển dụng xác thực"]);
    }
}
