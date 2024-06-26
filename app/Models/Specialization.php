<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'quantity_voucher'
    ];
    
    public function userSpecializations()
    {
        return $this->hasMany(UserSpecialization::class, 'id_specialization');
    }
}
