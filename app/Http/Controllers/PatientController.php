<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePatient;
use App\Models\Patient;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class PatientController extends Controller
{
    public function show()
    {
        return view('patient.createdPatient');
    }

    public function list()
    {
        $patients = Patient::all();
        return view('patient.listPatient', compact('patients'));
    }

    public function insert(StorePatient $request)
    {
        try{
            DB::beginTransaction();
                $patient=new Patient();

                $patient->fill([
                    'dni'=>$request->dni,
                    'names'=>$request->names,
                    'surnames'=>$request->surnames,
                    'phone'=>$request->phone,
                    'age'=>$request->age
               ]);

                $patient->save();
            DB::commit();
        }catch (Exception $e) {
            DB::rollBack();
        }

        return redirect('admin/patient/list')->with('sucess', 'Paciente registrado');
    }

    public function consultarDNI(Request $request)
    {
        // Datos
        $token = 'apis-token-7996.PIiKyia80PyE1SFB7pFSdgtIclJJpaKj';
        $dni = $request->dni;
        
        // Llamar a la API
        $response = Http::withHeaders([
            'Referer' => 'https://apis.net.pe/consulta-dni-api',
            'Authorization' => 'Bearer ' . $token
        ])->get('https://api.apis.net.pe/v2/reniec/dni', [
            'numero' => $dni
        ]);

        // Retornar los datos en formato JSON
        return $response->json();
    }

    public function edit($slug)
    {
        // Buscar al usuario cuyo slug generado coincide con el parámetro
        $patient = Patient::all()->firstWhere(function ($patient) use ($slug) {
            return $patient->slug === $slug;
        });
        if(empty($patient)){
            return view('page.404');
        }
        return view('patient.editPatient', compact('patient'));
    }

    public function update($slug, Request $request)
    {
        // Generar el slug dinámicamente
        $generatedSlug = Str::slug($slug);

        // Buscar al paciente cuyo slug generado coincide con el parámetro
        $patient = Patient::all()->firstWhere(function ($patient) use ($generatedSlug) {
            return $patient->slug === $generatedSlug;
        });
        // Validaciones
        request()->validate([
            'dni' => 'required|max:8|unique:patients,dni,' . $patient->id,
            'phone' => 'required|min:9|max:9|unique:patients,phone,' . $patient->id,
            'age' => 'required'
        ]);

        // Actualizar campos del paciente
        $patient->phone = $request->phone;
        $patient->age = $request->age;

        $patient->save();
        return redirect('admin/patient/list')->with('success', 'El paciente ' . $patient->names . ' fue actualizado');
    }

    public function delete($id){
        $patient=Patient::find($id);
        $patient->delete();
        return redirect('admin/patient/list')->with('success','El paciente '.$patient->names.' fue eliminado'); 
    }
}
