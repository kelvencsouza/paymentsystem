<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Support\Facades\Notification;
use App\Notifications\PaymentNotification;

class PaymentTest extends TestCase
{
    use RefreshDatabase;

    public function test_payment_triggers_notification()
    {
        Notification::fake();

        $product = Product::factory()->create();

        $payment = Payment::create([
            'status' => 'paid',
            'method' => 'credit_card',
            'installment' => 3,
            'product_id' => $product->id,
            'coupon_discount' => 10.00,
            'short_id' => 'ABC123',
            'total_amount' => 100.00,
        ]);

        Notification::assertSentTo(
            [$payment], PaymentNotification::class
        );
    }
}
