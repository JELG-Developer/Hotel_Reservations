<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function roomslist()
    {
        $rooms = Room::all();
        return view('rooms', ['rooms' => $rooms]);
    }

}
