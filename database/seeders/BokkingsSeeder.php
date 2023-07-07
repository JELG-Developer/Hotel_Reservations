<?php

namespace Database\Seeders;
use App\Models\Room;
use App\Models\Image;
use App\Models\Bokking;
use App\Models\Comments;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BokkingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bokkings = Bokking::factory(80)->create();        
        foreach($bokkings as $boking) {
            // Cada reservación se relaciona con comentarios
            Comments::factory(4)->create([
                'bokking_id' => $boking->id,
            ]);  
    

            
        }
    }
}
