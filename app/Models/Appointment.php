<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable=[
        'id_quota',
        'id_patient',
        'date',
        'time',
        'description',
        'status'
    ];
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'id_patient'); // Cita pertenece a un paciente
    }
    public function doctor(){
        return $this->belongsTo(UserSpecialization::class,'id_quota');
    }
}
