<?php

namespace App\Mail;

use App\Models\Currency;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PaymentSuccess extends Mailable
{
    use Queueable, SerializesModels;

    public $orderId;
    public $transactionId;
    public $currencySymbol;
    public $amount;
    public $date;
    public $username;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        // initialize properties
        $this->date = $data['date'];
        $this->orderId = $data['orderId'];
        $this->transactionId = $data['transactionId'];
        $this->amount = $data['amount'];
        $this->currencySymbol = Currency::query()
            ->where('name', '=', $data['currencySymbol'])
            ->pluck('symbol')
            ->first();
        $this->username = $data['username'];
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Payment Success',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'emails.payments.payment-success',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
