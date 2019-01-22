<?php

namespace App\Http\Middleware;

use App\Http\Controllers\PatientController;
use Closure;

class HandlePatientSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        /*$patient_controller = new PatientController();
        if(!$patient_controller->checkSession()) {
            return redirect()->route('patients');
        }*/
        $patient_controller = new PatientController();
        if(!$patient_controller->checkSession()) {
            //NOT LOGGED AND NOT TRYING TO LOG IN
            return response($patient_controller->getPatientAccess());
        }
        return $next($request);
    }
}
