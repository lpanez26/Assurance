<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller {
    public static function instance() {
        return new UserController();
    }

    protected function getMyProfileView()   {
        $currency_arr = array();
        foreach(Controller::currencies as $currency) {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => 'https://api.coinmarketcap.com/v1/ticker/dentacoin/?convert=' . $currency,
                CURLOPT_SSL_VERIFYPEER => 0
            ));
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            $resp = json_decode(curl_exec($curl));
            curl_close($curl);
            $currency_arr[strtolower($currency)] = (array)$resp[0];
        }

        return view('pages/logged-user/my-profile', ['currency_arr' => $currency_arr, 'dcn_amount' => 123456]);
    }

    protected function getEditAccountView()   {
        return view('pages/logged-user/edit-account', ['countries' => (new APIRequestsController())->getAllCountries(), 'user_data' => (new APIRequestsController())->getUserData(session('logged_user')['id'])]);
    }

    protected function getManagePrivacyView()   {
        return view('pages/logged-user/manage-privacy');
    }

    protected function getMyContractsView()     {
        return view('pages/logged-user/my-contracts');
    }

    public function checkSession()   {
        if(!empty(session('logged_user')) && (session('logged_user')['type'] == 'patient' || session('logged_user')['type'] == 'dentist'))    {
            //LOGGED
            return true;
        }else {
            //NOT LOGGED
            return false;
        }
    }

    public function checkDentistSession()   {
        if(!empty(session('logged_user')) && session('logged_user')['type'] == 'dentist')    {
            //LOGGED
            return true;
        }else {
            //NOT LOGGED
            return false;
        }
    }

    public function checkPatientSession()   {
        if(!empty(session('logged_user')) && session('logged_user')['type'] == 'patient')    {
            //LOGGED
            return true;
        }else {
            //NOT LOGGED
            return false;
        }
    }

    protected function userLogout(Request $request) {
        $route = '';
        if($request->session()->has('logged_user'))    {
            if(session('logged_user')['type'] == 'dentist') {
                $route = 'home';
            }else if(session('logged_user')['type'] == 'patient') {
                $route = 'patient-access';
            }
            $request->session()->forget('logged_user');
        }
        return redirect()->route($route);
    }

    protected function updateAccount(Request $request) {
        $this->validate($request, [
            'full-name' => 'required|max:250',
            'email' => 'required|max:100',
            'country' => 'required',
        ], [
            'full-name.required' => 'Name is required.',
            'email.required' => 'Email address is required.',
            'country.required' => 'Country is required.',
        ]);

        $data = $this->clearPostData($request->input());
        $files = $request->file();

        //check email validation
        if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL))   {
            return redirect()->route('edit-account')->with(['error' => 'Your form was not sent. Please try again with valid email.']);
        }

        if(!empty($files)) {
            //404 if they're trying to send more than 2 files
            if(sizeof($files) > 2) {
                return abort(404);
            } else {
                $allowed = array('png', 'jpg', 'jpeg', 'svg', 'bmp', 'PNG', 'JPG', 'JPEG', 'SVG', 'BMP');
                foreach($files as $file)  {
                    //checking the file size
                    if($file->getSize() > MAX_UPL_SIZE) {
                        return redirect()->route('edit-account', ['slug' => $request->input('post-slug')])->with(['error' => 'Your form was not sent. Files can be only with with maximum size of '.number_format(MAX_UPL_SIZE / 1048576).'MB. Please try again.']);
                    }
                    //checking file format
                    if(!in_array(pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION), $allowed)) {
                        return redirect()->route('edit-account')->with(['error' => 'Your form was not sent. Files can be only with .png, .jpg, .jpeg, .svg, .bmp formats. Please try again.']);
                    }
                    //checking if error in file
                    if($file->getError()) {
                        return redirect()->route('edit-account')->with(['error' => 'Your form was not sent. There is error with one or more of the files, please try with other files. Please try again.']);
                    }
                }
            }
        }

        $post_fields_arr = array(
            'name' => $data['full-name'],
            'email' => $data['email'],
            'country_code' => $data['country']
        );

        //if user selected new avatar submit it to the api
        if(!empty($files['image'])) {
            $post_fields_arr['avatar'] = curl_file_create($files['image']->getPathName(), 'image/'.pathinfo($files['image']->getClientOriginalName(), PATHINFO_EXTENSION), $files['image']->getClientOriginalName());
        }

        //handle the API response
        $api_response = (new APIRequestsController())->updateUserData($post_fields_arr);
        if($api_response) {
            return redirect()->route('edit-account')->with(['success' => 'Your data was updated successfully.']);
        } else {
            return redirect()->route('edit-account')->with(['errors_response' => $api_response['errors']]);
        }
    }

    protected function addDcnAddress(Request $request) {
        $data = $this->clearPostData($request->input());
        $post_fields_arr = array(
            'dcn_address' => $data['address']
        );

        //handle the API response
        $api_response = (new APIRequestsController())->updateUserData($post_fields_arr);
        if($api_response) {
            return redirect()->route('my-profile')->with(['success' => 'Your Wallet Address was saved successfully.']);
        } else {
            return redirect()->route('my-profile')->with(['errors_response' => $api_response['errors']]);
        }
    }
}
