<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Client One',
            'email' => 'client1@test.com',
            'password' => 'pixarron2021',
        ])->assignRole('client');

        User::create([
            'name' => 'Client Two',
            'email' => 'client2@test.com',
            'password' => 'pixarron2021',
        ])->assignRole('client');

        User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => 'pixarron2021',
        ])->assignRole('admin');

        User::factory()->count(30)->create();

        $usersWithoutRole = User::doesntHave('roles')->get();

        foreach ($usersWithoutRole as $user) {

            $user->assignRole('client');

        }

    }
}
