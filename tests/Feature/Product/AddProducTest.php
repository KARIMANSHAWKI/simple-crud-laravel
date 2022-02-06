<?php

namespace Tests\Feature\Product;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;

class AddProducTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase;

    const MODEL = 'products';
    
    /** @test */
    public function CanCreateProduct(){


        $payload = Product::factory()->make()->toArray();

        $response = $this->post(self::baseUrl . '/products', $payload);

        \Log::info($response->getContent());

        $response->assertJsonStructure([
            "success",
            "data" => [
                'id', 'name', 'category_id', 'slug', 'created_at'
            ]
        ])->assertStatus(200);

        $this->assertDatabaseHas(self::MODEL, $payload);

    }

    /** @test  */
    public function ProductRequireAttributeName(){
        $payload = Product::factory()->raw(['name' => '']);
        $response = $this->post(self::baseUrl . '/products', $payload);
        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function  ProductRequireAttributeCategoryId(){
        $payload = Product::factory()->raw(['category_id' => '']);
        $response = $this->post(self::baseUrl . '/products', $payload);
        $response->assertSessionHasErrors('category_id');
    }

    /** @test */
    public function  ProductHasUniqueAttributeSlug(){
        $payload = Product::factory()->create()->toArray();
        $response = $this->post(self::baseUrl . '/products', $payload);
        $response->assertSessionHasErrors('slug');
    }
}
