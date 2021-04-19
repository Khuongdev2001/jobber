<?php

namespace App\Mail\Employer;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserForgetMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $subject;
    public $data;

    public function __construct($subject, $employer)
    {
        $this->subject = $subject;
        // đối với database với convert như này mới nhận 
        $this->data = [
            "User_Password_New" => PasswordRandom(),
            "Token" => $employer["Token"],
            "Fullname" => $employer["Fullname"],
            "User_Email" => $employer["User_Email"]
        ];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = $this->data;
        return $this->view('mail.employer.forgetUserMail', compact("data"))
            ->from("thuyshop2001@gmail.com")
            ->subject($this->subject);
    }
}
