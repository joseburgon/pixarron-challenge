<?php

namespace Tests\Feature\api\v1\orders;

use App\Models\Address;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;

class OrderControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_fetch_all_orders()
    {
        $this->withoutExceptionHandling();

        Passport::actingAs(
            User::factory()->make(),
            ['create-servers']
        );

        $user1 = User::factory()->create();
        Address::factory()->create(['user_id' => $user1->id]);

        $order1 = Order::factory()->create([
            'user_id' => $user1->id,
            'user_address_id' => $user1->addresses()->first()->id
        ]);

        $user2 = User::factory()->create();
        Address::factory()->create(['user_id' => $user2->id]);

        $order2 = Order::factory()->create([
            'user_id' => $user2->id,
            'user_address_id' => $user2->addresses()->first()->id
        ]);

        $user3 = User::factory()->create();
        Address::factory()->create(['user_id' => $user3->id]);

        $order3 = Order::factory()->create([
            'user_id' => $user3->id,
            'user_address_id' => $user3->addresses()->first()->id
        ]);

        $response = $this->getJson(route('api.v1.orders.index'));

        $response->assertJson([
            'data' => [
                [
                    'type' => 'orders',
                    'id' => (string) $order1->id,
                    'attributes' => [
                        'user_id' => (string) $order1->user_id,
                        'user_address_id' => (string) $order1->user_address_id,
                        'payment_gateway' => $order1->payment_gateway,
                        'shipped' => (boolean) $order1->shipped,
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
                    'id' => (string) $order2->id,
                    'attributes' => [
                        'user_id' => (string) $order2->user_id,
                        'user_address_id' => $order2->user_address_id,
                        'payment_gateway' => $order2->payment_gateway,
                        'shipped' => (boolean) $order2->shipped,
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
                    'id' => (string) $order3->id,
                    'attributes' => [
                        'user_id' => (string) $order3->user_id,
                        'user_address_id' => $order3->user_address_id,
                        'payment_gateway' => $order3->payment_gateway,
                        'shipped' => (boolean) $order3->shipped,
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
