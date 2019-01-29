<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the 'web' middleware group. Now create something great!
|
*/

Route::get('/refresh-captcha', 'Controller@refreshCaptcha')->name('refresh-captcha');

Route::group(['prefix' => '/', 'middleware' => 'frontEndMiddleware'], function () {

    //======================================= PAGES ========================================

    Route::get('/', 'HomeController@getView')->name('home');


    Route::get('/support-guide', 'SupportGuideController@getView')->name('support-guide');

    Route::get('/test', function() {
        var_dump((new \App\Http\Controllers\APIRequestsController())->getAllClinics());
        die();
    })->name('test');

    //======================================= TEMPORALLY FOR DAPP TESTING ========================================
    Route::get('/dentist-test', 'HomeController@getDentistView')->name('dentist-test');
    Route::get('/patient-test', 'HomeController@getPatientView')->name('patient-test');
    //======================================= /TEMPORALLY FOR DAPP TESTING ========================================

    //======================================= AJAX ========================================
    Route::post('/get-calculator-html', 'HomeController@getCalculatorHtml')->name('get-calculator-html');

    Route::post('/get-calculator-result', 'HomeController@getCalculatorResult')->name('get-calculator-result');

    Route::post('/get-login-signin', 'Controller@getLoginSigninHtml')->name('get-login-signin');

    Route::post('/get-clinics-by-name/{name}', 'APIRequestsController@getAllClinicsByName')->name('get-clinics-by-name');
    //======================================= /AJAX ========================================

    Route::group(['prefix' => 'patient', 'middleware' => 'HandlePatientSession'], function () {
        Route::get('/', 'PatientController@getPatientAccess')->name('patient-access');

        Route::post('/authenticate', 'PatientController@authenticate')->name('authenticate-patient');
    });

    Route::get('/my-profile', 'UserController@getMyProfileView')->middleware('HandleUserSession')->name('my-profile');

    Route::get('/edit-account', 'UserController@getEditAccountView')->middleware('HandleUserSession')->name('edit-account');

    Route::get('/manage-privacy', 'UserController@getManagePrivacyView')->middleware('HandleUserSession')->name('manage-privacy');

    Route::get('/my-contracts', 'UserController@getMyContractsView')->middleware('HandleUserSession')->name('my-contracts');

    Route::get('/user-logout', 'UserController@userLogout')->name('user-logout');

    Route::post('/dentist-register', 'UserController@dentistRegister')->name('dentist-register');

    Route::post('/dentist-login', 'UserController@dentistLogin')->name('dentist-login');
});