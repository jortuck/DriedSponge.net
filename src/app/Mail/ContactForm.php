<?php

namespace App\Mail;

use App\Models\ContactResponses;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use PhpParser\Node\Expr\Cast\Object_;

class ContactForm extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @param ContactResponses $data
     */
    public $data;

    public function __construct(ContactResponses $data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('no-reply@driedsponge.net','DriedSponge.net Contact Form - '.$this->data->Subject)
            ->replyTo($this->data->Email,$this->data->Name)
            ->view('email.contactform');
    }
}
