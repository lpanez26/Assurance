<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PatientController extends Controller {
    protected function getNotLoggedView()   {
        return view('pages/patient');
    }

    protected function getStartFirstContractView()   {
        return view('logged-patient/start-first-contract');
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
        return redirect()->route('patient-access');
    }

    public function getPatientAccess()    {
        if($this->checkSession()) {
            //IF PATIENT HAVE NO EXISTING CONTRACTS
            return $this->getStartFirstContractView();

            //IF PATIENT HAVE EXISTING CONTRACTS

        }else {
            return $this->getNotLoggedView();
        }
    }

    protected function authenticate(Request $request) {
        $this->validate($request, [
            'token' => 'required'
        ], [
            'token.required' => 'Token is required.'
        ]);

        session(['logged_patient' => [
            'token' => $request->input('token')
        ]]);

        return redirect()->route('patient-access');
    }
}
