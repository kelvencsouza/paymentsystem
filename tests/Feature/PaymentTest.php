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

        // Crie um produto para associar ao pagamento
        $product = Product::factory()->create();

        // Crie um pagamento
        $payment = Payment::create([
            'status' => 'paid',
            'method' => 'credit_card',
            'installment' => 3,
            'product_id' => $product->id,
            'coupon_discount' => 10.00,
            'short_id' => 'ABC123',
            'total_amount' => 100.00,
        ]);

        // Verifique se a notificação foi enviada
        Notification::assertSentTo(
            [$payment], PaymentNotification::class
        );
    }
}
