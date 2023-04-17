<?php

namespace App\Http\Controllers;
use App\Models\Agent_user;
use App\Models\Van_selling_upload_ledger;
use App\Models\Van_selling_transaction;
use App\Models\Van_selling_transaction_details;
use App\Models\Van_selling_transaction_cart_details;
use App\Models\Van_selling_bo_outright;
use App\Models\Van_selling_bo_outright_details;
use DB;
use Illuminate\Http\Request;

class Bo_outright_reports_controller extends Controller
{
    public function index()
    {
    	$agent_user = Agent_user::first();
        
    	return view('bo_outright_reports')
            ->with('active','bo_outright_reports')
            ->with('agent_user',$agent_user);
    }

    public function bo_outright_report_proceed(Request $request)
    {
    	$var = explode('-', $request->input('date_range'));
        $date_from = date('Y-m-d',strtotime($var[0]));
        $date_to = date('Y-m-d',strtotime($var[1]));
        $time = date('His');

        $van_selling_bo_outright = Van_selling_bo_outright::whereBetween('date',[$date_from,$date_to])->get();

    	return view('bo_outright_report_proceed_page',[
    		'van_selling_bo_outright' => $van_selling_bo_outright,
    	])->with('date_from',$date_from)
    	->with('date_to',$date_to)
    	->with('time',$time)
    	->with('user_id',$request->input('user_id'))
    	->with('full_name',$request->input('full_name'));
    }

    public function bo_outright_report_proceed_to_export(Request $request)
    {
    	//return $request->input();
    	$van_selling_bo_outright = Van_selling_bo_outright::whereBetween('date',[$request->input('date_from'),$request->input('date_to')])->where('remarks','!=','EXPORTED')->get();

    	return view('bo_outright_report_proceed_to_export_page',[
    		'van_selling_bo_outright' => $van_selling_bo_outright,
    	])->with('date_to',$request->input('date_to'))
    	->with('date_from',$request->input('date_from'))
    	->with('user_id',$request->input('user_id'))
    	->with('full_name',$request->input('full_name'));
    }

    public function bo_outright_reports_export_save(Request $request)
    {
		foreach ($request->input('van_selling_bo_outright_id') as $key => $data) {
			Van_selling_bo_outright::where('id', $data)
						->update(['remarks' => 'EXPORTED']);
		}

		return redirect('van_selling_transaction_report');
    }
}
