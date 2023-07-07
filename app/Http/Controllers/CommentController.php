<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comments::all();
        return view('comments', ['comments' => $comments]);
    }
    public function store(Request $request)
    {
        // Valida los datos del formulario de comentario
        $validatedData = $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'comment' => 'required|string',
        ]);

        // Crea un nuevo comentario en la base de datos
        $comment = Comment::create($validatedData);

        // Puedes agregar cualquier lógica adicional aquí, como enviar una notificación, etc.

        // Redirige a alguna página de éxito o muestra un mensaje de éxito
        return redirect()->route('comments.index')->with('success', 'El comentario se ha guardado exitosamente.');
    }    
}
