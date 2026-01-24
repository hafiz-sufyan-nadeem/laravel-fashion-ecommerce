<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderStatusUpdatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $adminMessage;

    public function __construct($order, $adminMessage = null)
    {
        $this->order = $order;
        $this->adminMessage = $adminMessage;
    }

    public function build()
    {
        return $this->subject('Update on Your Order #' . $this->order->id)
            ->view('emails.order_status_updated');
    }
}
Error
