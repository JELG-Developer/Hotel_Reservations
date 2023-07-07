<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Room;
use App\Models\Image;
use App\Models\Bokking;
use App\Models\Comments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('rooms');
    }

    public function show()
    {
        $images = Image::whereHas('room', function ($query) {
            $query->where('status', 'disponible');
        })->paginate(30);
        $comments = Comments::where('status', 'visible')->paginate(6);
        return view('index', compact('comments', 'images'));
    }

    public function rooms(Image $image)
    {
        return view('show', compact('image'));
    }

    public function saveBokking(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'entry' => 'required|date',
            'departure' => 'required|date|after:entry',
            'amount' => 'required|integer|min:1',
            'room_id' => 'required|exists:rooms,id',
            'paymenth_id' => 'required',
        ]);

        $room = Room::findOrFail($validatedData['room_id']);

        $entryDate = Carbon::parse($validatedData['entry']);
        $departureDate = Carbon::parse($validatedData['departure']);
        $totalDays = $departureDate->diffInDays($entryDate);

        $totalPrice = $room->price * $totalDays * $validatedData['amount'];

        if (Auth::check()) {
            $validatedData['user_id'] = Auth::user()->id;
        }

        $booking = Bokking::create([
            'user_id' => $validatedData['user_id'],
            'entry' => $validatedData['entry'],
            'departure' => $validatedData['departure'],
            'amount' => $validatedData['amount'],
            'room_id' => $validatedData['room_id'],
            'costo' => $totalPrice,
            'paymenth_id' => $validatedData['paymenth_id'],
        ]);

        return redirect()->route('bokking.details', $booking->id)->with('success', 'La reserva se ha guardado exitosamente.');
    }

    public function bokkingDetails($id)
    {
        $bokking = Bokking::findOrFail($id);
        return view('bokking', compact('bokking'));
    }

    public function addCommentToBokking(Request $request, $id)
    {
        $validatedData = $request->validate([
            'comment' => 'required|string',
        ]);

        $bokking = Bokking::findOrFail($id);

        $comment = Comments::create([
            'bokking_id' => $bokking->id,
            'comment' => $validatedData['comment'],
        ]);
        return redirect()->route('index')->with('success', 'El comentario se ha guardado exitosamente.');
    }
}


