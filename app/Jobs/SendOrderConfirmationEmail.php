<?php

namespace App\Jobs;

use App\Models\Order;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendOrderConfirmationEmail implements ShouldQueue
{
    use Queueable;

    public int $tries = 3;
    public int $timeout = 30;

    public function __construct(
        public int $orderId,
        public string $toEmail
    ) {
    }

    public function handle(): void
    {
        $order = Order::find($this->orderId);
        if (!$order) {
            Log::warning('Order confirmation email skipped; order not found.', [
                'order_id' => $this->orderId,
            ]);

            return;
        }

        Mail::raw(
            "Your order has been placed successfully.\n\nOrder Number: {$order->order_number}\nItems: {$order->total_items}\nTotal: $".number_format((float) $order->total_amount, 2)."\nDate: ".optional($order->ordered_at)->toDateTimeString(),
            function ($message) use ($order): void {
                $message->to($this->toEmail)->subject('Order Confirmation - '.$order->order_number);
            }
        );
    }

    public function failed(\Throwable $exception): void
    {
        Log::error('Order confirmation email job failed.', [
            'order_id' => $this->orderId,
            'to_email' => $this->toEmail,
            'error' => $exception->getMessage(),
        ]);
    }
}
