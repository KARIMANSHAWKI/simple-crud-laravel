<?php

namespace Tests\Feature\Mocking;

use App\Mail\TestMail;
use Illuminate\Support\Facades\Bus;
use App\Billing\PaymentGateway;
use App\Hello\HelloFacade;
use App\Jobs\SendMail;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;
use Mockery\MockInterface;


class PayOrderTest extends TestCase
{
    use RefreshDatabase, DatabaseMigrations;
    const MODEL = 'orders';


    /** @test */

    public function ItPayOrder()
    {
/*        $this->instance(
            PaymentGateway::class,
            Mockery::mock(PaymentGateway::class, function (MockInterface $mock) {
                $mock->shouldReceive('charge')->once()->andReturn(100);
            })
        );*/

       /* $this->mock(Service::class, function (MockInterface $mock) {
            $mock->shouldReceive('process')->once();
        });*/

   /*     $amount = 100;
        $this->mock(PaymentGateway::class, function (MockInterface $mock) use ($amount) {
            $mock->shouldReceive('charge')->andReturn(['amount' => $amount]);
        });*/

        $amount = 100;
        $payCharge = $this->createMock(PaymentGateway::class)->method('charge')->with($amount)->willReturn(['amount' => $amount]);

        $payload = ['amount' => 200];



        $response = $this->post(self::baseUrl . '/pay', $payload);
        dd($response->json());
        $response->assertStatus(200);
        $this->assertDatabaseHas(self::MODEL, $payload);
    }


    /** @test */
    public function ItMockFacade()
    {
//dd(HelloFacade::)
//        HelloFacade::spy()
        HelloFacade::shouldReceive('sayHello')
            ->with('karmen1')
            ->andReturn('Hello youssef');

        $respone= $this->get( self::baseUrl . '/hello');
        dd( $respone->getContent());
        //$this->assertEquals('Hello karmen', $respone->getContent());

    }
    
    /** @test */
    public function ItMockJob()
    {
        $this->withoutExceptionHandling();
        Bus::fake();
        $response = $this->get(self::baseUrl . '/send-mail');
    }
    public function testSendMailJob()
    {
        Bus::fake();
        $order = ['email' => 'ex@gmail.com'];
        dispatch(new SendMail($order));
        Bus::assertDispatched(SendMail::class);
    }

}
