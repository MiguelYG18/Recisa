<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function list(){
        $patient=Patient::all();
        return view('patients.list',compact('patient'));
    }
    public function add(){
        return view('patients.created');
    }
}
