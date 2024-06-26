<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    use HasFactory;
    protected $fillable=[
        'group_level',
        'group_status',
        'slug'
    ];
    public function user(){
        return $this->hasMany(User::class);
    }
    public function getRouteKeyName(){
        return 'slug';
    }
}
