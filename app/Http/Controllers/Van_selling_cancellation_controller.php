<?php

namespace App\Http\Controllers;
use App\Models\Van_selling_cancellation;
use App\Models\Van_selling_cancellation_details;
use App\Models\Agent_user;
use Illuminate\Http\Request;

class Van_selling_cancellation_controller extends Controller
{
	public function index()
	{
		$agent_user = Agent_user::first();
        
    	return view('van_selling_cancellation_report')
            ->with('active','van_selling_cancellation_report')
            ->with('agent_user',$agent_user);
	}

	public function van_selling_cancellation_generate(Request $request)
	{
		//return $request->input();
		$var = explode('-', $request->input('date_range'));
        $date_from = date('Y-m-d',strtotime($var[0]));
        $date_to = date('Y-m-d',strtotime($var[1]));

        $van_selling_cancellation = Van_selling_cancellation::whereBetween('date',[$date_from, $date_to])->orderBy('id','desc')->get();

        return view('van_selling_cancellation_generate_page',[
        	'van_selling_cancellation' => $van_selling_cancellation,
        ])->with('full_name',$request->input('full_name'))
	      ->with('date_from',$date_from)
	      ->with('date_to',$date_to)
          ->with('user_id',$request->input('user_id'));
	}
}
