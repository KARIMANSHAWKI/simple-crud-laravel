<?php

namespace Tests\Feature\Product;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UpdateProductTest extends TestCase
{
    const MODEL = 'products';

    use DatabaseMigrations, RefreshDatabase;

    /** @test */
    public function  WillFailWithA404IfProductWeWantToUpdateIsNotFound()
    {
        Sanctum::actingAs(User::factory()->create());

        $product = Product::factory()->create();

        $payload = Product::factory()->make()->toArray();

        $response = $this->put(self::baseUrl . '/products/-1', $payload);

        $response->assertStatus(404);
    }

    /** @test */
    public function CanUpdateAProduct()
    {
        Sanctum::actingAs(User::factory()->create());

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
        Sanctum::actingAs(User::factory()->create());

        $product = Product::factory()->create();
        $payload = Product::factory()->raw(['name' => '']);
        $response = $this->put(self::baseUrl . '/products/' . $product->id, $payload);
        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function  UpdateProductRequireAttributeCategoryId(){
        Sanctum::actingAs(User::factory()->create());

        $product = Product::factory()->create();
        $payload = Product::factory()->raw(['category_id' => '']);
        $response = $this->put(self::baseUrl . '/products/' . $product->id, $payload);
        $response->assertSessionHasErrors('category_id');
    }
}
