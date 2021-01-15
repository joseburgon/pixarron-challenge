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
            ->count(2)
            ->create([
                'user_id' => 1
            ]);

        Address::factory()
            ->count(2)
            ->create([
                'user_id' => 2
            ]);
    }
}
