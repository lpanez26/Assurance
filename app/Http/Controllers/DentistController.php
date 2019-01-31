<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DentistController extends Controller
{
    public function getView() {
        return view('pages/logged-user/dentist/homepage');
    }

    protected function getCreateContractView()   {
        return view('pages/logged-user/dentist/create-contract');
    }

    protected function register(Request $request) {
        $customMessages = [
            'dentist-or-practice-name.required' => 'Dentist or Practice Name is required.',
            'email.required' => 'Email address is required.',
            'password.required' => 'Password is required.',
            'repeat-password.required' => 'Repeat password is required.',
            'work-type.required' => 'Work type is required.',
            'country-code.required' => 'Country is required.',
            'address.required' => 'City, Street is required.',
            'phone.required' => 'Phone number is required.',
            'website.required' => 'Website is required.',
            'specialization.required' => 'Specialization is required.',
            'captcha.required' => 'Captcha is required.',
            'captcha.captcha' => 'Please type the code from the captcha image.'
        ];
        $this->validate($request, [
            'dentist-or-practice-name' => 'required|max:250',
            'email' => 'required|max:100',
            'password' => 'required|max:50',
            'repeat-password' => 'required|max:50',
            'work-type' => 'required',
            'country-code' => 'required',
            'address' => 'required|max:300',
            'phone' => 'required|max:50',
            'website' => 'required|max:250',
            'specialization' => 'required',
            'captcha' => 'required|captcha|max:5'
        ], $customMessages);

        $data = $request->input();
        $files = $request->file();

        //check email validation
        if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL))   {
            return redirect()->route('home')->with(['error' => 'Your form was not sent. Please try again with valid email.']);
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
                        return redirect()->route('home', ['slug' => $request->input('post-slug')])->with(['error' => 'Your form was not sent. Files can be only with with maximum size of '.number_format(MAX_UPL_SIZE / 1048576).'MB. Please try again.']);
                    }
                    //checking file format
                    if(!in_array(pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION), $allowed)) {
                        return redirect()->route('home')->with(['error' => 'Your form was not sent. Files can be only with .png, .jpg, .jpeg, .svg, .bmp formats. Please try again.']);
                    }
                    //checking if error in file
                    if($file->getError()) {
                        return redirect()->route('home')->with(['error' => 'Your form was not sent. There is error with one or more of the files, please try with other files. Please try again.']);
                    }
                }
            }
        } else {
            return redirect()->route('home')->with(['error' => 'Please select avatar and try again.']);
        }

        //handle the API response
        $api_response = (new APIRequestsController())->dentistRegister($data, $files);
        if($api_response['success']) {
            $session_arr = [
                'token' => $api_response['token'],
                'id' => $api_response['data']['id'],
                'type' => 'dentist',
                'have_contracts' => false
            ];

            session(['logged_user' => $session_arr]);
            return redirect()->route('home');
        } else {
            return redirect()->route('home')->with(['errors_response' => $api_response['errors']]);
        }
    }

    protected function login(Request $request) {
        $customMessages = [
            'email.required' => 'Email address is required.',
            'password.required' => 'Password is required.',
        ];
        $this->validate($request, [
            'email' => 'required|max:100',
            'password' => 'required|max:50'
        ], $customMessages);

        $data = $request->input();

        //check email validation
        if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL))   {
            return redirect()->route('home')->with(['error' => 'Your form was not sent. Please try again with valid email.']);
        }

        //handle the API response
        $api_response = (new APIRequestsController())->dentistLogin($data);
        if($api_response['success']) {
            $session_arr = [
                'token' => $api_response['token'],
                'id' => $api_response['data']['id'],
                'type' => 'dentist',
                'have_contracts' => false
            ];

            session(['logged_user' => $session_arr]);
            return redirect()->route('home');
        } else {
            return redirect()->route('home')->with(['errors_response' => $api_response['errors']]);
        }
    }
}
