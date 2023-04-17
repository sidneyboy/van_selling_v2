<?php

namespace App\Http\Controllers;
use App\Models\Customer_principal_code;
use App\Models\Customer;
use App\Models\Agent_applied_customer;
use App\Models\User;
use App\Models\Agent_user;
use SESSION;
use Illuminate\Http\Request;

class Customer_principal_code_controller extends Controller
{
    public function index(Request $request)
    {		
    	$agent_user = Agent_user::first();
    	return view('customer_principal_code')
    		->with('active','customer')
    		->with('agent_user',$agent_user);
    }

    public function customer_principal_code_upload(Request $request)
    {
    	date_default_timezone_set('Asia/Manila');
		$date = date('Y-m-d');

		$fileName = $_FILES["agent_csv_file"]["tmp_name"];
		$csv = array();

		 if(($handle = fopen($fileName, "r")) !== FALSE)
		 {
		    while(($data = fgetcsv($handle, 1000, ",")) !== FALSE)
		    {
		        $csv[] = $data;
		    }
		 }



		//return $csv;
		$counter = count($csv);


		
		 if ($csv[0][1] != 'export_customer_principal_code') {
		 	return 'incorrect_file';
		 }else{
		 	for ($i=1; $i < $counter; $i++) { 
			 	$customer_principal_code = new Customer_principal_code([
			 			'customer_id' => $csv[$i][0],
						'principal_id' => $csv[$i][1],
						'store_code' => $csv[$i][2],
				]);
			 	$customer_principal_code->save();
			 	
		 	}
		 }

		

		return 'saved';
    }
}
