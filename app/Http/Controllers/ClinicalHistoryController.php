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
    public function add()
    {
        return view('clinicalhistories.created');
    }

    public function shearePatient(Request $request)
    {
        $dni = $request->dni;
        $patient = Patient::where('dni',$dni)->first();

        return $patient;
    }

    public function insert(StoreClinicalHistoriesRequest $request)
    {
        try {
            DB::beginTransaction();

            // Crear una instancia del modelo ClinicalHistories
            $clinicalHistories = new ClinicalHistories();
            

            // Almacenar los archivos y obtener sus rutas
            if ($request->hasFile('files')) {
                $files = $request->file('files');
                $filePaths = [];
                foreach ($files as $file) {
                    $name=$clinicalHistories->hanbleUploadFile($file);
                    $clinicalHistories2 = new ClinicalHistories();
                    $clinicalHistories2->id_patient = $request->id_patient;
                    $clinicalHistories2->datetime_created = $request->datetime_created;
                    $clinicalHistories2->source_pdf = $name;
                    $clinicalHistories2->save();
                }
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
        return redirect('recisa/patients/list')->with('success','Historia clinica registrado');
        
    }
}
