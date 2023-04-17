<?php

namespace App\Http\Controllers;
use App\Models\Agent_user;
use Illuminate\Http\Request;

class Agent_user_controller extends Controller
{
    public function index()
    {
    	return view('agent_user');
    }

    public function agent_user_submit(Request $request)
    {
    	$agent_user = new Agent_user([
    		'user_id' => $request->input('user_id'),
    		'full_name' => $request->input('full_name'),
    	]);

    	$agent_user->save();

    	return redirect('van_selling_transaction');
    }
}
