<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DoctorController extends Controller
{
    public function list(){
        $user = Auth::user();
        $specialization = User::query()
            ->join('user_specialization', 'users.id', '=', 'user_specialization.id_user')
            ->join('specializations', 'specializations.id', '=', 'user_specialization.id_specialization')
            ->leftJoin('appointments', 'appointments.id_quota', '=', 'user_specialization.id')
            ->where('users.id', $user->id)
            ->groupBy('specializations.name', 'users.names', 'user_specialization.cupo_doctor')
            ->select(
                'specializations.name as specialization_name',
                'users.names as doctor_name',
                'user_specialization.cupo_doctor',
                DB::raw('COUNT(appointments.id) as Total_Appointments')
            )
        ->get();

        return view('doctor.especialidades.list',compact('specialization'));
    }
}
