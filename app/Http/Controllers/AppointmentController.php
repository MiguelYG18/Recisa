<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApointment;
use App\Models\Appointment;
use App\Models\ClinicalHistories;
use App\Models\Patient;
use App\Models\User;
use App\Models\UserSpecialization;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    public function list(){
        $appointments=Appointment::all();
        return view('appointments.list',compact('appointments'));
    }
    public function add(){
        $quotas = UserSpecialization::with(['user', 'specialization'])->get();
        $patients= Patient::all();
        $today=date('Y-m-d');
        $doctors=User::with(['specializations.specialization.userSpecializations.appointment'])
                      ->where('user_level',3)->get();
        return view('appointments.created',compact('quotas','patients','today','doctors'));
    }
    public function insert(StoreApointment $request){
        try {
            DB::beginTransaction();
            //Verificar si se sube una imagen
            $appointment=new Appointment();
            $appointment->fill([
                 'id_quota'=>$request->id_quota,
                 'id_patient'=>$request->id_patient,
                 'date'=>$request->date,
                 'time'=>$request->time,
                 'description'=>null,
                 'status'=>0
            ]);
            $appointment->save();
            // Actualizar cantidad de cupos en la tabla user_specialization
            $userSpecialization = UserSpecialization::findOrFail($request->id_quota);
            $userSpecialization->cupo_doctor -= 1;
            $userSpecialization->save();
            DB::commit();           
        } catch (Exception $e) {
            DB::rollBack();
        }
        return redirect('recisa/appoitnment/list')->with('success','Cita Registrada'); 
    }
    public function show(Appointment $appointment){
        $clinical_histories = ClinicalHistories::where('id_patient', $appointment->patient->id)->get();

        $birthDate = Carbon::parse($appointment->patient->date);
        $currentDate = Carbon::now();
        $age = $currentDate->diffInYears($birthDate);


        return view('appointments.show',compact('appointment','clinical_histories', 'age'));
    }
}
