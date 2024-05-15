<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClinicalHistoryController extends Controller
{
    public function add(){
        return view('clinicalhistories.created');
    }

}
