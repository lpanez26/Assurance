<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class APIRequestsController extends Controller {
    public function dentistLogin($data) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_POST => 1,
            CURLOPT_URL => 'https://dev-api.dentacoin.com/api/login',
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_POSTFIELDS => array(
                'platform' => 'assurance',
                'type' => 'dentist',
                'email' => $data['email'],
                'password' => $data['password']
            )
        ));

        $resp = json_decode(curl_exec($curl));
        curl_close($curl);

        var_dump($resp);
        die();
    }

    public function dentistRegister($data, $files) {
        $post_fields_arr = array(
            'platform' => 'assurance',
            'type' => 'dentist',
            'name' => $data['dentist-or-practice-name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'password-repeat' => $data['repeat-password'],
            'country_code' => $data['country-code'],
            'address' => $data['address'],
            'avatar' => '@'.$files['image']->getPathName(),
            'phone' => $data['phone'],
            'website' => $data['website'],
            'specialisations' => $data['specialization']
        );

        var_dump($post_fields_arr);die();

        //CHECK TYPE DENTIST OR CLINIC

        if(!empty($data['clinic-id'])) {
            $post_fields_arr['clinic_id'] = $data['clinic-id'];
        }

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_POST => 1,
            CURLOPT_URL => 'https://dev-api.dentacoin.com/api/register',
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_POSTFIELDS => $post_fields_arr
        ));

        $resp = json_decode(curl_exec($curl));
        curl_close($curl);

        var_dump($resp);
        die();
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

        if(!empty($resp))   {
            return response()->json(['success' => $resp->data]);
        }else {

            return response()->json(['error' => 'API not working at this moment. Try again later.']);
        }
    }
}
