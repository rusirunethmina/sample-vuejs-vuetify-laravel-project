<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrganizationWelcome extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The registration instance.
     *
     * @var $organization
     */
    public $organization;


    /**
     * Create a new message instance.
     *
     * @param $organization
     */
    public function __construct($organization){
        $this->organization = $organization;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){
        return $this->markdown('emails.organization.welcome');
    }
}
