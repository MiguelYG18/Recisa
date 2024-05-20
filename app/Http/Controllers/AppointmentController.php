<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use App\Models\UserSpecialization;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function list(){
        $appointments=Appointment::all();
        return view('appointments.list',compact('appointments'));
    }
    public function add(){
        $quotas = UserSpecialization::with(['user', 'specialization'])->get();
        $patients=Patient::all();
        return view('appointments.created',compact('quotas','patients'));
    }
}
