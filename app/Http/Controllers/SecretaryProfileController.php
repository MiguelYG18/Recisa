<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SecretaryProfileController extends Controller
{
    public function index(){
        $user=User::find(Auth::user()->id);
        return view('profile.secretaryprofile',compact('user'));
    }
    public function update(Request $request, User $user)
    {
        //validamos nuestos datos
        request()->validate([
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email,'.$user->id,
                function ($attribute, $value, $fail) {
                    $allowedDomains = ['outlook.com', 'hotmail.com','gmail.com'];
                    $domain = explode('@', $value)[1];
                    if (!in_array($domain, $allowedDomains)) {
                        $fail("El dominio del correo electrónico no está permitido.");
                    }
                },
            ],
            'phone' => 'required|regex:/^[0-9]{9}$/|unique:users,phone,' . $user->id,
        ]);
        // Actualizar campos del usuario
        $user->phone = $request->phone;
        $user->email = $request->email;
        //Guardamos los cambios
        $user->save();
        return redirect('secretary/perfil')->with('success', 'Cambios guardados');
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
        return redirect('secretary/perfil')->with('success', 'Cambios guardados');       
    }
}
