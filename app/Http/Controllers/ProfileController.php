<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(){
        $user=User::find(Auth::user()->id);
        return view('profile.profile',compact('user'));
    }
}
