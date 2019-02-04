<?php

namespace App\Http\Controllers;

use App\CalculatorParameter;
use App\Http\Controllers\Admin\CalculatorParametersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\UserController;

class HomeController extends Controller
{
    public function getView()   {
        /*$session_arr = [
            'token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImM3MzdhZTMwMmM4YTUwZWQ1MzQ1M2EzNGIzMmMyMzgzNDc2NTBkMWFlZGJkZDdhM2RhYjJhMTU4MzFlYjg5ODE3ZmUyOTJkZjQ0YjJhYjQ3In0.eyJhdWQiOiIxIiwianRpIjoiYzczN2FlMzAyYzhhNTBlZDUzNDUzYTM0YjMyYzIzODM0NzY1MGQxYWVkYmRkN2EzZGFiMmExNTgzMWViODk4MTdmZTI5MmRmNDRiMmFiNDciLCJpYXQiOjE1NDkwMjI0MDIsIm5iZiI6MTU0OTAyMjQwMiwiZXhwIjoxNTgwNTU4NDAyLCJzdWIiOiI2ODYyMiIsInNjb3BlcyI6W119.dVA5MMoe2-k1KWmw94k8OpBfLplVNPzDegRYtw_0phwEQHaypf9q2p0mgslFQjj4Tn4heNgaGlWyTr2GvLs2vQxFFRuxd5nRgOUi09U8Q7N0EujhvwueLoulb__8UFnzHiqMMXEpG1fvQ40loyAbmlqRE5qNCFqULVxUfaKXv779oyG5rCtTwWZY7QyhkmnOnCxnwXof8LinZvDB6ES1cK31X9haxkxpZpWtHsf8RkGDGYwvJzK0_3UMKB2qqdkfHuIOTk-0sB864p69zx9Mvm1RvZmtBElDoNPpzH8SDWsPKDGb4m34f1UtfF-sjyZ72UdFY6oW_V4tOm5QZKbHdnzVdjMEB_VMpNsBfaQB-BLLPa_wVOmrZZ2uaNcO772Ypa901MEruI56LL-Fp9ahlUpV3PEaHgCaqG0bhyr5OHwPXn25PRrHj0IsnhH68H_Bg4stv9HIr_3Fa-NVjwuVsMoxBGy_GBgKIisGl57fbtuGORJ0hXtkDxp_p6AKpB4GY6wyTHtCLZpnGk_ItKBBBAadAVoYzs3Koe9yJ0L5IQ3oCH9oeM-58STzH1gMYujn0OLDzzvYd3Frz6awTnaMTdCDv2bM0L6q3HPk433tInXVRlx8Vge7Y7G8w_exjzw6FtDWcSWQSNSCKbBjibyALXnuv7yVY1W5m0j3EPjdDi0',
            'id' => '68622',
            'type' => 'dentist',
            'have_contracts' => false
        ];

        session(['logged_user' => $session_arr]);*/

        if((new UserController())->checkDentistSession()) {
            return (new DentistController())->getView();
        } else if((new UserController())->checkPatientSession()) {
            return redirect()->route('patient-access');
        } else {
            $testimonials = DB::connection('mysql2')->table('user_expressions')->leftJoin('media', 'user_expressions.media_id', '=', 'media.id')->select('user_expressions.*', 'media.name as media_name', 'media.alt as media_alt')->where('visible_assurance', 1)->orderByRaw('user_expressions.order_id ASC')->get()->toArray();
            return view('pages/homepage', ['testimonials' => $testimonials]);
        }
    }

    public function redirectToHome() {
        return redirect()->route('home');
    }

    protected function getDentistView()   {
        return view('pages/dentist-test', []);
    }

    protected function getPatientView()   {
        return view('pages/patient-test', []);
    }

    protected function getCalculatorHtml(Request $request) {
        $params = [];
        if(!empty($request->input('patients_number')) && !empty($request->input('params_type') && !empty($request->input('country'))) && !empty($request->input('currency'))) {
            $params['patients_number'] = $request->input('patients_number');
            $params['country'] = $request->input('country');
            $params['currency'] = $request->input('currency');

            $params['param_gd'] = false;
            $params['param_cd'] = false;
            $params['param_id'] = false;

            switch($request->input('params_type')) {
                case 'param_gd_cd_id':
                    $params['param_gd'] = true;
                    $params['param_cd'] = true;
                    $params['param_id'] = true;
                    break;
                case 'param_gd_cd':
                    $params['param_gd'] = true;
                    $params['param_cd'] = true;
                    break;
                case 'param_gd_id':
                    $params['param_gd'] = true;
                    $params['param_id'] = true;
                    break;
                case 'param_cd_id':
                    $params['param_cd'] = true;
                    $params['param_id'] = true;
                    break;
                case 'param_gd':
                    $params['param_gd'] = true;
                    break;
                case 'param_cd':
                    $params['param_cd'] = true;
                    break;
                case 'param_id':
                    $params['param_id'] = true;
                    break;
            }
        }

        $view = view('partials/calculator', ['parameters' => (new CalculatorParametersController())->getAllCalculatorParameters(), 'currencies' => Controller::currencies, 'params' => $params]);
        $view = $view->render();
        return response()->json(['success' => $view]);
    }

    function getCalculatorResult(Request $request) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'https://api.coinmarketcap.com/v1/ticker/dentacoin/?convert=' . $request->input('currency'),
            CURLOPT_SSL_VERIFYPEER => 0
        ));
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $resp = json_decode(curl_exec($curl));
        curl_close($curl);

        $currency = 0;
        switch($request->input('currency')) {
            case 'USD':
                $currency = (float)$resp[0]->price_usd;
                break;
            case 'EUR':
                $currency = (float)$resp[0]->price_eur;
                break;
            case 'GBP':
                $currency = (float)$resp[0]->price_gbp;
                break;
            case 'RUB':
                $currency = (float)$resp[0]->price_rub;
                break;
            case 'INR':
                $currency = (float)$resp[0]->price_inr;
                break;
            case 'CNY':
                $currency = (float)$resp[0]->price_cny;
                break;
            case 'JPY':
                $currency = (float)$resp[0]->price_jpy;
                break;
        }

        $avg_premium = CalculatorParameter::where(array('id' => $request->input('country')))->first();
        $dcn_result = ((($request->input('patients_number') * 240) / 12) * $avg_premium[$request->input('params_type')]) / (float)$resp[0]->price_usd;

        $view = view('partials/calculator-result', ['result' => (number_format($dcn_result*$currency, 2)).' '.$request->input('currency')]);
        $view = $view->render();
        return response()->json(['success' => $view]);
    }
}

