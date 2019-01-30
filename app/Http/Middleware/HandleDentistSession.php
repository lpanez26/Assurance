<?php

namespace App\Http\Middleware;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Closure;

class HandleDentistSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        $user_controller = new UserController();
        if(!$user_controller->checkSession() && !array_key_exists('token', $request->input()) && !array_key_exists('email', $request->input())) {
            //NOT LOGGED AND NOT TRYING TO LOG IN
            return (new HomeController())->redirectToHome();
        } else if($user_controller->checkSession() && session('logged_user')['type'] == 'dentist') {
            //only dentists can access routes protected by this middleware
            return $next($request);
        } else {
            //if logged user with other role trying to access routes protected by this middleware
            return (new HomeController())->redirectToHome();
        }
    }
}
