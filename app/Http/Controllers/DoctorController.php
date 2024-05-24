<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\ClinicalHistories;
use App\Models\UserSpecialization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DoctorController extends Controller
{
    public function index(){
        $user= Auth::user();  
        // Saber el avance de la atención de citas
        $atendidos = UserSpecialization::where('id_user', $user->id)
                        ->with(['specialization'])
                        ->withCount([
                            'appointment as appointment_pending_count' => function ($query) {
                                $query->where('status', 1);
                            },
                            'appointment as appointment_cancel_count' => function ($query) {
                                $query->where('status', 2);
                            },
                            'appointment as appointment_count'
                        ])
                        ->get();    
        //Traer a todos los pacientes por atender
        $appointments = Appointment::whereHas('doctor', function ($query) use ($user) {
                            $query->where('id_user', $user->id);
                        })
                        ->where('status', 0)
                        ->get();
        return view('doctor.citas.index',compact('atendidos','appointments'));
    }
    public function edit(Appointment $appointment){
        $clinical_histories = ClinicalHistories::where('id_patient', $appointment->patient->id)->get();
        return view('doctor.citas.show', compact('appointment','clinical_histories'));
    }
    public function update(Request $request,$id){
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:1,2',
            'description' => 'nullable',
        ],[], [
            'status' => 'estado' 
        ]);
        $validator->sometimes('description', 'required', function ($input) {
            return $input->status == 2;
        });  
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // Encuentra la cita y actualiza los datos
        $appointment = Appointment::findOrFail($id);
        $appointment->status = $request->input('status');
        $appointment->description = $request->input('description');
        $appointment->save();

        return redirect('doctor/citas/list')->with('success', 'Cita completa');
    }

}
