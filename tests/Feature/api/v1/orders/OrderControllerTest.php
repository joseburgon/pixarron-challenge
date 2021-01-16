<?php

namespace Tests\Feature\api\v1\orders;

use App\Models\Address;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class OrderControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_fetch_all_orders()
    {
        $this->withoutExceptionHandling();

        $adminRole = Role::create(['name' => 'admin']);

        $adminUser = User::factory()->create()->assignRole($adminRole);

        Passport::actingAs($adminUser, ['create-servers']);

        $user1 = User::factory()
            ->has(Address::factory()->count(1))
            ->create();

        $order1 = Order::factory()->create([
            'user_id' => $user1->id
        ]);


        $user2 = User::factory()
            ->has(Address::factory()->count(1))
            ->create();

        $order2 = Order::factory()->create([
            'user_id' => $user2->id,
        ]);

        $user3 = User::factory()
            ->has(Address::factory()->count(1))
            ->create();

        $order3 = Order::factory()->create([
            'user_id' => $user3->id,
        ]);

        $response = $this->getJson(route('api.v1.orders.index'));

        $response->assertJson([
            'data' => [
                [
                    'type' => 'orders',
                    'id' => (string)$order1->id,
                    'attributes' => [
                        'user_id' => (string)$order1->user_id,
                        'payment_gateway' => $order1->payment_gateway,
                        'shipped' => (boolean)$order1->shipped,
                        'error' => $order1->error,
                        'created_at' => Carbon::parse($order1->created_at)->format(DATE_RFC2822),
                        'updated_at' => Carbon::parse($order1->updated_at)->format(DATE_RFC2822),
                    ],
                    'relationships' => [
                        'user' => [],
                    ],
                    'links' => [
                        'self' => route('api.v1.orders.show', $order1)
                    ]
                ],
                [
                    'type' => 'orders',
                    'id' => (string)$order2->id,
                    'attributes' => [
                        'user_id' => (string)$order2->user_id,
                        'user_address_id' => $order2->user_address_id,
                        'payment_gateway' => $order2->payment_gateway,
                        'shipped' => (boolean)$order2->shipped,
                        'error' => $order2->error,
                        'created_at' => Carbon::parse($order2->created_at)->format(DATE_RFC2822),
                        'updated_at' => Carbon::parse($order2->updated_at)->format(DATE_RFC2822),
                    ],
                    'relationships' => [
                        'user' => [],
                    ],
                    'links' => [
                        'self' => route('api.v1.orders.show', $order2)
                    ]
                ],
                [
                    'type' => 'orders',
                    'id' => (string)$order3->id,
                    'attributes' => [
                        'user_id' => (string)$order3->user_id,
                        'user_address_id' => $order3->user_address_id,
                        'payment_gateway' => $order3->payment_gateway,
                        'shipped' => (boolean)$order3->shipped,
                        'error' => $order3->error,
                        'created_at' => Carbon::parse($order3->created_at)->format(DATE_RFC2822),
                        'updated_at' => Carbon::parse($order3->updated_at)->format(DATE_RFC2822),
                    ],
                    'relationships' => [
                        'user' => [],
                    ],
                    'links' => [
                        'self' => route('api.v1.orders.show', $order3)
                    ]
                ],
            ],
        ]);
    }

}
