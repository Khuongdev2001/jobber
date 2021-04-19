<?php

namespace App\Mail\Employer;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmApplyJobMail extends Mailable
{
    use Queueable, SerializesModels;

     // không được đặt proferti from ở đây
     public $subject;
     public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject,$data)
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
        $data=$this->data;
        return $this->view('mail.employer.confirmApplyMail',compact("data"))
            ->from("thuyshop2001@gmail.com")
            ->subject($this->subject);
    }
}
