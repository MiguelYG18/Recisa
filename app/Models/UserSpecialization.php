<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSpecialization extends Model
{
    use HasFactory;

    protected $table = 'user_specialization';
    //Son las columnas que se van a modificar 
    protected $fillable = [
        'cupo_doctor'
    ];

    // Define la relación para el usuario
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id', 'cupo_doctor');
    }

    // Define la relación para la especialización
    public function specialization()
    {
        return $this->belongsTo(Specialization::class, 'id_specialization', 'id','cupo_doctor');
    }
    public function appointment(){
        return $this->hasMany(Appointment::class,'id_quota');
    }
}
