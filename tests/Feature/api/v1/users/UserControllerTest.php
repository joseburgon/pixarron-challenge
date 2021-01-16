<?php

namespace Tests\Feature\api\v1\users;

use App\Http\Resources\AddressResource;
use App\Http\Resources\OrderResource;
use App\Models\Address;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_fetch_all_users()
    {
        $this->withoutExceptionHandling();

        $adminRole = Role::create(['name' => 'admin']);

        $adminUser = User::factory()->create()->assignRole($adminRole);

        Passport::actingAs($adminUser, ['create-servers']);

        $clientUser1 = User::factory()->create();
        Address::factory()->create(['user_id' => $clientUser1->id]);

        $clientUser2 = User::factory()->create();
        Address::factory()->create(['user_id' => $clientUser2->id]);

        $clientUser3 = User::factory()->create();
        Address::factory()->create(['user_id' => $clientUser3->id]);

        $response = $this->getJson(route('api.v1.users.index'));

        $response->assertJson([
            'data' => [
                [
                    'type' => 'users',
                    'id' => (string) $adminUser->getRouteKey(),
                    'attributes' => [
                        'name' => $adminUser->name,
                        'email' => $adminUser->email,
                    ],
                    'relationships' => [
                        'addresses' => [],
                    ],
                    'links' => [
                        'self' => route('api.v1.users.show', $adminUser)
                    ]
                ],
                [
                    'type' => 'users',
                    'id' => (string) $clientUser1->getRouteKey(),
                    'attributes' => [
                        'name' => $clientUser1->name,
                        'email' => $clientUser1->email,
                    ],
                    'relationships' => [
                        'addresses' => [],
                    ],
                    'links' => [
                        'self' => route('api.v1.users.show', $clientUser1)
                    ]
                ],
                [
                    'type' => 'users',
                    'id' => (string) $clientUser2->getRouteKey(),
                    'attributes' => [
                        'name' => $clientUser2->name,
                        'email' => $clientUser2->email,
                    ],
                    'relationships' => [
                        'addresses' => [],
                    ],
                    'links' => [
                        'self' => route('api.v1.users.show', $clientUser2)
                    ]
                ],
                [
                    'type' => 'users',
                    'id' => (string) $clientUser3->getRouteKey(),
                    'attributes' => [
                        'name' => $clientUser3->name,
                        'email' => $clientUser3->email,
                    ],
                    'relationships' => [
                        'addresses' => [],
                    ],
                    'links' => [
                        'self' => route('api.v1.users.show', $clientUser3)
                    ]
                ],
            ],
        ]);
    }

    /** @test */
    public function can_fetch_user_data()
    {
        $this->withoutExceptionHandling();

        $clientRole = Role::create(['name' => 'client']);

        $clientUser = User::factory()->create()->assignRole($clientRole);

        Passport::actingAs($clientUser, ['create-servers']);

        $response = $this->getJson(route('api.v1.users.show', $clientUser));

        $response->assertJson([
           'data' => [
               'type' => 'users',
               'id' => (string) $clientUser->getRouteKey(),
               'attributes' => [
                   'name' => $clientUser->name,
                   'email' => $clientUser->email,
               ],
               'relationships' => [
                   'addresses' => [],
                   'orders' => [],
               ],
               'links' => [
                   'self' => route('api.v1.users.show', $clientUser)
               ]
           ]
        ]);
    }
}
