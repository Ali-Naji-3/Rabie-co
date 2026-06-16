<?php

namespace Tests\Feature;

use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class AdminContactNotificationTest extends TestCase
{
    use RefreshDatabase;

    private function contactPayload(array $overrides = []): array
    {
        return array_merge([
            'first_name' => 'Jane',
            'last_name'  => 'Doe',
            'phone'      => '0501234567',
            'subject'    => 'product_question',
            'message'    => 'Do you have this in size M?',
        ], $overrides);
    }

    public function test_admin_notification_is_sent_on_contact_submission(): void
    {
        Http::fake(['api.resend.com/*' => Http::response(['id' => 'test-id'], 200)]);
        config(['mail.admin_contact_notification_email' => 'admin@example.com']);

        $this->post(route('contact.store'), $this->contactPayload());

        Http::assertSent(function (Request $request) {
            return $request->url() === 'https://api.resend.com/emails'
                && $request['to'] === ['admin@example.com'];
        });
    }

    public function test_notification_contains_message_details(): void
    {
        Http::fake(['api.resend.com/*' => Http::response(['id' => 'test-id'], 200)]);
        config(['mail.admin_contact_notification_email' => 'admin@example.com']);

        $this->post(route('contact.store'), $this->contactPayload());

        $contact = Contact::first();

        Http::assertSent(function (Request $request) use ($contact) {
            $html = $request['html'];
            return str_contains($html, 'Jane Doe')
                && str_contains($html, '0501234567')
                && str_contains($html, 'Do you have this in size M?')
                && str_contains($html, $contact->subject_label);
        });
    }

    public function test_no_notification_sent_when_admin_email_not_configured(): void
    {
        Http::fake();
        config(['mail.admin_contact_notification_email' => null]);

        $this->post(route('contact.store'), $this->contactPayload());

        Http::assertNothingSent();
        $this->assertDatabaseCount('contacts', 1);
    }

    public function test_contact_form_succeeds_even_when_mail_sending_fails(): void
    {
        Http::fake(['api.resend.com/*' => Http::response(['message' => 'server error'], 500)]);
        config(['mail.admin_contact_notification_email' => 'admin@example.com']);

        $response = $this->post(route('contact.store'), $this->contactPayload());

        $this->assertDatabaseCount('contacts', 1);
        $response->assertRedirect();
        $response->assertSessionHas('success');
    }
}
