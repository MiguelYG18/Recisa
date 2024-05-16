<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Patient extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    //Son las columnas que se van a modificar 
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

    public function clinicalHistories()
    {
        return $this->hasMany(ClinicalHistories::class, 'id_patient'); // Paciente puede tener muchas historias clinicas
    }

    //Rutas con slug
    public function getSlugAttribute()
    {
        return Str::slug($this->names);
    }
}
