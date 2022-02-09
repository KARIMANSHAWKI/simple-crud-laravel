<?php

namespace Tests\Feature\Mocking;

use App\Billing\PaymentGateway;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class PayOrderTest extends TestCase
{
    use RefreshDatabase, DatabaseMigrations;
    const MODEL = 'orders';


    /** @test */

    public function ItPayOrder()
    {
        $paymentGateway = $this->createMock(PaymentGateway::class);

        $paymentGateway->method('charge')->willReturn(100);


        $payload = ['amount' => 200];

        $response = $this->post(self::baseUrl . '/pay', $payload);
        dd($response->json());
        $response->assertStatus(200);
        $this->assertDatabaseHas(self::MODEL, $payload);
    }
}
