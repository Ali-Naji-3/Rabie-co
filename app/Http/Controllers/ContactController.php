<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display the contact form.
     */
    public function index()
    {
        return view('contact');
    }

    /**
     * Store a new contact message.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'subject' => 'nullable|in:order_inquiry,product_question,shipping_issue,return_refund,general_question,complaint,partnership_business',
            'message' => 'required|string|min:4|max:1000',
        ]);

        // Set default subject if not provided
        if (empty($validated['subject'])) {
            $validated['subject'] = 'order_inquiry';
        }

        Contact::create($validated);

        return redirect()->back()->with('success', 'Thank you for contacting us! We will get back to you soon.');
    }
}
