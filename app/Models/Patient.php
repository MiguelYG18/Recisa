<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $fillable = [
        'dni',
        'names',
        'surnames',
        'phone',
        'age'
    ];
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'id_patient'); // Paciente puede tener muchas citas
    }
}
