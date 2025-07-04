<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $email;
    public $phone;
    public $contactmessage;

    /**
     * Create a new message instance.
     */
    public function __construct($contactData)
{
    $this->name = (string) $contactData['name'];
    $this->email = (string) $contactData['email'];
    $this->phone = (string) $contactData['phone']; 
    $this->contactmessage = (string) $contactData['contactmessage'];
}

    /**
     * Build the message.
     */
    public function build()
{
    return $this->view('emails.contact-form')
                ->subject('New Contact Form Submission')
                ->with([
                    'name' => $this->name,
                    'email' => $this->email,
                    'phone' => $this->phone,
                    'contactmessage' => $this->contactmessage
                ]);
}
}
