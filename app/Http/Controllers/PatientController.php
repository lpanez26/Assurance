<?php

namespace App\Http\Controllers;

use App\InviteDentistsReward;
use App\TemporallyContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PatientController extends Controller {
    public function getNotLoggedView()   {
        return view('pages/patient', ['clinics' => (new APIRequestsController())->getAllClinicsByName()]);
    }

    protected function getInviteDentistsView() {
        return view('pages/logged-user/patient/invite-dentists', ['invited_dentists_list' => InviteDentistsReward::where(array('patient_id' => session('logged_user')['id']))->get()->sortByDesc('created_at')->all()]);
    }

    public function getPatientAccess()    {
        if((new UserController())->checkSession()) {
            if(filter_var(session('logged_user')['have_contracts'], FILTER_VALIDATE_BOOLEAN)) {
                return view('pages/logged-user/patient/have-contracts', ['contracts' => TemporallyContract::where(array('patient_email' => (new APIRequestsController())->getUserData(session('logged_user')['id'])->email))->get()->all(), 'clinics' => (new APIRequestsController())->getAllClinicsByName()]);
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

        //check if there is temporallycontract for this patient by email or by user_id (we fill user_id for this temporally contract once patient register - this is in case patient change his email while he still have the proposal running)
        if(filter_var($request->input('have_contracts'), FILTER_VALIDATE_BOOLEAN) || TemporallyContract::where(array('email' => $request->input('email')))->get()->all()) {
            $session_arr['have_contracts'] = true;
        }

        session(['logged_user' => $session_arr]);
        return redirect()->route('patient-access');
    }

    protected function getInviteDentistsPopup(Request $request) {
        $data = $request->input('serialized');
        parse_str($data, $postdata);

        //===================================================================================
        //CHECK HERE IF THIS DENTIST EMAIL IS NOT ALREADY REGISTERED IN LOCAL DB AND IN API
        //===================================================================================

        $view = view('partials/invite-dentists-popup', ['data' => $postdata]);
        $view = $view->render();
        return response()->json(['success' => $view]);
    }

    protected function inviteDentists(Request $request) {
        $this->validate($request, [
            'title' => 'required',
            'dentist-name' => 'required',
            'website' => 'required',
            'email' => 'required',
            'redirect' => 'required',
        ], [
            'title.required' => 'Title is required.',
            'dentist-name.required' => 'Dentist name is required.',
            'website.required' => 'Website is required.',
            'email.required' => 'Email is required.',
            'redirect.required' => 'Redirect is required.',
        ]);

        $data = $this->clearPostData($request->input());

        //check email validation
        if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            return redirect()->route($data['redirect'])->with(['error' => 'Your form was not sent. Please try again with valid email.']);
        }

        //if user entered dcn_address for first time save it in coredb
        if(!empty($data['dcn_address'])) {
            $post_fields_arr = array('dcn_address' => $data['dcn_address']);

            //handle the API response
            $api_response = (new APIRequestsController())->updateUserData($post_fields_arr);
            if(!$api_response) {
                return redirect()->route($data['redirect'])->with(['errors_response' => $api_response['errors']]);
            }
        }

        //===================================================================================
        //CHECK HERE IF THIS DENTIST EMAIL IS NOT ALREADY REGISTERED IN LOCAL DB AND IN API
        //===================================================================================

        $sender = (new APIRequestsController())->getUserData(session('logged_user')['id']);

        $body = '<!DOCTYPE html><html><head></head><body><div style="font-size: 16px;">Dear '.$data['title'].' '.$data['dentist-name'].',<br><br><br>My name is <b>'.$sender->name.'</b> and I as a patient of yours I would like to invite you to join <b>Dentacoin Assurance</b> - the first blockchain* dental assurance that entitles patients to preventive dental care against affordable monthly premiums in Dentacoin (DCN) currency.<br><br>It’s very easy to start: Just sign up, wait for approval and create your first contract. <a href="https://assurance.dentacoin.com/" style="color: #126585;font-weight: bold; text-decoration: none;" target="_blank">See how it works.</a> After/ if I agree to the conditions offered, we will get into a trustful agreement benefiting from an automated payment & notification system.<br><br>Affordable, preventive care for me - regular income and loyal patients for you!<br><br><br><a href="https://assurance.dentacoin.com/support-guide" style="font-size: 20px;color: #126585;background-color: white;padding: 10px 20px;text-decoration: none;font-weight: bold;border-radius: 4px;border: 2px solid #126585;" target="_blank">LEARN MORE</a><br><br><br>Looking forward to seeing you onboard! If you need any further information, do not hesitate to contact the Dentacoin Assurance team at <a href="mailto:assurance@dentacoin.com" style="color: #126585;font-weight: bold; text-decoration: none;">assurance@dentacoin.com</a>.<br><br>Regards,<br><b>'.$sender->name.'</b><br><br><br><i style="font-size: 13px;">* Blockchain is just a new technology used for secure storage and exchange of value and data.</i></div></body></html>';

        Mail::send(array(), array(), function($message) use ($body, $data, $sender) {
            $message->to($data['email'])->subject('Your patient '.$sender->name.' invited you to join Dentacoin Assurance');
            $message->from($sender->email, $sender->name)->replyTo($sender->email, $sender->name);
            $message->setBody($body, 'text/html');
        });

        if(count(Mail::failures()) > 0) {
            return redirect()->route($data['redirect'])->with(['error' => 'Email has not been sent to your dentist, please try again later.']);
        } else {
            $invite_dentist_reward = new InviteDentistsReward();
            $invite_dentist_reward->patient_id = session('logged_user')['id'];
            $invite_dentist_reward->dentist_email = $data['email'];
            $invite_dentist_reward->title = $data['title'];
            $invite_dentist_reward->name = $data['dentist-name'];
            $invite_dentist_reward->website = $data['website'];
            if(!empty($data['phone'])) {
                $invite_dentist_reward->phone = $data['phone'];
            }

            //saving to DB
            $invite_dentist_reward->save();
            return redirect()->route($data['redirect'])->with(['success' => 'Email has been sent to your dentist successfully.']);
        }
    }

    protected function getContractProposal($slug) {
        $contract = TemporallyContract::where(array('slug' => $slug))->get()->first();
        if((new UserController())->checkDentistSession() || empty($contract) || ((new UserController())->checkPatientSession() && $contract->patient_email != (new APIRequestsController())->getUserData(session('logged_user')['id'])->email)) {
            //if dentist trying to access the proposal or if there is no such contract or if different patient trying to access the proposal
            return abort(404);
        } else if((new UserController())->checkPatientSession() && $contract->patient_email == (new APIRequestsController())->getUserData(session('logged_user')['id'])->email) {
            $params = array(
                'contract' => $contract,
                'countries' => (new APIRequestsController())->getAllCountries(),
                'shown' => 'one'
            );

            if(!empty($contract->patient_id_number)) {
                $params['shown'] = 'two';
            }
            //if patient is logged in and if the contract is about the logged patient
            return view('pages/logged-user/patient/review-assurance-contract', $params);
        } else {
            return view('pages/contract-proposal-partly', ['contract' => $contract]);
        }
    }
}
