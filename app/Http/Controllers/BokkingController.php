<?php

namespace App\Http\Controllers;

use App\Models\Bokking;
use App\Models\Comments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BokkingController extends Controller
{
    public function calculateTotalCost()
    {
        $bokkings = Bokking::all(); // Obtén todas las reservas
        $totalCost = $bokkings->sum('costo'); // Calcula el total del costo sumando la columna 'costo'
        return $totalCost;
    }    
    public function index()
    {
        $bokkings = Bokking::all();
        $totalCost = $this->calculateTotalCost();
        $totalPeople = $bokkings->sum('amount');
        $alimentacion = $totalPeople * 3;

        return view('bokkings', [
            'bokkings' => $bokkings,
            'totalCost' => $totalCost,
            'totalPeople' => $totalPeople,
            'alimentacion' => $alimentacion
        ]);
    }   
    public function showbokkings()
    {
        $user = Auth::user();
        $bokkings = Bokking::where('user_id', $user->id)->get();
    
        // Obtén los comentarios relacionados con las reservaciones
        $comments = Comments::whereIn('bokking_id', $bokkings->pluck('id'))->get();
    
        return view('showbokkingsuser', compact('bokkings', 'comments'));
    }
}
