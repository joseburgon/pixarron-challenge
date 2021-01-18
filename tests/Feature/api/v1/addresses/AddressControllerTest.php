<?php

namespace Tests\Feature\api\v1\addresses;

use App\Models\Address;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class AddressControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_fetch_all_addresses()
    {
        $this->withoutExceptionHandling();

        $adminRole = Role::create(['name' => 'admin']);

        $adminUser = User::factory()->create()->assignRole($adminRole);

        Passport::actingAs($adminUser, ['create-servers']);

        $user1 = User::factory()->create();

        $address1 = Address::factory()->create([
            'user_id' => $user1->id
        ]);


        $user2 = User::factory()->create();

        $address2 = Address::factory()->create([
            'user_id' => $user2->id,
        ]);

        $user3 = User::factory()->create();

        $address3 = Address::factory()->create([
            'user_id' => $user3->id,
        ]);

        $response = $this->getJson(route('api.v1.addresses.index'));

        $response->assertJson([
            'data' => [
                [
                    'type' => 'addresses',
                    'id' => (string) $address1->id,
                    'attributes' => [
                        'user_id' => (string) $address1->user_id,
                        'default' => (boolean) $address1->default,
                        'street' => $address1->street,
                        'city' => $address1->city,
                        'state' => $address1->state,
                        'country' => $address1->country,
                    ],
                    'relationships' => [
                        'user' => [],
                    ],
                    'links' => [
                        'self' => route('api.v1.addresses.show', $address1)
                    ]
                ],
                [
                    'type' => 'addresses',
                    'id' => (string) $address2->id,
                    'attributes' => [
                        'user_id' => (string) $address2->user_id,
                        'default' => (boolean) $address2->default,
                        'street' => $address2->street,
                        'city' => $address2->city,
                        'state' => $address2->state,
                        'country' => $address2->country,
                    ],
                    'relationships' => [
                        'user' => [],
                    ],
                    'links' => [
                        'self' => route('api.v1.addresses.show', $address2)
                    ]
                ],
                [
                    'type' => 'addresses',
                    'id' => (string) $address3->id,
                    'attributes' => [
                        'user_id' => (string) $address3->user_id,
                        'default' => (boolean) $address3->default,
                        'street' => $address3->street,
                        'city' => $address3->city,
                        'state' => $address3->state,
                        'country' => $address3->country,
                    ],
                    'relationships' => [
                        'user' => [],
                    ],
                    'links' => [
                        'self' => route('api.v1.addresses.show', $address3)
                    ]
                ],
            ],
        ]);
    }

}
