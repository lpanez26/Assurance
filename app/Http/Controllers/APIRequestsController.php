<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class APIRequestsController extends Controller {
    public function dentistLogin($data) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_POST => 1,
            CURLOPT_URL => 'https://api.dentacoin.com/api/login',
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_POSTFIELDS => array(
                'platform' => 'assurance',
                'type' => 'dentist',
                'email' => $data['email'],
                'password' => $data['password']
            )
        ));

        $resp = json_decode(curl_exec($curl), true);
        curl_close($curl);

        if(!empty($resp))   {
            return $resp;
        }else {
            return false;
        }
    }

    public function dentistRegister($data, $files) {
        $post_fields_arr = array(
            'platform' => 'assurance',
            'name' => $data['dentist-or-practice-name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'password-repeat' => $data['repeat-password'],
            'country_code' => $data['country-code'],
            'address' => $data['address'],
            'avatar' => curl_file_create($files['image']->getPathName(), 'image/'.pathinfo($files['image']->getClientOriginalName(), PATHINFO_EXTENSION), $files['image']->getClientOriginalName()),
            'phone' => $data['phone'],
            'website' => $data['website'],
            'specialisations' => json_encode($data['specialization'])
        );

        switch($data['work-type']) {
            case 'independent-dental-practitioner':
                $post_fields_arr['type'] = 'dentist';
                break;
            case 'represent-dental-practice':
                $post_fields_arr['type'] = 'clinic';
                break;
            case 'an-associate-dentist':
                $post_fields_arr['type'] = 'dentist';

                if(!empty($data['clinic-id'])) {
                    $post_fields_arr['clinic_id'] = $data['clinic-id'];
                }
                break;
        }

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_POST => 1,
            CURLOPT_URL => 'https://api.dentacoin.com/api/register',
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_POSTFIELDS => $post_fields_arr
        ));

        $resp = json_decode(curl_exec($curl), true);
        curl_close($curl);

        if(!empty($resp))   {
            return $resp;
        }else {
            return false;
        }
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

    public function getAllClinicsByName($name = null) {
        $post_fields_arr = array(
            'type' => 'clinic',
            'items_per_page' => 2000
        );

        if(!empty($name)) {
            $post_fields_arr['name'] = $name;
        }

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_POST => 1,
            CURLOPT_URL => 'https://api.dentacoin.com/api/users/',
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_POSTFIELDS => $post_fields_arr
        ));

        $resp = json_decode(curl_exec($curl));
        curl_close($curl);

        if(!empty($resp))   {
            return $resp->data;
        }else {

            return response()->json(['error' => 'API not working at this moment. Try again later.']);
        }
    }

    public function getUserData($id) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'https://api.dentacoin.com/api/user/'.$id,
            CURLOPT_SSL_VERIFYPEER => 0,
        ));

        $resp = json_decode(curl_exec($curl));
        curl_close($curl);

        if(!empty($resp))   {
            return $resp->data;
        }else {
            return false;
        }
    }

    public function updateUserData($data, $files) {
        $post_fields_arr = array(
            'name' => $data['full-name'],
            'email' => $data['email'],
            'country_code' => $data['country']
        );

        //if user selected new avatar submit it to the api
        if(!empty($files['image'])) {
            $post_fields_arr['avatar'] = curl_file_create($files['image']->getPathName(), 'image/'.pathinfo($files['image']->getClientOriginalName(), PATHINFO_EXTENSION), $files['image']->getClientOriginalName());
        }

        $header = array();
        $header[] = 'Accept: */*';
        $header[] = 'Authorization: Bearer ' . session('logged_user')['token'];
        $header[] = 'Cache-Control: no-cache';

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_POST => 1,
            CURLOPT_URL => 'https://api.dentacoin.com/api/user/',
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_POSTFIELDS => $post_fields_arr,
            CURLOPT_HTTPHEADER => $header
        ));

        $resp = json_decode(curl_exec($curl));
        curl_close($curl);

        if(!empty($resp))   {
            return $resp->data;
        }else {
            return false;
        }
    }
}
