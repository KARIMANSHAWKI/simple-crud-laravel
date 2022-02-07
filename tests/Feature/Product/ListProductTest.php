<?php

namespace Tests\Feature\Product;

use App\Models\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListProductTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase;

    /** @test */
    public function CanReturnACollectionOfPaginatedProducts()
    {
        $products = Product::factory(3)->create();
        $response = $this->get(self::baseUrl . '/products');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'name', 'slug', 'category_id', 'created_at']
                ],
            ]);
        $this->assertCount(3, $products);
    }
}
