<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard(){
        $user= Auth::user();        
        if($user->user_level == 1){
            $doctor= User::where('user_level',3)->count();
            //Conteo de citas en espera
            $quatity = DB::table('specializations')
                    ->select('quantity_voucher')
                    ->unionAll(DB::table('user_specialization')->select('cupo_doctor'))
                    ->get()
                    ->sum('quantity_voucher');
            //Validadcion para quatity null
            if(is_null($quatity)){
                $quatity=0;
            }        
            $appointment=Appointment::where('status','=','0')->count(); 
            $maxquatity=   $quatity + $appointment; 
            /**************************************************************************************/   
            $patient=Patient::count();
            return view('admin.dashboard',compact('doctor','appointment','patient','maxquatity'));
        } 
        if($user->user_level == 2){
            return view('secretary.dashboard');
        }
        if($user->user_level == 3){
            $appointments = Appointment::join('user_specialization', 'appointments.id_quota', '=', 'user_specialization.id')
            ->where('user_specialization.id_user', $user->id)
            ->count();
            return view('doctor.dashboard', compact('appointments')); 
        }

    }
}
