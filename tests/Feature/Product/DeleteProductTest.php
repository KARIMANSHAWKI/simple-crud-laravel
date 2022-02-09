<?php

namespace Tests\Feature\Product;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class DeleteProductTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase;

    const MODEL = 'products';


    /** @test */
    public function  WillFailWithA404IfProductWeWantToDeleteIsNotFound()
    {
        Sanctum::actingAs(User::factory()->create());

        $product = Product::factory()->create();

        $response = $this->delete(self::baseUrl . '/products/-1');

        $response->assertStatus(404);
    }

    /** @test  */
    public function CanUpdateAProduct()
    {
        Sanctum::actingAs(User::factory()->create());

        $product = Product::factory()->create();

        $response = $this->delete(self::baseUrl . '/products/' . $product->id);

        $response->assertStatus(200)->assertSee(null);

        $this->assertDatabaseMissing(self::MODEL, ['id' => $product->id]);
    }
}
