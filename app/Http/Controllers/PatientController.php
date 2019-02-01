<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PatientController extends Controller {
    public function getNotLoggedView()   {
        return view('pages/patient', ['clinics' => (new APIRequestsController())->getAllClinicsByName()]);
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
            'id' => 'required'
        ], [
            'token.required' => 'Token is required.',
            'id.required' => 'Email is required.'
        ]);

        $session_arr = [
            'token' => $request->input('token'),
            'id' => $request->input('id'),
            'type' => 'patient',
            'have_contracts' => false
        ];

        if(filter_var($request->input('have_contracts'), FILTER_VALIDATE_BOOLEAN)) {
            $session_arr['have_contracts'] = true;
        }

        session(['logged_user' => $session_arr]);
        return redirect()->route('patient-access');
    }

    protected function getInviteDentistsView() {
        return view('pages/logged-user/patient/invite-dentists');
    }
}
