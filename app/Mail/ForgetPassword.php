<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use App\GlobalSetting as GS;
class ForgetPassword extends Mailable
{
    use Queueable, SerializesModels;

    protected $details;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        $subject = 'New Password for SDGINDIA';
        return $this->view('mail.forget',['user'=>$this->details['name'],'token'=>$this->details['token'],'desc'=>$this->details['description']])
                    ->subject($this->details['subject']);
    }
}
