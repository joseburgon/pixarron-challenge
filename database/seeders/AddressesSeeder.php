<?php

namespace Database\Seeders;

use App\Models\Address;
use Illuminate\Database\Seeder;

class AddressesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Address::factory()
            ->create([
                'user_id' => 1,
            ]);

        Address::factory()
            ->create([
                'user_id' => 1,
                'default' => true
            ]);

        Address::factory()
            ->create([
                'user_id' => 2,
            ]);

        Address::factory()
            ->create([
                'user_id' => 2,
                'default' => true
            ]);

        Address::factory()
            ->count(30)
            ->create();
    }
}
