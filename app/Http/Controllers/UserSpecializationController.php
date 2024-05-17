<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAssignmentUserSpecialization;
use App\Models\Specialization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\UserSpecialization;
use Exception;

class UserSpecializationController extends Controller
{
    public function list()
    {
        $userSpecializations = UserSpecialization::all();
        $doctor = User::where('user_level', 3)->where('status', '=',1)->get();
        $specializations = Specialization::all()->where('quantity_voucher', '>', 0);

        return view('admin.assignment.assignment', compact('doctor', 'specializations', 'userSpecializations'));
    }

    public function insert(StoreAssignmentUserSpecialization $request)
    {
        // Obtener los datos de la solicitud
        $doctorId = $request->input('id_doctor');
        $specializationId = $request->input('id_specialization');
        $voucher = $request->input('vaucher_specialization');
        $maxVoucher = $request->input('max_voucher');
        $duplicate = UserSpecialization::where('id_user', '=', $doctorId)->where('id_specialization', '=', $specializationId)->exists();
        try {
            DB::beginTransaction();

            // Verificar si ya existe una asignación entre usuario y especialización
            $duplicate = UserSpecialization::where('id_user', $doctorId)
                ->where('id_specialization', $specializationId)
                ->first();

            if ($duplicate) {
                DB::rollBack();  // No se necesita commit si no se realiza ninguna acción
                return redirect('admin/assignment')->with('error', 'El usuario ya tiene esta especialización asignada.');
            }

            // Crear nueva asignación
            $userSpecialization = new UserSpecialization;
            $userSpecialization->id_user = $doctorId;
            $userSpecialization->id_specialization = $specializationId;
            $userSpecialization->cupo_doctor = $voucher;

            // Guardar la nueva asignación
            $userSpecialization->save();

            // Actualizar cantidad de cupos en la especialización
            $specialization = Specialization::findOrFail($specializationId);
            $specialization->quantity_voucher -= $voucher;
            $specialization->save();

            DB::commit();  // Hacer commit solo después de que todo se haya completado con éxito

            return redirect('admin/assignment')->with('success', 'Asignación registrada con éxito.');
        } catch (Exception $e) {
            DB::rollBack();  // Asegúrate de hacer rollback en caso de error
            return redirect('admin/assignment')->with('error', 'Error al registrar la asignación.');
        }
    }


    public function delete($id)
    {
        // Buscar el usuario por su ID
        $userSpecialization = UserSpecialization::find($id);

        $specialization = Specialization::find($userSpecialization->id_specialization);
        $specialization->quantity_voucher += $userSpecialization->cupo_doctor;

        // Eliminar la relación con la especialización específica
        $userSpecialization->delete();
        $specialization->save();
        return redirect('admin/assignment')->with('success', 'La asignación fue eliminada');
    }
}
