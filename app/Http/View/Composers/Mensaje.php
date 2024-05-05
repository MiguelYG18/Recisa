<?php 
namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\User;

class Mensaje
{
    public function compose(View $view)
    {
        //Conteo de doctores que ya no tienen cupos
        $view->with('cupo',
            User::join('user_specialization', 'user_specialization.id_user', '=', 'users.id') 
                ->where('user_specialization.cupo_doctor','=','0')
                ->where('users.status','=','1')
                ->count());
        //Mostrar los doctores que no tiene cupo
        $view->with('doctors',
        User::select('specializations.name as specialization_name',
            'user_specialization.cupo_doctor','users.image',
            'users.names as user_name','users.status as user_status')
            ->join('user_specialization', 'user_specialization.id_user', '=', 'users.id') 
            ->join('specializations', 'specializations.id', '=', 'user_specialization.id_specialization')
            ->where('user_specialization.cupo_doctor','=','0')
            ->where('users.status','=','1')
            ->get());
    }
}