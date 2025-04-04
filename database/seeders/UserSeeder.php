<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $user =  User::create([
            'name' => 'admin',
            'email' => 'admin@testing.com',
            'password' => Hash::make('admin'),
        ]);

       // wallet
        Wallet::create([
            'user_id' => $user->id,
            'balance' => 0,
        ]);

        // Dummy Users
//        User::factory()->count(10)->create();

    }
}
