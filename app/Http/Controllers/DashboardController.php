<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard(){
        $user = Auth::user();
        if($user->user_level == 1){
            $doctor= User::where('user_level',3)->count();
            return view('admin.dashboard',compact('doctor'));
        } 
        if($user->user_level == 2){
            return view('secretary.dashboard');
        }
        if($user->user_level == 3){
            $appointments = Appointment::where('id_doctor', $user->id)->get();
            return view('doctor.dashboard', compact('appointments')); // Pasa la lista de pacientes a la vista            
        }

    }
}
