<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'nullable|string',
        ]);

        // Create a new contact record
        $contact = Contact::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'subject' => $request->input('subject'),
            'message' => $request->input('message'),
        ]);

        // Retrieve the created contact instance
        $contact = Contact::find($contact->id);

        // Send the email
        Mail::to($contact->email)->send(new ContactMail($contact));

        Mail::to("muhammadrashidkhan800@gmail.com")->send(new ContactMail($contact));
        return redirect()->route('contactus', ['#sentmessage'])->with('sentmessage', 'Your message has been sent successfully!');

    }
}
