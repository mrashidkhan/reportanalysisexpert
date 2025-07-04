<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;
use App\Models\Contact;

class ContactController extends Controller
{
    /**
     * Display the contact form
     */
    public function index()
    {
        return view('contact');
    }

    /**
     * Handle contact form submission
     */
    public function store(Request $request)
    {
        // Validate form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'contactmessage' => 'required|string|max:1000'
        ]);

        try {
            // Save contact to database
            // $contact = Contact::create($validatedData);

            // Send email
            Mail::to('muhammadrashidkhan800@gmail.com')->send(new ContactFormMail($validatedData));

            // Redirect back with success message
            return redirect()->back()->with('success', 'Thank you for your message! We will get back to you soon.');

        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Contact form error: ' . $e->getMessage());

            // Redirect back with error message
            return redirect()->back()->with('error', 'Sorry, there was an error sending your message. Please try again later.');
        }
    }

    /**
     * Display all contacts (for admin)
     */
    public function viewContacts()
    {
        $contacts = Contact::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.contacts.index', compact('contacts'));
    }

    /**
     * Show specific contact details
     */
    public function showContact($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->markAsRead(); // Mark as read when viewed
        return view('admin.contacts.show', compact('contact'));
    }

    /**
     * Mark contact as replied
     */
    public function markAsReplied($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->markAsReplied();

        return redirect()->back()->with('success', 'Contact marked as replied.');
    }

    /**
     * Delete contact
     */
    public function deleteContact($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->back()->with('success', 'Contact deleted successfully.');
    }
}
