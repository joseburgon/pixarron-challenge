<?php

namespace Tests\Feature\api\v1\users;

use App\Http\Resources\AddressResource;
use App\Http\Resources\OrderResource;
use App\Models\Address;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_fetch_all_users()
    {
        $this->withoutExceptionHandling();

        Passport::actingAs(
            User::factory()->make(),
            ['create-servers']
        );

        $user1 = User::factory()->create();
        Address::factory()->create(['user_id' => $user1->id]);

        $user2 = User::factory()->create();
        Address::factory()->create(['user_id' => $user2->id]);

        $user3 = User::factory()->create();
        Address::factory()->create(['user_id' => $user3->id]);

        $response = $this->getJson(route('api.v1.users.index'));

        $response->assertJson([
            'data' => [
                [
                    'type' => 'users',
                    'id' => (string) $user1->getRouteKey(),
                    'attributes' => [
                        'name' => $user1->name,
                        'email' => $user1->email,
                    ],
                    'relationships' => [
                        'addresses' => [],
                    ],
                    'links' => [
                        'self' => route('api.v1.users.show', $user1)
                    ]
                ],
                [
                    'type' => 'users',
                    'id' => (string) $user2->getRouteKey(),
                    'attributes' => [
                        'name' => $user2->name,
                        'email' => $user2->email,
                    ],
                    'relationships' => [
                        'addresses' => [],
                    ],
                    'links' => [
                        'self' => route('api.v1.users.show', $user2)
                    ]
                ],
                [
                    'type' => 'users',
                    'id' => (string) $user3->getRouteKey(),
                    'attributes' => [
                        'name' => $user3->name,
                        'email' => $user3->email,
                    ],
                    'relationships' => [
                        'addresses' => [],
                    ],
                    'links' => [
                        'self' => route('api.v1.users.show', $user3)
                    ]
                ],
            ],
        ]);
    }

    /** @test */
    public function can_fetch_user_data()
    {
        $this->withoutExceptionHandling();

        Passport::actingAs(
            User::factory()->create(),
            ['create-servers']
        );

        $user = User::factory()->create();

        $response = $this->getJson(route('api.v1.users.show', $user));

        $response->assertJson([
           'data' => [
               'type' => 'users',
               'id' => (string) $user->getRouteKey(),
               'attributes' => [
                   'name' => $user->name,
                   'email' => $user->email,
               ],
               'links' => [
                   'self' => route('api.v1.users.show', $user)
               ]
           ]
        ]);
    }
}
