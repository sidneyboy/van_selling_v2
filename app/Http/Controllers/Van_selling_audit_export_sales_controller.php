<?php

namespace App\Http\Controllers;
use App\Models\User; 
use App\Models\Van_selling_transaction;
use App\Models\Van_selling_transaction_details;
use App\Models\Agent_user;
use Illuminate\Http\Request;

class Van_selling_audit_export_sales_controller extends Controller
{
    public function index()
    {
    	date_default_timezone_set('Asia/Manila');
        	$date = date('Y-m-d');
        	$time = date('His');
            $agent_user = Agent_user::first();
            return view('van_selling_audit_export_sales')->with('active','van_selling_audit_export_sales')
	          ->with('date', $date)
	          ->with('time', $time)
	          ->with('agent_user', $agent_user);
    }

    public function van_selling_audit_export_sales_check_password(Request $request)
    {
    	if ($request->input('password') == 'julmar_commercial_08_2021') {
    		return 'access_granted';
    	}else{
    		return 'wrong_credentials';
    	}
    }

    public function van_selling_audit_export_sales_generate_data(Request $request)
    {
    	//return $request->input();
    	$var = explode('-', $request->input('date_range'));
        $date_from = date('Y-m-d',strtotime($var[0]));
        $date_to = date('Y-m-d',strtotime($var[1]));
        $date = date('Y-m-d');
        $time = date('His');

        $van_selling_transaction = Van_selling_transaction::where('status','!=','CANCELLED')->whereBetween('date',[$date_from,$date_to])->get();

        return view('van_selling_audit_export_sales_generate_data_page',[
        		'van_selling_transaction' => $van_selling_transaction,
        ])->with('user_id', $request->input('user_id'))
          ->with('full_name', $request->input('full_name'))
          ->with('date',$date)
          ->with('time',$time);
    }

    public function van_selling_audit_export_sales_save(Request $request)
    {
    	if (is_null($request->input('details_id'))) {
    		return redirect('van_selling_transaction_report');
    	}else{
    		// foreach ($request->input('details_id') as $key => $data) {
	    		
	    	// }

            Van_selling_transaction_details::whereIn('id', $request->input('details_id'))
                    ->update(['remarks' => '']);
	    	return redirect('van_selling_transaction_report');
    	}
    }
}
