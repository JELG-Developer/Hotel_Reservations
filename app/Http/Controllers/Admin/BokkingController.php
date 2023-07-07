<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bokking;
use App\Models\User;
use App\Models\Room;
use App\Models\Paymenth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class BokkingController extends Controller
{
    public function index()
    {
        $bokkings = Bokking::paginate(6);
        return view('admin.bokkings.index', compact('bokkings'));
    }

    public function create()
    {
        $users = User::all();
        $rooms = Room::all();
        $paymenths = Paymenth::all();
        return view('admin.bokkings.create', compact('users', 'rooms', 'paymenths'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'entry' => 'required|date',
            'departure' => 'required|date',
            'amount' => 'required|integer',
            'user_id' => 'required|exists:users,id',
            'room_id' => 'required|exists:rooms,id',
            'costo' => 'required|integer',
            'paymenth_id' => 'required|exists:paymenths,id',
        ]);

        $bokking = new Bokking();
        $bokking->entry = $request->entry;
        $bokking->departure = $request->departure;
        $bokking->amount = $request->amount;
        $bokking->user_id = $request->user_id;
        $bokking->room_id = $request->room_id;
        $bokking->costo = $request->costo;
        $bokking->paymenth_id = $request->paymenth_id;
        $bokking->save();

        return redirect()->route('admin.bokkings.index');
    }

    public function edit(Bokking $bokking)
    {
        $users = User::all();
        $rooms = Room::all();
        $paymenths = Paymenth::all();
        return view('admin.bokkings.edit', compact('bokking', 'users', 'rooms', 'paymenths'));
    }

    public function update(Request $request, Bokking $bokking)
    {
        $request->validate([
            'entry' => 'required|date',
            'departure' => 'required|date',
            'amount' => 'required|integer',
            'user_id' => 'required|exists:users,id',
            'room_id' => 'required|exists:rooms,id',
            'costo' => 'required|integer',
            'paymenth_id' => 'required|exists:paymenths,id',
        ]);

        $bokking->entry = $request->entry;
        $bokking->departure = $request->departure;
        $bokking->amount = $request->amount;
        $bokking->user_id = $request->user_id;
        $bokking->room_id = $request->room_id;
        $bokking->costo = $request->costo;
        $bokking->paymenth_id = $request->paymenth_id;
        $bokking->save();

        return redirect()->route('admin.bokkings.index');
    }

    public function destroy(Bokking $bokking)
    {
        $bokking->delete();

        return redirect()->route('admin.bokkings.index');
    }
}
