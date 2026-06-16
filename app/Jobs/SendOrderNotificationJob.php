<?php

namespace App\Jobs;

use App\Mail\NewOrderNotification;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class SendOrderNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 5;

    /**
     * 1m, 5m, 15m, 30m, 1h — Resend outages are usually transient.
     */
    public array $backoff = [60, 300, 900, 1800, 3600];

    public function __construct(public Order $order, public string $adminEmail)
    {
    }

    public function handle(): void
    {
        $this->order->loadMissing('items.product');

        $mailable = new NewOrderNotification($this->order);

        // Sent via the Resend HTTP API (not SMTP) since outbound SMTP ports
        // are blocked in production. Let failures throw so the queue worker
        // retries per $tries/$backoff instead of silently dropping the email.
        Http::withToken(config('services.resend.key'))
            ->post('https://api.resend.com/emails', [
                'from'    => config('mail.from.name') . ' <' . config('services.resend.from') . '>',
                'to'      => [$this->adminEmail],
                'subject' => $mailable->envelope()->subject,
                'html'    => $mailable->render(),
            ])
            ->throw();
    }

    public function failed(\Throwable $exception): void
    {
        report($exception);
    }
}
