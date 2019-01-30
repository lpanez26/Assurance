<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WalletInstructionsController extends Controller
{
    protected function getView()   {
        return view('pages/wallet-instructions');
    }
}
