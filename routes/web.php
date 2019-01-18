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

//Route::get('/refresh-captcha', 'Controller@refreshCaptcha')->name('refresh-captcha');

Route::group(['prefix' => '/', 'middleware' => 'frontEndMiddleware'], function () {

    //======================================= PAGES ========================================

    Route::get('/', 'HomeController@getView')->name('home');

    Route::get('/patients', 'PatientsController@getView')->name('patients');

    Route::get('/support-guide', 'SupportGuideController@getView')->name('support-guide');


    //======================================= TEMPORALLY FOR DAPP TESTING ========================================
    Route::get('/dentist', 'HomeController@getDentistView')->name('dentist');
    Route::get('/patient', 'HomeController@getPatientView')->name('patient');
    //======================================= /TEMPORALLY FOR DAPP TESTING ========================================

    //======================================= AJAX ========================================

    Route::post('/get-calculator-html', 'HomeController@getCalculatorHtml')->name('get-calculator-html');

    Route::post('/get-calculator-result', 'HomeController@getCalculatorResult')->name('get-calculator-result');

    Route::group(['prefix' => 'patient'], function () {
        //Route::get('/', 'Admin\PatientController@getAdminAccess')->name('admin-access');

        Route::post('/authenticate', 'PatientController@authenticate')->name('authenticate-patient');
    });
});