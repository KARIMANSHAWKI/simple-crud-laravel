<?php

namespace Tests\Feature\Product;

use App\Models\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteProductTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase;

    /** @test */
    public function  WillFailWithA404IfProductWeWantToDeleteIsNotFound()
    {
        $product = Product::factory()->create();

        $response = $this->delete(self::baseUrl . '/products/-1');

        $response->assertStatus(404);
    }

    /** @test  */
    public function CanUpdateAProduct()
    {
        $product = Product::factory()->create();

        $response = $this->delete(self::baseUrl . '/products/' . $product->id);

        $response->assertStatus(200)->assertSee(null);
    }
}
