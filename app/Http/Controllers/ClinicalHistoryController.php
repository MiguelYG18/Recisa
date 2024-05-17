<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClinicalHistoriesRequest;
use App\Models\ClinicalHistories;
use App\Models\Patient;
use App\Models\Specialization;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClinicalHistoryController extends Controller
{
    public function add(){
        $specializations = Specialization::all();
        return view('clinicalhistories.created',compact('specializations'));
    }

    public function shearePatient(Request $request)
    {
        $dni = $request->dni;
        $patient = Patient::where('dni',$dni)->first();

        return $patient;
    }

    public function insert(StoreClinicalHistoriesRequest $request)
    {
        try{
            DB::beginTransaction();
                $clinicalHistories = new ClinicalHistories();

                
                $clinicalHistories->save();
            DB::commit();
        }catch (Exception $e){
            DB::rollBack();
        }

        return redirect('admin/patient/list')->with('sucess', 'Historial clinicos registrados a pacientes.');

    }
}
