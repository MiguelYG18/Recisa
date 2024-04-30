<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'quantity_voucher'
    ];
    public function users(){
        return $this->belongsToMany(User::class,'user_specialization', 'id_user', 'id_specialization')
                ->withTimestamps()
                ->withPivot('cupo_doctor');
    }
}
