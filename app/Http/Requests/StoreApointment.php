<?php

namespace App\Http\Requests;

use App\Models\Appointment;
use Illuminate\Foundation\Http\FormRequest;

class StoreApointment extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id_quota' => [
                'required',
                'integer',
                'exists:user_specialization,id',
                function ($attribute, $value, $fail) {
                    $appointment = Appointment::where('id_quota', $value)
                        ->where('date', $this->date)
                        ->where('time', $this->time)
                        ->first();
                    if ($appointment) {
                        $fail('Ya existe una cita para este horario.');
                    }
                },
            ],
            'id_patient' => 'required|integer|exists:patients,id',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
        ];
    }
    public function attributes()
    {
        return[
            'id_quota'=>'doctor y especialidad',
            'id_patient'=>'paciente',
        ];
    }    
}
