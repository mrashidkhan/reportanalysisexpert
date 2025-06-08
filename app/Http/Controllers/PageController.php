<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controller;

class PageController extends Controller
{
    public function index()
    {
        $current_view_name = 'index';
        return view('pages.index', ['current_view_name' => $current_view_name]);
    }

    public function aboutus()
    {
        $current_view_name = 'aboutus';
        return view('pages.aboutus', ['current_view_name' => $current_view_name]);
    }

    public function departments()
    {
        $current_view_name = 'departments';
        return view('pages.departments', ['current_view_name' => $current_view_name]);
    }

    public function doctors()
    {
        $current_view_name = 'doctors';
        return view('pages.doctors', ['current_view_name' => $current_view_name]);
    }



    public function contactus()
    {
        $current_view_name = 'contact';
        return view('pages.contactus', ['current_view_name' => $current_view_name]);
    }

    public function reportsupload()
    {
        $current_view_name = 'reportsupload';
        return view('pages.reportsupload', ['current_view_name' => $current_view_name]);
    }

    public function testimonials()
    {
        $current_view_name = 'testimonials';
        return view('pages.testimonials', ['current_view_name' => $current_view_name]);
    }

    public function sendEmail(Request $request)
    {
        $message_name = $request->input('message_name');
        $message_email = $request->input('message_email');
        $message_contactno = $request->input('message_contactno');
        $message = $request->input('message');

        $email_subject = "GALAXY MARINE Application message from $message_name";
        $email_body = "Name: $message_name\nEmail: $message_email\nContact Number: $message_contactno\nMessage: $message";

        $recipient_email = 'mrashid@molabsmedia.com';

        Mail::raw($email_body, function ($message) use ($email_subject, $message_email, $recipient_email) {
            $message->from($message_email)
                    ->to($recipient_email)
                    ->subject($email_subject);
        });

        return Redirect::to('/')->with('info', 'Thank you! We will get back to you as soon as possible.');
    }

    public function newsletterSignup(Request $request)
    {
        $newsletter_email = $request->input('newsletter_email');

        $validator = Validator::make(['email' => $newsletter_email], [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return Redirect::to('/')->with('error', 'Please enter a valid email address.');
        }

        $email_subject = "GALAXY MARINE Application message for Newsletter Signup from $newsletter_email";
        $email_body = "Newsletter Signup request from\nEmail: $newsletter_email\n";
        $recipient_email = 'mrashid@molabsmedia.com';

        Mail::raw($email_body, function ($message) use ($email_subject, $newsletter_email, $recipient_email) {
            $message->from($newsletter_email)
                    ->to($recipient_email)
                    ->subject($email_subject);
        });

        return Redirect::to('/')->with('info', 'Thank you for subscribing. Processing your newsletter subscription.');
    }

    public function subscribe(Request $request)
{
    // Validate the email address
    $validator = Validator::make($request->all(), [
        'email' => 'required|email',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Prepare the email data
    $email = $request->input('email');
    $recipient_email = 'mrashid2000@gmail.com';
    $email_subject = "New Subscription from {$email}";
    $email_body = "You have a new subscriber: {$email}";

    // Send the email
    Mail::raw($email_body, function ($message) use ($email, $email_subject, $recipient_email) {
        $message->from($email);
        $message->to($recipient_email);
        $message->subject($email_subject);
    });

    // Flash a success message to the session
    $request->session()->flash('info', 'Thank you for subscribing! You will receive exclusive offers.');

    // Redirect back to the form
    return redirect()->back();
}
}

