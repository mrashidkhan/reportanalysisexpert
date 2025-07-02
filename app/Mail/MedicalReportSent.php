<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MedicalReportSent extends Mailable
{
    use Queueable, SerializesModels;
    public $data; // You can pass data to the view
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
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
        return $this->view('emails.your_view') // Specify the view for the email
                       ->with(['data' => $this->data]); // Pass data to the view
    }
}
