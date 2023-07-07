<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::paginate(5);
        return view('admin.rooms.index', compact('rooms'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.rooms.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable|min:10|max:500',
            'price' => 'required|integer',
            'number' => 'required',
            'status' => 'required|in:disponible,ocupada,limpieza,mantenimiento',
            'ubication' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        $room = new Room();
        $room->name = $request->name;
        $room->description = $request->description;
        $room->price = $request->price;
        $room->number = $request->number;
        $room->status = $request->status;
        $room->ubication = $request->ubication;
        $room->category_id = $request->category_id;
        $room->save();

        return redirect()->route('admin.rooms.index');
    }

    public function edit(Room $room)
    {
        $categories = Category::all();

        return view('admin.rooms.edit', compact('room', 'categories'));
    }

    public function update(Request $request, Room $room)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable|min:10|max:500',
            'price' => 'required|integer',
            'number' => 'required',
            'status' => 'required|in:disponible,ocupada,limpieza,mantenimiento',
            'ubication' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        $room->name = $request->name;
        $room->description = $request->description;
        $room->price = $request->price;
        $room->number = $request->number;
        $room->status = $request->status;
        $room->ubication = $request->ubication;
        $room->category_id = $request->category_id;
        $room->save();

        return redirect()->route('admin.rooms.index');
    }

    public function destroy(Room $room)
    {
        $room->delete();

        return redirect()->route('admin.rooms.index');
    }
}
