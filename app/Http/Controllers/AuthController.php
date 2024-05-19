<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //Redireccionar al usuario que no inicio sesion
    public function login(){
        if(!empty(Auth::check())){
            if(Auth::user()->user_level == 1){
                //Redireccionar al link de acuerdo al rol
                return redirect('admin/dashboard');
            }
            if(Auth::user()->user_level == 2){
                //Redireccionar al link de acuerdo al rol
                return redirect('secretary/dashboard');
            }
            if(Auth::user()->user_level == 3){
                //Redireccionar al link de acuerdo al rol
                return redirect('doctor/dashboard');
            }
        }
        return view('auth.login');
    }
    //Validar los datos ingresados en el login
    public function AuthLogin(AuthRequest $request){
        $remember = $request->filled('remember');
        // Intentar iniciar sesión del usuario
        if (Auth::attempt(['dni' => $request->dni, 'password' => $request->password], $remember)) {
            // Verificar si el estado del usuario es activo y el estado del grupo también es activo
            if (Auth::user()->status == 1 && Auth::user()->group->group_status == 1) {
                request()->session()->regenerate();
                // Guardar el DNI en la sesión solo si el checkbox "Recordar" está marcado
                if ($remember) {
                    session(['dni' => $request->dni]);
                } else {
                    session()->forget('dni'); // Eliminar el DNI de la sesión si el checkbox "Recordar" no está marcado
                }
                // Redirigir al usuario según su nivel
                switch (Auth::user()->user_level) {
                    case 1:
                        return redirect('admin/dashboard');
                    case 2:
                        return redirect('secretary/dashboard');
                    case 3:
                        return redirect('doctor/dashboard');
                    default:
                        return redirect('/'); // Redirigir a una ruta por defecto si no hay una coincidencia
                }
            } else {
                Auth::logout(); // Cerrar sesión del usuario si el estado del usuario o del grupo es inactivo
                return redirect()->back()->withErrors('Usted no tiene acceso');
            }
        } else {
            // Si el usuario no existe o la contraseña es incorrecta
            return redirect()->back()->withErrors('Por favor, ingrese su usuario y contraseña correctas');
        }
    }
    public function Logout(){
        Auth::logout();
        return redirect(url(''));
    }

}
