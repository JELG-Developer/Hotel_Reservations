<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Administrador
        $user = new User();
        $user->name = 'Jose Limachi';
        $user->phone = fake()->e164PhoneNumber();
        $user->identity_card = fake()->numerify('#######');
        $user->email = 'admin@email.com';
        $user->password = '123';
        $user->user_type = 'admin';
        $user->email_verified_at = now();      
        $user->save();

        $user = new User();
        $user->name = 'Jose Limachi';
        $user->phone = fake()->e164PhoneNumber();
        $user->identity_card = fake()->numerify('#######');
        $user->email = 'guest@email.com';
        $user->password = '123';
        $user->user_type = 'public';
        $user->email_verified_at = now();      
        $user->save();

    }
}
