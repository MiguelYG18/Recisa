<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index(){
        $user=User::find(Auth::user()->id);
        //Controlar la ruta de actualización segun el rol
        $photo = '';
        $profile='';
        switch ($user->user_level) {
            case 1:
                //ruta para actualziar la foto de perfil
                $photo = 'admin/perfil/photo/';
                $profile='admin/perfil/edit/';
                break;
            case 2:
                $photo = 'secretary/perfil/photo/';
                $profile='secretary/perfil/edit/';
                break;
            case 3:
                $photo = 'doctor/perfil/photo/';
                $profile='doctor/perfil/edit/';
                break;
        }
        // Construye la URL completa para el formulario
        $photo_url = url($photo . $user->id);
        $profile_url=url($profile.$user->id);
        return view('profile.profile',compact('user','photo_url','profile_url'));
    }
    public function update(Request $request, User $user)
    {
        //validamos nuestos datos
        request()->validate([
            'dni' => 'required|max:8|unique:users,dni,' . $user->id,
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'required|min:9|max:9|unique:users,phone,' . $user->id,
        ]);
        // Actualizar campos del usuario
        $user->phone = $request->phone;
        $user->email = $request->email;
        //Guardamos los cambios
        $user->save();
        switch ($user->user_level) {
            case 1:
                return redirect('admin/perfil')->with('success', 'Cambios guardados');
            case 2:
                return redirect('secretary/perfil')->with('success', 'Cambios guardados');
            case 3:
                return redirect('doctor/perfil')->with('success', 'Cambios guardados');
        }  
    }
    public function photo(User $user, Request $request){
        // Validaciones
        request()->validate([
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2000',
        ]);
        // Manejo de imágenes y actualización del modelo
        if ($request->hasFile('image')) {
            $name = $user->hanbleUploadImage($request->file('image'));
            if (Storage::disk('public')->exists('perfiles/' . $user->image_path)) {
                Storage::disk('public')->delete('perfiles/' . $user->image_path);
            }
        } else {
            $name = $user->image;
        }
        $user->image = $name;
        $user->save();
        // Redirigir basado en el nivel del usuario
        switch ($user->user_level) {
            case 1:
                return redirect('admin/perfil')->with('success', 'Cambios guardados');
            case 2:
                return redirect('secretary/perfil')->with('success', 'Cambios guardados');
            case 3:
                return redirect('doctor/perfil')->with('success', 'Cambios guardados');
        }        
    }
}
