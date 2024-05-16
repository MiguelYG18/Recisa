<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Specialization;
use Illuminate\Http\Request;

class ClinicalHistoryController extends Controller
{
    public function add(){
        $specializations = Specialization::all();
        return view('clinicalhistories.created',compact('specializations'));
    }
    public function search(Request $request)
    {
        $patient = Patient::where('dni', $request->input('dni'))->first();
        if ($patient) {
            $fullName = $patient->surnames . ', ' . $patient->names;
            return response()->json([
                'id_patient' => $patient->id,
                'names' => $patient->names,
                'surnames' => $patient->surnames,
                'full_name' => $fullName
            ]);
        }
    }
}
