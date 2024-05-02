<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{
    public function list(){
        $user = Auth::user();
        $specialization=
            User::select('specializations.name as specialization_name','user_specialization.cupo_doctor')
            ->join('user_specialization', 'user_specialization.id_user', '=', 'users.id') 
            ->join('specializations', 'specializations.id', '=', 'user_specialization.id_specialization')
            ->where('users.id', $user->id)
            ->get();
        return view('doctor.especialidades.list',compact('specialization'));
    }
}
