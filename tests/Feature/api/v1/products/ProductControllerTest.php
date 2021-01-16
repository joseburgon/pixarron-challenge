<?php

namespace Tests\Feature\api\v1\products;

use App\Models\Address;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_fetch_all_products()
    {
        $this->withoutExceptionHandling();

        $adminRole = Role::create(['name' => 'admin']);

        $adminUser = User::factory()->create()->assignRole($adminRole);

        Passport::actingAs($adminUser, ['create-servers']);

        $product1 = Product::factory()->create();

        $product2 = Product::factory()->create();

        $product3 = Product::factory()->create();

        $response = $this->getJson(route('api.v1.products.index'));

        $response->assertJson([
            'data' => [
                [
                    'type' => 'products',
                    'id' => (string) $product1->getRouteKey(),
                    'attributes' => [
                        'name' => $product1->name,
                        'slug' => $product1->slug,
                        'details' => $product1->details,
                        'price' => $product1->price,
                        'description' => $product1->description,
                    ],
                    'links' => [
                        'self' => route('api.v1.products.show', $product1)
                    ]
                ],
                [
                    'type' => 'products',
                    'id' => (string) $product2->getRouteKey(),
                    'attributes' => [
                        'name' => $product2->name,
                        'slug' => $product2->slug,
                        'details' => $product2->details,
                        'price' => $product2->price,
                        'description' => $product2->description,
                    ],
                    'links' => [
                        'self' => route('api.v1.products.show', $product2)
                    ]
                ],
                [
                    'type' => 'products',
                    'id' => (string) $product3->getRouteKey(),
                    'attributes' => [
                        'name' => $product3->name,
                        'slug' => $product3->slug,
                        'details' => $product3->details,
                        'price' => $product3->price,
                        'description' => $product3->description,
                    ],
                    'links' => [
                        'self' => route('api.v1.products.show', $product3)
                    ]
                ],
            ],
        ]);
    }
}
