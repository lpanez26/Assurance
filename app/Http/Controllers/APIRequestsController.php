<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class APIRequestsController extends Controller {
    public function getUser($token) {

    }

    public function getAllCountries() {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => "https://api.dentacoin.com/api/countries/",
            CURLOPT_SSL_VERIFYPEER => 0
        ));
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $resp = json_decode(curl_exec($curl));
        curl_close($curl);
        if(!empty($resp))   {
            return $resp->data;
        }else {
            return false;
        }
    }

    public function getAllClinicsByName($name) {
        var_dump($name);
        die();
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_POST => 1,
            CURLOPT_URL => 'https://api.dentacoin.com/api/users/',
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_POSTFIELDS => array(
                'type' => 'clinic',
                'name' => $name
            )
        ));

        $resp = json_decode(curl_exec($curl));
        curl_close($curl);

        var_dump($resp);
        die();
        if(!empty($resp))   {
            return $resp->data;
        }else {
            return false;
        }
    }
}
