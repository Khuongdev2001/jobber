<?php

namespace App\Jobs\candidate;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\Candidate\ApplyJobMail;

class ApplyJobJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $subject;
    public $data;
    public function __construct($data)
    {
        // Fullname của ứng viên
        // User_Email của nhà tuyển dụng
        $fullnameCandidate = session("candidate.Fullname");
        $this->subject = __("mail.candidate.job.apply.subject", ["Fullname" => $fullnameCandidate]);
        $this->data = [
            "Job_Title" => $data->Job_Title,
            "Fullname" => $fullnameCandidate,
            "User_Email" =>"khuongmy1@gmail.com" ?: $data->employer->user->User_Email
        ];
        //
        $this->handle();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        return Mail::to($this->data["User_Email"])->send(new ApplyJobMail($this->subject, $this->data));
    }
}
