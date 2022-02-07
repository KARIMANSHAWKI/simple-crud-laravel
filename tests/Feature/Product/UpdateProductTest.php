<?php

namespace Tests\Feature\Product;

use App\Models\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateProductTest extends TestCase
{
    const MODEL = 'products';

    use DatabaseMigrations, RefreshDatabase;

    /** @test */
    public function  WillFailWithA404IfProductWeWantToUpdateIsNotFound()
    {
        $product = Product::factory()->create();

        $payload = Product::factory()->make()->toArray();

        $response = $this->put(self::baseUrl . '/products/-1', $payload);

        $response->assertStatus(404);
    }

    /** @test */
    public function CanUpdateAProduct()
    {
        $product = Product::factory()->create();

        $payload = Product::factory()->make()->toArray();

        $response = $this->put(self::baseUrl . '/products/' . $product->id, $payload);

        $response->assertJsonStructure([
            "success",
            "data" => [
                'id', 'name', 'category_id', 'slug', 'created_at'
            ]
        ])->assertStatus(200);

        $this->assertDatabaseHas(self::MODEL, $payload);
    }

    /** @test  */
    public function UpdateProductRequireAttributeName(){
        $product = Product::factory()->create();
        $payload = Product::factory()->raw(['name' => '']);
        $response = $this->put(self::baseUrl . '/products/' . $product->id, $payload);
        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function  UpdateProductRequireAttributeCategoryId(){
        $product = Product::factory()->create();
        $payload = Product::factory()->raw(['category_id' => '']);
        $response = $this->put(self::baseUrl . '/products/' . $product->id, $payload);
        $response->assertSessionHasErrors('category_id');
    }
}
