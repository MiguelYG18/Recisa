<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard(){
        if(Auth::user()->user_level == 1){
            $doctor= User::where('user_level',3)->count();
            return view('admin.dashboard',compact('doctor'));
        } 
        if(Auth::user()->user_level == 2){
            return view('secretary.dashboard');
        }
        if(Auth::user()->user_level == 3){
            return view('doctor.dashboard');
        }

    }
}
