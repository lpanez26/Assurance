<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PatientsController extends Controller
{
    protected function getView()   {
        return view('pages/patients');
    }
}
