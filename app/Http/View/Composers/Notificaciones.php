<?php 
namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\Specialization;

class Notificaciones
{
    public function compose(View $view)
    {
        //Conteo de especialidades vacías
        $view->with('vacio',
            Specialization::all()
            ->where('quantity_voucher','=','0')
            ->count());
        //Mostrar las especialidades vacías
        $view->with('specializations',
            Specialization::all()
            ->where('quantity_voucher','=','0'));
    }
}