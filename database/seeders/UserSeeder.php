<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::factory()->create([
            'name' => 'Poe',
            'email' => 'poe@gmail.com',
            'password' => Hash::make('asdffdsa'),
        ]);
        User::factory(8)->create();

        User::factory()->create([
            'name' => 'Hein Htet Zaw',
            'email' => 'hhz@gmail.com',
            'password' => Hash::make('asdffdsa'),
            'role' => "admin",
        ]);
        User::factory()->create([
            'name' => 'Aye Min Tun',
            'email' => 'amt@gmail.com',
            'password' => Hash::make('asdffdsa'),
            'role' => "admin",
        ]);
    }
}
