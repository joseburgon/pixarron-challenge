<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $client1 = User::find(1);
        $client2 = User::find(2);

        Order::factory()
            ->count(3)
            ->create([
                'user_id' => $client1->id
            ]);

        Order::factory()
            ->count(2)
            ->create([
                'user_id' => $client2->id
            ]);

        Order::factory()
            ->count(30)
            ->create();
    }
}
