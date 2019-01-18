<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PatientController extends Controller {
    protected function getNotLoggedView()   {
        return view('pages/patients');
    }

    protected function getView()   {
        return view('logged-patient/no-contracts-yet');
    }

    public function checkSession()   {
        if(!empty(session('logged_patient')) && session('logged_patient') == true)    {
            //LOGGED
            return true;
        }else {
            //NOT LOGGED
            return false;
        }
    }

    protected function logout(Request $request)    {
        if($request->session()->has('logged_patient'))    {
            $request->session()->forget('logged_patient');
        }
        return redirect()->route('patients');
    }

    public function getPatientAccess()    {
        if($this->checkSession()) {
            return $this->getView();
        }else {
            return view('admin/pages/login');
        }
    }

    protected function authenticate(Request $request) {
        var_dump($request->input());
        var_dump($request->input('token'));
        die();
        session(['logged_patient' => true]);
    }
}
