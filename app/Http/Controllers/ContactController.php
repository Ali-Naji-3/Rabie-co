<?php

namespace App\Http\Controllers;

use App\Mail\NewContactMessageNotification;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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

        $contact = Contact::create($validated);

        try {
            $adminEmail = config('mail.admin_contact_notification_email');
            if ($adminEmail) {
                // Deferred until after the HTTP response is sent, and sent via the Resend
                // HTTP API (not SMTP) since outbound SMTP ports are blocked in production.
                dispatch(function () use ($contact, $adminEmail) {
                    try {
                        $mailable = new NewContactMessageNotification($contact);

                        Http::withToken(config('services.resend.key'))
                            ->post('https://api.resend.com/emails', [
                                'from'    => config('mail.from.name') . ' <' . config('services.resend.from') . '>',
                                'to'      => [$adminEmail],
                                'subject' => $mailable->envelope()->subject,
                                'html'    => $mailable->render(),
                            ])
                            ->throw();
                    } catch (\Throwable $e) {
                        report($e);
                    }
                })->afterResponse();
            }
        } catch (\Throwable $e) {
            report($e);
        }

        return redirect()->back()->with('success', 'Thank you for contacting us! We will get back to you soon.');
    }
}
