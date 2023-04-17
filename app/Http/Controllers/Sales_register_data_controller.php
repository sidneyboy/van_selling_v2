<?php

namespace App\Http\Controllers;
use App\Models\Sales_register;
use App\Models\User;
use Illuminate\Http\Request;

class Sales_register_data_controller extends Controller
{
    public function index()
    {
    	$sales_register = Sales_register::get();
    	$sales_register_counter = count($sales_register);
    	$agent = User::find(auth()->user()->id);

        foreach ($sales_register as $key => $value) {
            echo $value->sales_register;
        }
    	// return view('sales_register_data')
    	// 	->with('active','sales_register')
    	// 	->with('agent', $agent)
    	// 	->with('sales_register', $sales_register)
    	// 	->with('sales_register_counter', $sales_register_counter);
    		
    }
}
