<?php

namespace App\Jobs\candidate;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\Candidate\UserActiveMail;
use Illuminate\Support\Facades\Mail;

class UserActiveJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $subject;
    public $data;

    public function __construct($subject,$data)
    {
        $this->subject = $subject;
        $this->data = $data;
        $this->handle();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        return Mail::to($this->data["User_Email"])->send(new UserActiveMail($this->subject,$this->data));
    }
}
