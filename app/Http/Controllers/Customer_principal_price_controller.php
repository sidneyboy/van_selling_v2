<?php

namespace App\Http\Controllers;
use App\Models\Customer_principal_code;
use App\Models\Customer;
use App\Models\Customer_principal_price;
use App\Models\Agent_applied_customer;
use App\Models\User;
use App\Models\Agent_user;
use SESSION;
use Illuminate\Http\Request;

class Customer_principal_price_controller extends Controller
{
    public function index(Request $request)
    {		
    	$agent_user = Agent_user::first();
    	return view('customer_principal_price')
    		->with('active','customer')
    		->with('agent_user',$agent_user);
    }

    public function customer_principal_price_upload(Request $request)
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

		$counter = count($csv);
		
		 if ($csv[0][1] != 'export_customer_price_per_principal') {
		 	return 'incorrect_file';
		 }else{
		 	for ($i=1; $i < $counter; $i++) { 
			 	$customer_principal_price = new Customer_principal_price([
			 			'customer_id' => $csv[$i][0],
						'principal_id' => $csv[$i][1],
						'price_level' => $csv[$i][2],
				]);
			 	$customer_principal_price->save();
		 	}
		 }

			return 'saved';

		
    }
}
