<?php

namespace App\Mail\Candidate;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApplyJobMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    // không được đặt proferti from ở đây
    public $subject;
    public $data;

    public function __construct($subject, $data)
    {
        $this->subject = $subject;
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = $this->data;
        return $this->view('mail/candidate/ApplyJobMail', compact("data"))
            ->from("thuyshop2001@gmail.com")
            ->subject($this->subject);
    }
}
