<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DentistController extends Controller
{
    protected function getCreateContractView()   {
        return view('pages/logged-user/dentist/create-contract');
    }
}
