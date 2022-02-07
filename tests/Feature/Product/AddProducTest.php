<?php

namespace Tests\Feature\Product;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;
use App\Models\Product;
use App\Models\User;

class AddProducTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase;

    const MODEL = 'products';
    
    /** @test */
    public function CanCreateProduct(){
        Sanctum::actingAs(User::factory()->create());

        $payload = Product::factory()->make()->toArray();
        $response = $this->post(self::baseUrl . '/products', $payload);
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
        $this->withoutExceptionHandling();
        Sanctum::actingAs(User::factory()->create());

        $payload = Product::factory()->raw(['name' => '']);
        $response = $this->post(self::baseUrl . '/products', $payload);
        $response->assertJson('kk')->assertStatus(422);
    }

    /** @test */
    public function  ProductRequireAttributeCategoryId(){
        Sanctum::actingAs(User::factory()->create());

        $payload = Product::factory()->raw(['category_id' => '']);
        $response = $this->post(self::baseUrl . '/products', $payload);
        $response->assertSessionHasErrors('category_id');
    }

    /** @test */
    public function  ProductHasUniqueAttributeSlug(){
        Sanctum::actingAs(User::factory()->create());

        $payload = Product::factory()->create()->toArray();
        $response = $this->post(self::baseUrl . '/products', $payload);
        $response->assertSessionHasErrors('slug');
    }
}
