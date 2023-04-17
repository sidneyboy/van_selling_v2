<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use App\Models\User;
use App\Models\Agent_user;
use Illuminate\Http\Request;

class Customer_data_controller extends Controller
{
    public function index(Request $request)
    {
        $request->session()->forget(['customer_export_code']);
    	$customer = Customer::get();
    	$customer_counter = count($customer);
        $agent_user = Agent_user::first();
    	return view('customer_data')
    		->with('active','customer_data')
    		->with('customer', $customer)
    		->with('customer_counter', $customer_counter)
            ->with('agent_user', $agent_user);
    }
}
