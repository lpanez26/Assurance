<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PatientController extends Controller {
    public static function instance() {
        return new PatientController();
    }

    protected function getNotLoggedView()   {
        return view('pages/patient');
    }

    protected function getStartFirstContractView()   {
        return view('pages/logged-patient/start-first-contract');
    }

    public function checkSession()   {
        if(!empty(session('logged_user')) && session('logged_user')['type'] == 'patient')    {
            //LOGGED
            return true;
        }else {
            //NOT LOGGED
            return false;
        }
    }

    public function getPatientAccess()    {
        var_dump(session('have_contracts'));
        die();
        /*session(['logged_user' => [
            'token' => 'test-token',
            'email' => 'test@abv.bg',
            'name' => 'hello-test',
            'type' => 'patient'
        ]]);*/


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
            'token' => 'required',
            'email' => 'required',
            'name' => 'required',
        ], [
            'token.required' => 'Token is required.',
            'email.required' => 'Email is required.',
            'name.required' => 'Name is required.',
        ]);

        $session_arr = [
            'token' => $request->input('token'),
            'email' => $request->input('email'),
            'name' => $request->input('name'),
            'type' => 'patient',
            'have_contracts' => false
        ];

        if(!empty($request->input('address'))) {
            $session_arr['address'] = $request->input('address');
        }

        if(filter_var($request->input('have_contracts'), FILTER_VALIDATE_BOOLEAN)) {
            $session_arr['have_contracts'] = true;
        }

        session(['logged_user' => $session_arr]);
        return redirect()->route('patient-access');
    }
}
