<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PatientController extends Controller {
    public function getNotLoggedView()   {
        return view('pages/patient', ['clinics' => (new APIRequestsController())->getAllClinicsByName()]);
    }

    protected function getInviteDentistsView() {
        return view('pages/logged-user/patient/invite-dentists');
    }

    public function getPatientAccess()    {
        if((new UserController())->checkSession()) {
            if(filter_var(session('logged_user')['have_contracts'], FILTER_VALIDATE_BOOLEAN)) {
                //IF PATIENT HAVE EXISTING CONTRACTS
                return view('pages/logged-user/patient/have-contracts');
            } else {
                //IF PATIENT HAVE NO EXISTING CONTRACTS
                return view('pages/logged-user/patient/start-first-contract', ['clinics' => (new APIRequestsController())->getAllClinicsByName()]);
            }
        }else {
            return (new HomeController())->getView();
        }
    }

    protected function authenticate(Request $request) {
        $this->validate($request, [
            'token' => 'required',
            'id' => 'required'
        ], [
            'token.required' => 'Token is required.',
            'id.required' => 'Email is required.'
        ]);

        $session_arr = [
            'token' => $request->input('token'),
            'id' => $request->input('id'),
            'type' => 'patient',
            'have_contracts' => false
        ];

        if(filter_var($request->input('have_contracts'), FILTER_VALIDATE_BOOLEAN)) {
            $session_arr['have_contracts'] = true;
        }

        session(['logged_user' => $session_arr]);
        return redirect()->route('patient-access');
    }

    protected function getInviteDentistsPopup(Request $request) {
        $data = $request->input('serialized');
        parse_str($data, $postdata);

        $view = view('partials/invite-dentists-popup', ['data' => $postdata]);
        $view = $view->render();
        return response()->json(['success' => $view]);
    }

    protected function inviteDentists(Request $request) {
        $this->validate($request, [
            'title' => 'required',
            'dentist-name' => 'required',
            'website' => 'required',
            'email' => 'required'
        ], [
            'title.required' => 'Title is required.',
            'dentist-name.required' => 'Dentist name is required.',
            'website.required' => 'Website is required.',
            'email.required' => 'Email is required.'
        ]);

        $data = $request->input();

        //check email validation
        if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL))   {
            return redirect()->route('invite-dentists')->with(['error' => 'Your form was not sent. Please try again with valid email.']);
        }

        $sender = (new APIRequestsController())->getUserData(session('logged_user')['id']);

        $body = '<!DOCTYPE html><html><head></head><body><div style="font-size: 16px;">Dear '.$data['title'].' '.$data['dentist-name'].',<br><br><br>My name is <span class="font-weight:bold;">'.$sender->name.'</span> and I as a patient of yours I would like to invite you to join <span style="font-weight: bold;">Dentacoin Assurance</span> - the first blockchain* dental assurance that entitles patients to preventive dental care against affordable monthly premiums in Dentacoin (DCN) currency.<br><br>It’s very easy to start: Just sign up, wait for approval and create your first contract. <a href="https://assurance.dentacoin.com/" style="color: #126585;font-weight: bold; text-decoration: none;" target="_blank">See how it works.</a> After/ if I agree to the conditions offered, we will get into a trustful agreement benefiting from an automated payment & notification system.<br><br>Affordable, preventive care for me - regular income and loyal patients for you!<br><br><br><a href="https://assurance.dentacoin.com/support-guide" style="font-size: 20px;color: #126585;background-color: white;padding: 10px 20px;text-decoration: none;font-weight: bold;border-radius: 4px;border: 2px solid #126585;" target="_blank">LEARN MORE</a><br><br><br>Looking forward to seeing you onboard! If you need any further information, do not hesitate to contact the Dentacoin Assurance team at <a href="mailto:assurance@dentacoin.com" style="color: #126585;font-weight: bold; text-decoration: none;">assurance@dentacoin.com</a>.<br><br>Regards,<br><span style="font-weight: bold;">'.$sender->name.'</span><br><br><br><i style="font-size: 13px;">* Blockchain is just a new technology used for secure storage and exchange of value and data.</i></div></body></html>';

        Mail::send(array(), array(), function($message) use ($body, $data, $sender) {
            $message->to($data['email'])->subject('Your patient '.$sender->name.' invited you to join Dentacoin Assurance');
            $message->from($sender->email, $sender->name)->replyTo($sender->email, $sender->name);
            $message->setBody($body, 'text/html');
        });

        return redirect()->route('invite-dentists')->with(['success' => 'Email has been sent to your dentist successfully.']);
    }
}
