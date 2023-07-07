<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Room;
use App\Models\User;
use App\Models\Bokking;
use Illuminate\Database\Seeder;
use Database\Seeders\FoodSeeder;
use Database\Seeders\RoomSeeder;
use Database\Seeders\BokkingsSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        /*Entrada de tablas*/
        $this->call(UserSeeder::class);        
        User::factory(100)->create();        
        $this->call(CategorySeeder::class);
        $this->call(ImageSeeder::class);
        $this->call(PaymenthSeeder::class);
        /*Entrada de datos logicos*/ 
        $this->call(BokkingsSeeder::class);
        $this->call(FoodSeeder::class);
        
    }
}
