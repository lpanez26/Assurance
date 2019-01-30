<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller {
    public static function instance() {
        return new UserController();
    }

    public function checkSession()   {
        if(!empty(session('logged_user')) && (session('logged_user')['type'] == 'patient' || session('logged_user')['type'] == 'dentist'))    {
            //LOGGED
            return true;
        }else {
            //NOT LOGGED
            return false;
        }
    }

    protected function userLogout(Request $request) {
        $route = '';
        if($request->session()->has('logged_user'))    {
            if(session('logged_user')['type'] == 'dentist') {
                $route = 'home';
            }else if(session('logged_user')['type'] == 'patient') {
                $route = 'patient-access';
            }
            $request->session()->forget('logged_user');
        }
        return redirect()->route($route);
    }

    protected function getMyProfileView()   {
        return view('pages/logged-user/my-profile');
    }

    protected function getEditAccountView()   {
        return view('pages/logged-user/edit-account');
    }

    protected function getManagePrivacyView()   {
        return view('pages/logged-user/manage-privacy');
    }

    protected function getMyContractsView()   {
        return view('pages/logged-user/my-contracts');
    }
}
