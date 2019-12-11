<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailable extends Mailable
{
    use Queueable, SerializesModels;
    public $name;
	public $email;
	public $otp;
	public $UserID;
	public $validity;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $email, $otp, $UserID, $validity)
    {
        $this->name = $name;
		$this->email=$email;
		$this->otp=$otp;
		$this->UserID=$UserID;
		$this->validity=$validity;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.name');
    }
}
