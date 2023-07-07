<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\Image;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $rooms = Room::factory(250)->create();
        
        foreach ($rooms as $room) {
            $image = new Image();
            $image->room_id = $room->id;

            switch ($room->name) {
                case 'Viaje Familiar':
                    $image->path = 'https://www.cataloniahotels.com/es/blog/wp-content/uploads/2015/05/habitaciones-familiares-catalonia.jpg';
                    break;
                case 'Premium':
                    $image->path = 'https://static.abc.es/media/summum/2018/11/23/suite-corinthia-kbvB--1200x630@abc.jpg';
                    break;
                case 'Reuniones y conferencias':
                    $image->path = 'https://d1vp8nomjxwyf1.cloudfront.net/wp-content/uploads/sites/44/2016/10/01130913/EXEC-608-2_small1.jpg';
                    break;
                case 'Viajeros':
                    $image->path = 'https://www.hotelportuense.com/wp-content/uploads/sites/41/2019/05/gallery_Triple-room.jpg';
                    break;
                case 'Relax y bien estar':
                    $image->path = 'https://www.hotelportuense.com/wp-content/uploads/sites/41/2019/05/gallery_Single-room10.jpg';
                    break;
                default:
                    $image->path = 'noimage.jpg';
                    break;
            }

            $image->save();
        }
    }
}