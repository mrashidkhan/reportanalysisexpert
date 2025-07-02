<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\MedicalReport;
use Illuminate\Support\Facades\Storage;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $report;

    // public $medicalReport;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(MedicalReport $report)
    {
        $this->report = $report;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('emails.contact')
        //             ->subject($this->contactData['subject'] ?? 'Email from Report Analysis Expert website')
        //             ->with('contactData', $this->contactData);

        $email = $this->subject('Your Medical Report - ' . $this->report->getReportTypeNameAttribute())
                      ->view('emails.contact');
        // Attach files dynamically
        foreach ($this->report->file_paths ?? [] as $filePath) {
            if (Storage::exists($filePath)) {
                $email->attach(Storage::path($filePath));
            }
        }
        return $email;
    }
}
