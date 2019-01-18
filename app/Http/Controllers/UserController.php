<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
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
}
