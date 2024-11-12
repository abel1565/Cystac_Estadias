<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    public function editar($id){
        //recupera los datos del usuario
        $user = User::findOrFail($id);
        return view('editarusuarios', ['user' => $user]);
    }
    public function updateusers (Request $request, $id){
        
        $user =User::findOrFail($id);//obtiene los datos del usuario seleccionado
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:users,email,' . $user->id,
            'password' => 'sometimes|nullable|min:6|confirmed',
        ]);           
        $user->fill($validatedData);//rellena los campos con los datos del usuario
        
        /* Verificar si el email ha cambiado
        if ($user->isDirty('email') ) {
            $user->email_verified_at = null;
        }*/
        $user->save(); // Guardar los cambios en la base de datos
        return redirect()->route('edituser.form', $id)->with('status', 'profile-updated');
       

    }
}
