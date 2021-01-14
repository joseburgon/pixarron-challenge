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

        Order::create([
           'user_id' => $client1->id,
           'user_address_id' => $client1->addresses()->first()->id,
            'shipped' => array_rand([true, false])
        ]);

        Order::create([
            'user_id' => $client1->id,
            'user_address_id' => $client1->addresses()->first()->id,
            'shipped' => array_rand([true, false])
        ]);

        Order::create([
            'user_id' => $client2->id,
            'user_address_id' => $client2->addresses()->first()->id,
            'shipped' => array_rand([true, false])
        ]);

        Order::create([
            'user_id' => $client2->id,
            'user_address_id' => $client2->addresses()->first()->id,
            'shipped' => array_rand([true, false])
        ]);
    }
}
