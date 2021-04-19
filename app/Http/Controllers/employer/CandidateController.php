<?php

namespace App\Http\Controllers\employer;

use App\Http\Controllers\Controller;
use App\Model\ApplyJob;
use App\Model\Candidate;
use App\model\CandidateSave;
use App\Model\Employer_Filter_Package;
use App\Model\Province;
use App\Model\SeenProfile;
use App\Model\Specialize;
use App\Jobs\employer\ConfirmApplyJobJob;
use App\Model\History;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    public function index(Request $request)
    {
        // kiểm tra nhà tuyển dụng có đăng ký gói lọc hồ sơ
        $totalFilter = Employer_Filter_Package::where("Employer_ID", session("employer.Employer_ID"))->sum("Total");
        if (!$totalFilter) {
            return redirect()->back()->with("error", ["title" => "Thông báo", "message" => "Bạn không đủ điểm lọc hồ sơ"]);
        }
        $whereRaw = " Fullname LIKE '%{$request->search}%'";
        if ($request->Specialize) {
            $whereRaw .= " AND candidates.Specialize_ID ='{$request->Specialize}' ";
        }
        if ($request->Experience) {
            $whereRaw .= " AND candidates.Experience = '{$request->Experience}'";
        }
        if ($request->Province) {
            $whereRaw .= " AND candidates.Province_ID = '{$request->Province}'";
        }
        $specializes = Specialize::select("Name", "Specialize_ID")->get();
        $provinces = Province::select("Province_Name", "Province_ID")->get();
        $candidates = Candidate::getCandidateModel($whereRaw);
        return view("employer.candidate.index", compact("candidates", "specializes", "provinces"));
    }

    public function editCandidateSave($candidate_ID, $status)
    {
        $candidate = Candidate::find($candidate_ID)->count();
        if (!$candidate) {
            abort(404);
        };
        $messages = [
            0 => "Xóa thành công ứng viên vào hồ sơ đã lưu",
            1 => "Thêm thành công ứng viên vào hồ sơ đã lưu",
        ];
        $candidateSave = CandidateSave::updateOrCreate($candidate_ID, session("employer.Employer_ID"));
        $candidateSave->Candidate_ID = $candidate_ID;
        $candidateSave->Employer_ID = session("employer.Employer_ID");
        $candidateSave->Status = $status;
        $candidateSave->save();
        return redirect()->back()->with("success", ["title" => "Thông báo", "message" => $messages[$status]]);
    }

    public function candidateSave(Request $request)
    {
        $where = "Fullname LIKE '%{$request->search}%'";
        $orders = ["asc", "desc"];
        $candidates = CandidateSave::getCandidateSaveModel($where, $orders[$request->Created_At] ?? "asc");
        return view("employer.candidate.candidateSave", compact("candidates"));
    }

    public function candidateInfo($id)
    {
        // get candidate by id
        $candidate = Candidate::getCandidateFilterByID($id);
        if (!$candidate) {
            abort(404);
        };
        // kiểm tra nhà tuyển dụng có từng xem hay không
        $seenCandidate = SeenProfile::createOrUpdate($candidate->Candidate_ID, session("employer.Employer_ID"));
        if ($seenCandidate->Candidate_ID) {
            return view("employer.candidate.info", compact("candidate"));
        }
        // get total filter
        $totalFilter = Employer_Filter_Package::where("Employer_ID", session("employer.Employer_ID"))->first();
        $convertMark = [
            0 => 1,
            1 => 5,
            2 => 10,
            6 => 20
        ];
        // số điểm trừ
        $mark = $convertMark[$candidate->Experience] ?? $convertMark[0];
        if (intval($totalFilter->Total) < $mark) {
            return redirect()->back()->with("error", ["title" => "Thông báo", "message" => "Bạn chưa đủ điểm theo quy định"]);
        };
        // trừ điểm
        $totalFilter->Total -= $mark;
        $totalFilter->save();
        // lưu profile seen
        $seenCandidate->Employer_ID = session("employer.Employer_ID");
        $seenCandidate->Candidate_ID = $candidate->Candidate_ID;
        $seenCandidate->save();
        return view("employer.candidate.info", compact("candidate"));
    }

    public function candidateApply($id)
    {
        $candidates = ApplyJob::getCandidateApply($id);
        if (!$candidates->total()) {
            abort(404);
        }
        $static = ApplyJob::getStaticApply($id);
        return view("employer.candidate.apply", compact("candidates", "static"));
    }

    public function editCandidateApply($jobId, $candidateID, $status)
    {
        $applyJob = ApplyJob::getCandidateApplyByID($jobId, $candidateID);
        if (!$applyJob) {
            abort(404);
        };
        $messages = [
            1 => "{$applyJob["Fullname"]} ơi nhà tuyển dụng đã đồng ý với công việc {$applyJob["User_Email"]}",
            2 => "{$applyJob["Fullname"]} ơi rất tiếc nhà tuyển dụng từ chối với công việc {$applyJob["User_Email"]}"
        ];
        $applyJob->Apply_Status = $status;
        $applyJob->save();
        History::create([
            "History_Content" => $messages[$status],
            "User_ID" => $applyJob["User_ID"]
        ]);
        $applyJob["status"] = $status;
        dispatch(new ConfirmApplyJobJob($applyJob));
        return redirect()->back()->with("success", ["title" => "Thông báo", "message" => "Thực hiện thao tác thành công"]);
    }
}
