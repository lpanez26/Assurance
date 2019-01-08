<?php

namespace App\Http\Controllers\Admin;

use App\CalculatorParameter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CalculatorParametersController extends Controller
{
    protected function getView()   {
        return view('admin/pages/calculator-parameters', ['posts' => $this->getAllCalculatorParameters()]);
    }

    public function getAllCalculatorParameters() {
        return CalculatorParameter::all()->sortBy('country');
    }

    protected function updateCalculatorParameters(Request $request)   {
        $subquery_param_gd_cd_id = "";
        $subquery_param_gd_cd = "";
        $subquery_param_gd_id = "";
        $subquery_param_cd_id = "";
        $subquery_param_gd = "";
        $subquery_param_cd = "";
        $subquery_param_id = "";
        foreach($request->input('object') as $key => $arr) {
            $subquery_param_gd_cd_id.= ' WHEN `id` = ' . $key . ' THEN ' . $arr['param_gd_cd_id'];
            $subquery_param_gd_cd.= ' WHEN `id` = ' . $key . ' THEN ' . $arr['param_gd_cd'];
            $subquery_param_gd_id.= ' WHEN `id` = ' . $key . ' THEN ' . $arr['param_gd_id'];
            $subquery_param_cd_id.= ' WHEN `id` = ' . $key . ' THEN ' . $arr['param_cd_id'];
            $subquery_param_gd.= ' WHEN `id` = ' . $key . ' THEN ' . $arr['param_gd'];
            $subquery_param_cd.= ' WHEN `id` = ' . $key . ' THEN ' . $arr['param_cd'];
            $subquery_param_id.= ' WHEN `id` = ' . $key . ' THEN ' . $arr['param_id'];
        }

        DB::statement("UPDATE `calculator_parameters` SET `param_gd_cd_id` = CASE " . $subquery_param_gd_cd_id . " ELSE `param_gd_cd_id` END, `param_gd_cd` = CASE " . $subquery_param_gd_cd . " ELSE `param_gd_cd` END, `param_gd_id` = CASE " . $subquery_param_gd_id . " ELSE `param_gd_id` END, `param_cd_id` = CASE " . $subquery_param_cd_id . " ELSE `param_cd_id` END, `param_gd` = CASE " . $subquery_param_gd . " ELSE `param_gd` END, `param_cd` = CASE " . $subquery_param_cd . " ELSE `param_cd` END, `param_id` = CASE " . $subquery_param_id . " ELSE `param_id` END");
        echo json_encode(array('success' => 'Calculator parameters have been updated successfully.'));
        die();
    }

    protected function addCalculatorParameter(Request $request) {
        if($request->isMethod('post')) {
            $this->validate($request, [
                'country' => 'required',
                'param_gd_cd_id' => 'required',
                'param_gd_cd' => 'required',
                'param_gd_id' => 'required',
                'param_cd_id' => 'required',
                'param_gd' => 'required',
                'param_cd' => 'required',
                'param_id' => 'required'
            ], [
                'country.required' => 'Country is required.',
                'param_gd_cd_id.required' => 'GD CD ID is required.',
                'param_gd_cd.required' => 'GD CD is required.',
                'param_gd_id.required' => 'GD ID is required.',
                'param_cd_id.required' => 'CD ID is required.',
                'param_gd.required' => 'GD is required.',
                'param_cd.required' => 'CD is required.',
                'param_id.required' => 'ID is required.'
            ]);

            $parameter = new CalculatorParameter();
            $parameter->country = $request->input('country');
            $parameter->param_gd_cd_id = $request->input('param_gd_cd_id');
            $parameter->param_gd_cd = $request->input('param_gd_cd');
            $parameter->param_gd_id = $request->input('param_gd_id');
            $parameter->param_cd_id = $request->input('param_cd_id');
            $parameter->param_gd = $request->input('param_gd');
            $parameter->param_cd = $request->input('param_cd');
            $parameter->param_id = $request->input('param_id');

            $parameter->save();
            return view('admin/pages/add-calculator-parameter', ['success' => ['New calculator parameter was added successfully.']]);
        }else {
            return view('admin/pages/add-calculator-parameter');
        }
    }

    protected function deleteCalculatorParameter($id)  {
        $parameter = CalculatorParameter::where('id', $id)->first();
        if(!empty($parameter))  {
            //deleting param from DB
            $parameter->delete();
            return redirect()->route('calculator-parameters')->with(['success' => 'Calculator parameter is deleted successfully.']);
        }else {
            return redirect()->route('calculator-parameters')->with(['error' => 'Error with deleting.']);
        }
    }
}
