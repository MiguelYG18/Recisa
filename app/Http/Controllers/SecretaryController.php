<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserSpecialization;
use Illuminate\Http\Request;
use Mpdf\Mpdf;
use Illuminate\Support\Facades\View;
class SecretaryController extends Controller
{
    public function list()
    {
        $users=User::where('user_level',3)->get();
        $quotas = UserSpecialization::with(['user', 'specialization'])->get();
        return view('secretary.doctores.list',compact('users','quotas'));
    }
}
