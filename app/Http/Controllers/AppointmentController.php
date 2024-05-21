<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApointment;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\UserSpecialization;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        return view('appointments.show',compact('appointment'));
    }
}
