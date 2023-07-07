<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(8);
        return view('admin.users.index', compact('users'));
    }
    public function destroy($user) 
    {
        $user = User::find($user);
        $user->delete();
        return redirect()->route('admin.users.index');
    }
    public function edit($user) 
    {
        $user = User::find($user);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        // Usuario que estamos editando
        $user = User::find($id);
    
        // Validamos
        $request->validate([
            'name' => ['required', 'max:25', Rule::unique('users')->ignore($user->id)],
            'phone' => ['required', 'string'],
            'identity_card' => ['required', 'integer'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'password' => ['required', 'string', 'min:2'],
            'user_type' => ['required', Rule::in(['public', 'admin', 'creator'])],
        ]);
    
        // Para actualizar un registro existente
        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'identity_card' => $request->identity_card,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type' => $request->user_type,
        ]);
    
        return redirect()->route('admin.users.index');
    }
    

    
    
        
}