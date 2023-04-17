<?php

namespace App\Http\Controllers;
use App\Models\Agent_user;
use App\Models\Van_selling_ar_ledger;
use Illuminate\Http\Request;

class Van_selling_remittance_controller extends Controller
{
    public function index()
    {
    	$van_selling_ar_ledger = Van_selling_ar_ledger::select('running_balance')->latest('id')->first();
    	$agent_user = Agent_user::first();
        return view('van_selling_remittance')
            ->with('active','van_selling_remittance')
            ->with('agent_user',$agent_user)
            ->with('van_selling_ar_ledger',$van_selling_ar_ledger);
    }

    public function van_selling_remittance_summary(Request $request)
    {
    	$remittance = str_replace(',', '', $request->input('remittance'));

    	return view('van_selling_remittance_summary')
    		->with('remittance',$remittance)
    		->with('agent_user',$request->input('agent_user'))
    		->with('prev_outstanding_balance',$request->input('prev_outstanding_balance'));
    }

    public function van_selling_remittance_save(Request $request)
    {
    	date_default_timezone_set('Asia/Manila');
		$date = date('Y-m-d');

    	$van_selling_ar_ledger = new Van_selling_ar_ledger([
    		'delivery_receipt' => 'REMITTANCE',
	    	'date' => $date,
	    	'principal' => 'N/A',
	        'previous_outstanding_balance' => $request->input('prev_outstanding_balance'),
	    	'new_van_load' => 0,
	    	'remittance' => $request->input('remittance'),
	    	'cm' => 0,
	    	'running_balance' => $request->input('running_balance'),
	    	'actual_stocks_on_hand' => 0,
	 		'charge_payment' => 0,
	 		'over_short' => 0,
    	]);

    	$van_selling_ar_ledger->save();

    	return 'saved';
    }
}
