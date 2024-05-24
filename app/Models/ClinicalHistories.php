<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ClinicalHistories extends Model
{
    use HasFactory;
    protected $fillable=[
        'id_patient',
        'datetime_created',
        'source_pdf'
    ];
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'id_patient'); // Historia clinica pertenece a un paciente
    }
    //Guardar nuestro pdf 
    public function hanbleUploadFile($file)
    {
        $documento = $file;
        $name = time() . $documento->getClientOriginalName();
        //$file->move(public_path() . '/img/productos/', $name);
        Storage::putFileAs('/public/clinical_histories/', $documento, $name, 'public');
        return $name;
    }
}
