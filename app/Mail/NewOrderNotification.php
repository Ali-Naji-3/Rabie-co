<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewOrderNotification extends Mailable
{
    use Queueable, SerializesModels;

    public array $shipping;
    public array $billing;
    public bool $billingDiffers;

    public function __construct(public Order $order)
    {
        $this->shipping = json_decode($order->shipping_address, true) ?? [];
        $this->billing  = json_decode($order->billing_address, true) ?? [];

        $this->billingDiffers =
            ($this->billing['address'] ?? '') !== ($this->shipping['address'] ?? '')
            || ($this->billing['city']    ?? '') !== ($this->shipping['city']    ?? '')
            || ($this->billing['country'] ?? '') !== ($this->shipping['country'] ?? '');
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Order: ' . $this->order->order_number,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.new-order-notification',
        );
    }
}
