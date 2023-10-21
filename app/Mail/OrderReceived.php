<?php

namespace App\Mail;

use App\Models\AcademicLevel;
use App\Models\Currency;
use App\Models\Discount;
use App\Models\Order;
use App\Models\Rate;
use App\Models\ReferencingStyle;
use App\Models\ServiceType;
use App\Models\Spacing;
use App\Models\Subject;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Inertia\Inertia;

class OrderReceived extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public Order $order;

    public string $level;
    public string $subjectType;
    public string $service;
    public string $discount;
    public string $discountAmount;
    public string $deadline;
    public string $spacing;
    public string $style;
    public string $currency;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
        $this->user = User::query()
            ->where('id', '=', $order->user_id)
            ->pluck('name')
            ->first();
        $this->style = ReferencingStyle::query()
            ->where('id', '=', $order->referencing_style_id)
            ->pluck('name')->first();
        $this->level = AcademicLevel::query()
            ->where('id', '=', $order->academic_level_id)
            ->pluck('name')->first();
        $this->service = ServiceType::query()
            ->where('id', '=', $order->service_type_id)
            ->pluck('name')->first();
        $this->subjectType = Subject::query()
            ->where('id', '=', $order->subject_id)
            ->pluck('name')->first();
        $this->spacing = Spacing::query()
            ->where('id', '=', $order->spacing_id)
            ->pluck('name')->first();
        $this->deadline = Carbon::create($order->due_date)->diffForHumans(parts: 2);
        $this->discount = Discount::query()
            ->where('id', '=', $order->discount_id)
            ->pluck('code')->first() ?? '';
        $this->discountAmount = Discount::query()
            ->where('id', '=', $order->discount_id)
            ->pluck('rate')->first() ?? '';
        $this->currency = Currency::query()
            ->where('id', '=', $order->currency_id)
            ->pluck('symbol')->first();
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Order #'.$this->order->id.' Received.',
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
            view: 'emails.order-emails.order-placed'
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
