<?php

namespace App\Http\Controllers;
use App\Models\User; 
use App\Models\Van_selling_transaction;
use App\Models\Van_selling_transaction_details;
use App\Models\Agent_user;
use Illuminate\Http\Request;

class Van_selling_export_sales_controller extends Controller
{
    public function index()
    {
    	
    		date_default_timezone_set('Asia/Manila');
        	$date = date('Y-m-d');
        	$time = date('His');
    		$van_selling_transaction = Van_selling_transaction::where('status','!=','CANCELLED')->get();
            $agent_user = Agent_user::first();
            return view('van_selling_export_sales',[
            	'van_selling_transaction' => $van_selling_transaction,
            ])->with('active','van_selling_export_sales')
	          ->with('date', $date)
	          ->with('time', $time)
              ->with('agent_user', $agent_user);
        
    }

    public function van_selling_export_sales_update_remarks(Request $request)
    {
    	if (is_null($request->input('details_id'))) {
    		return redirect('van_selling_transaction');
    	}else{
            Van_selling_transaction_details::whereIn('id', $request->input('details_id'))
                    ->update(['remarks' => 'EXPORTED']);
	    	return redirect('van_selling_transaction');
    	}

    	
    }
}
