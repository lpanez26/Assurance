<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoggedUserAdditionalLogic extends Controller {
    protected function getMyProfileView()   {
        return view('pages/logged-user-additional-logic/my-profile');
    }
}
