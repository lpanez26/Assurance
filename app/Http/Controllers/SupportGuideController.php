<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SupportGuideController extends Controller
{
    protected function getView()   {
        return view('pages/support-guide', ['posts' => (new \App\Http\Controllers\Admin\SupportGuideController())->getAllSupportGuides()]);
    }
}
