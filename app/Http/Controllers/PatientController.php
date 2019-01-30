<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PatientController extends Controller {
    public function getNotLoggedView()   {
        return view('pages/patient');
    }

    public function getPatientAccess()    {
        if((new UserController())->checkSession()) {
            if(filter_var(session('logged_user')['have_contracts'], FILTER_VALIDATE_BOOLEAN)) {
                //IF PATIENT HAVE EXISTING CONTRACTS
                return view('pages/logged-user/patient/have-contracts');
            } else {
                //IF PATIENT HAVE NO EXISTING CONTRACTS
                return view('pages/logged-user/patient/start-first-contract');
            }
        }else {
            return (new HomeController())->getView();
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

    protected function getInviteDentistsView() {
        var_dump('koz bira');
        die();
    }
}
