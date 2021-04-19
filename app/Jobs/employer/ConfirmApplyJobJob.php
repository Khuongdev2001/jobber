<?php

namespace App\Jobs\employer;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\Employer\ConfirmApplyJobMail;


class ConfirmApplyJobJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $subject;
    public $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->subject = __("mail.employer.job.apply.subject", ["Job_Title" => $data["Job_Title"]]);
        $this->data = [
            "User_Email" => $data["User_Email"],
            "notification" => __("mail.employer.job.apply.message.{$data["status"]}", ["Fullname" => $data["Fullname"]])
        ];
        $this->handle();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->data["User_Email"])->send(new ConfirmApplyJobMail($this->subject, $this->data));
    }
}
