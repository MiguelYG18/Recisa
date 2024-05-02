<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MensajeController extends Controller
{
    public function mensaje(){
        $specialization=
        User::select('specializations.name as specialization_name','user_specialization.cupo_doctor')
        ->join('user_specialization', 'user_specialization.id_user', '=', 'users.id') 
        ->join('specializations', 'specializations.id', '=', 'user_specialization.id_specialization')
        ->where('users.id', '')
        ->get();
    }
}
