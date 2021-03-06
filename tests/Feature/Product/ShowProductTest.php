<?php

namespace Tests\Feature\Product;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ShowProductTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase;

    const MODEL = 'products';

    /** @test */
    public function CanReturnProduct(){
        Sanctum::actingAs(User::factory()->create());

        $product = Product::factory()->create();


        $response = $this->get(self::baseUrl . '/products/'. $product->id);
        $response->assertExactJson([
            "success" => true,
            "data" => [
                'id'=> $product->id,
                'name' => $product->name,
                'category_id' => $product->category_id,
                'slug' => $product->slug,
                'created_at' => (string) $product->created_at
            ]
        ])->assertStatus(200);
    }


    /** @test */
    public function WillFailWithA404IfProductIsNotFound()
    {
        Sanctum::actingAs(User::factory()->create());

        $response = $this->get(self::baseUrl . '/products/-1');
        \Log::info($response->getContent());

        $response->assertStatus(404);
    }
}
