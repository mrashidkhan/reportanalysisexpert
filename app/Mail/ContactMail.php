<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contactData;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $contactData)
    {
        $this->contactData = $contactData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->view('emails.contact')
                      ->subject($this->contactData['subject'] ?? 'Medical Report Submission - Report Analysis Expert')
                      ->with('contactData', $this->contactData);

        // Attach files if they exist
        if (isset($this->contactData['file_attachments']) && is_array($this->contactData['file_attachments'])) {
            foreach ($this->contactData['file_attachments'] as $attachment) {
                if (file_exists($attachment['path'])) {
                    $email->attach($attachment['path'], [
                        'as' => $attachment['name'],
                        'mime' => $attachment['mime']
                    ]);
                }
            }
        }

        return $email;
    }
}
