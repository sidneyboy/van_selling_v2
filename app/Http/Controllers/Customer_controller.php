<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use App\Models\Customer_upload;
use App\Models\Customer_principal_code;
use App\Models\Agent_applied_customer;
use App\Models\User;
use App\Models\Agent_user;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class Customer_controller extends Controller
{
    public function index()
    {	
    	$agent_user = Agent_user::first();
    	return view('customer')
    		->with('active','customer')
    		->with('agent_user',$agent_user);
    }

    public function customer_upload(Request $request)
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

		$old_area = Customer::select('location_id')->first();

		if ($old_area) {
			if ($old_area->location_id != $csv[1][1]) {
				return 'file_contains_new_area_reverting_process';
			}else{
				if ($csv[0][1] != 'export_customer_applied_to_agent') {
				 	return 'incorrect_file';
				}else{
					// DB::statement('SET FOREIGN_KEY_CHECKS=0;');
					// DB::table('customers')->truncate();
					// DB::table('customer_principal_codes')->truncate();
					// DB::table('customer_principal_prices')->truncate();
					// DB::table('customer_uploads')->truncate();
					// DB::table('Agent_applied_customers')->truncate();
					// DB::statement('SET FOREIGN_KEY_CHECKS=1;');

				 // 	$customer_upload_saved = new Customer_upload([
					// 		'user_id' => $csv[0][0],
					// 		'customer_export_code' => $csv[0][2],
					// ]);
				 // 	$customer_upload_saved->save();
				}

			 	$counter = count($csv);

				for ($i=1; $i < $counter; $i++) { 
				 	
				 		$customer_saved = new Customer([
				 			'id' => $csv[$i][0],
							'location_id' => $csv[$i][1],
							'detailed_location' => $csv[$i][2],
							'store_name' => $csv[$i][3],
							'kind_of_business' => $csv[$i][4],
							
						]);
				 		$customer_saved->save();

				 		$agent_applied_customer = new Agent_applied_customer([
							'user_id' => $csv[0][0],
							'customer_id' => $csv[$i][0],
							'location_id' => $csv[$i][1],
						]);
				 		$agent_applied_customer->save();
				 	
				}
				fclose($handle);
				session(['customer_export_code' => $csv[0][2]]);
				return 'saved';
			}
		}else{
			if ($csv[0][1] != 'export_customer_applied_to_agent') {
				return 'incorrect_file';
			}else{
				// DB::statement('SET FOREIGN_KEY_CHECKS=0;');
				// DB::table('customers')->truncate();
				// DB::table('customer_principal_codes')->truncate();
				// DB::table('customer_principal_prices')->truncate();
				// DB::table('customer_uploads')->truncate();
				// DB::table('Agent_applied_customers')->truncate();
				// DB::statement('SET FOREIGN_KEY_CHECKS=1;');

				// $customer_upload_saved = new Customer_upload([
				// 	'user_id' => $csv[0][0],
				// 	'customer_export_code' => $csv[0][2],
				// ]);
				// $customer_upload_saved->save();
			}

			 $counter = count($csv);

			for ($i=1; $i < $counter; $i++) { 
				 	
				 		$customer_saved = new Customer([
				 			'id' => $csv[$i][0],
							'location_id' => $csv[$i][1],
							'detailed_location' => $csv[$i][2],
							'store_name' => $csv[$i][3],
							'kind_of_business' => $csv[$i][4],
							
						]);
				 		$customer_saved->save();

				 		$agent_applied_customer = new Agent_applied_customer([
							'user_id' => $csv[0][0],
							'customer_id' => $csv[$i][0],
							'location_id' => $csv[$i][1],
						]);
				 		$agent_applied_customer->save();
				 	
			}
			fclose($handle);
			session(['customer_export_code' => $csv[0][2]]);
			return 'saved';
		}
		
    }
    
    public function customer_upload_new_area(Request $request)
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

		$old_area = Customer::select('location_id')->first();

		if ($old_area) {
			if ($old_area != $csv[0][1]) {
			return 'file_contains_new_area_reverting_process';
		}else{
			if ($csv[0][1] != 'export_customer_applied_to_agent') {
			 	return 'incorrect_file';
			}else{
				// DB::statement('SET FOREIGN_KEY_CHECKS=0;');
				// DB::table('customers')->truncate();
				// DB::table('customer_principal_codes')->truncate();
				// DB::table('customer_principal_prices')->truncate();
				// DB::table('customer_uploads')->truncate();
				// DB::table('sales_register_uploadeds')->truncate();
				// DB::table('sales_register_details')->truncate();
				// DB::table('sales_orders')->truncate();
				// DB::table('sales_order_details')->truncate();
				// DB::table('collections')->truncate();
				// DB::table('collection_details')->truncate();
				// DB::table('collection_referals')->truncate();
				// DB::table('bos')->truncate();
				// DB::table('bo_details')->truncate();
				// DB::table('Agent_applied_customers')->truncate();
				// DB::statement('SET FOREIGN_KEY_CHECKS=1;');

			 // 	$customer_upload_saved = new Customer_upload([
				// 		'user_id' => $csv[0][0],
				// 		'customer_export_code' => $csv[0][2],
				// ]);
			 // 	$customer_upload_saved->save();
			}

		 	$counter = count($csv);

			for ($i=1; $i < $counter; $i++) { 
			 	
			 		$customer_saved = new Customer([
			 			'id' => $csv[$i][0],
						'location_id' => $csv[$i][1],
						'detailed_location' => $csv[$i][2],
						'store_name' => $csv[$i][3],
						'kind_of_business' => $csv[$i][4],
						
					]);
			 		$customer_saved->save();

			 		$agent_applied_customer = new Agent_applied_customer([
						'user_id' => $csv[0][0],
						'customer_id' => $csv[$i][0],
						'location_id' => $csv[$i][1],
					]);
			 		$agent_applied_customer->save();
			 	
			 }
			 fclose($handle);
			 session(['customer_export_code' => $csv[0][2]]);
			 return 'saved';
			}
		}else{
			if ($csv[0][1] != 'export_customer_applied_to_agent') {
			 	return 'incorrect_file';
			}else{
				// DB::statement('SET FOREIGN_KEY_CHECKS=0;');
				// DB::table('customers')->truncate();
				// DB::table('customer_principal_codes')->truncate();
				// DB::table('customer_principal_prices')->truncate();
				// DB::table('customer_uploads')->truncate();
				// DB::table('sales_register_uploadeds')->truncate();
				// DB::table('sales_register_details')->truncate();
				// DB::table('sales_orders')->truncate();
				// DB::table('sales_order_details')->truncate();
				// DB::table('collections')->truncate();
				// DB::table('collection_details')->truncate();
				// DB::table('collection_referals')->truncate();
				// DB::table('bos')->truncate();
				// DB::table('bo_details')->truncate();
				// DB::table('Agent_applied_customers')->truncate();
				// DB::statement('SET FOREIGN_KEY_CHECKS=1;');

			 // 	$customer_upload_saved = new Customer_upload([
				// 		'user_id' => $csv[0][0],
				// 		'customer_export_code' => $csv[0][2],
				// ]);
			 // 	$customer_upload_saved->save();
			}

		 	$counter = count($csv);

			for ($i=1; $i < $counter; $i++) { 
			 	
			 		$customer_saved = new Customer([
			 			'id' => $csv[$i][0],
						'location_id' => $csv[$i][1],
						'detailed_location' => $csv[$i][2],
						'store_name' => $csv[$i][3],
						'kind_of_business' => $csv[$i][4],
						
					]);
			 		$customer_saved->save();

			 		$agent_applied_customer = new Agent_applied_customer([
						'user_id' => $csv[0][0],
						'customer_id' => $csv[$i][0],
						'location_id' => $csv[$i][1],
					]);
			 		$agent_applied_customer->save();
			 	
			 }
			 fclose($handle);
			 session(['customer_export_code' => $csv[0][2]]);
			 return 'saved';
			}
		
    	
    }
}


