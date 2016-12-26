<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdminRegister extends Mailable
{
    use Queueable, SerializesModels;

    protected $userDetails;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userDet)
    {
        $this->userDetails = $userDet;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.aregister',[
                                                'user'=>$this->userDetails['name'],
                                                'api_token'=>$this->userDetails['api_token'],
                                                'desc'=>$this->userDetails['description'],
                                                'userName'=>$this->userDetails['name'],
                                                'userEmail'=>$this->userDetails['email'],
                                                'userPhone'=>$this->userDetails['phone']
                                            ])
                    ->subject($this->userDetails['subject']);
    }
}
