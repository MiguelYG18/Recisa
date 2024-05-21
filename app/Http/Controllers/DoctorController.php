<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\UserSpecialization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DoctorController extends Controller
{
    public function index(){
        $user= Auth::user();  
        // Obtener las especializaciones del usuario junto con el conteo de citas
        $asignaciones = UserSpecialization::where('id_user', $user->id)
                        ->with(['specialization'])
                        ->withCount(['appointment' => function ($query) {
                            $query->where('status', 0);
                        }])
                        ->get();
        // Obtener el total de cupos en general
        $atendidos = UserSpecialization::where('id_user', $user->id)
                        ->with(['specialization'])
                        ->withCount(['appointment' => function ($query) {
                            $query->where('status', 1); // Cambiado de 0 a 1
                        }])
                        ->get();

        // Sumar el total de cupos con las citas atendidas
        //$maxQuantity = $quantity + $atendidos->sum('appointment_count');
     

        return view('doctor.specialization.index',compact('asignaciones','maxQuantity'));
    }

}
