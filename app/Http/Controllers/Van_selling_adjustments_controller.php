<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Van_selling_upload;
use App\Models\Van_selling_upload_ledger;
use App\Models\Agent_user;
use Illuminate\Http\Request;

class Van_selling_adjustments_controller extends Controller
{
   public function index()
   {
   		$agent_user = Agent_user::first();
    	return view('van_selling_adjustments')
    		->with('active','van_selling_adjustments')
    		->with('agent_user',$agent_user);
   }

   public function van_selling_adjustments_save(Request $request)
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

		 $data_counter = count($csv);

		 //return $csv;

		 $explode = explode('-', $csv[0][5]);
		 $check_if_correct_file = $explode[0];

		 if ($check_if_correct_file == 'VSADJUSTMENTS') {
		 	$van_selling_upload = Van_selling_upload::where('van_selling_export_code',$csv[0][5])->first();

		 	if ($van_selling_upload) {
		 		return 'file_already_uploaded';
		 	}else{
		 		
		 		$van_selling_upload_save = new Van_selling_upload([
		 			'customer_id' => $csv[0][3],
			    	'van_selling_export_code' => $csv[0][5],
			    	'date' => $date,
		 		]);

		 		$van_selling_upload_save->save();

		 		if ($csv[0][2] == 'CASE' OR $csv[0][2] == 'Case') {
		 			for ($i=2; $i < $data_counter; $i++) { 
		 				
		 				$sku_code = $csv[$i][0];
		 				$van_ledger = DB::select(DB::raw("SELECT * FROM(SELECT * FROM Van_selling_upload_ledgers WHERE sku_code = '$sku_code' ORDER BY id DESC LIMIT 1)Var1 ORDER BY id ASC"));

			 			$counter = count($van_ledger);

		 				if ($counter != 0) {
			 				$end = $van_ledger[0]->end + ($csv[$i][4] * $csv[$i][2]);
					 		$van_selling_upload_details = new Van_selling_upload_ledger([
					 			'store_name' => 'adjustments',
							    'principal' => $van_ledger[0]->principal,
							    'sku_code' => $csv[$i][0],
							    'description' => $csv[$i][1],
							    'unit_of_measurement' => $csv[$i][3],
							    'sku_type' => $csv[0][2],
							    'butal_equivalent' => $csv[$i][2],
							    'reference' => $csv[0][5],
							    'beg' => $van_ledger[0]->end,
							    'van_load' => 0,
							    'sales' => 0,
        						'adjustments' => $csv[$i][4] * $csv[$i][2],
							    'end' => $end,
							    'unit_price' => $csv[$i][5],
						        'status' => '',
						        'status_cancel' => '',
					        	'date' => $date,
					 		]);

				 			$van_selling_upload_details->save();
					 	}else{
					 		return 'walay_sku_nga_na_upload_sa_ledger';
					 	}	
				 	}
		 		}else{
		 			for ($i=2; $i < $data_counter; $i++) { 
		 				$van_ledger = Van_selling_upload_ledger::where('sku_code',$csv[$i][0])->latest()->first();
		 				if ($van_ledger) {
		 					$beg = $van_ledger[0]->end;
		 					$end = $beg + $csv[$i][4];
				 			$van_selling_upload_details = new Van_selling_upload_ledger([
				 				'store_name' => 'adjustments',
						        'principal' => $van_ledger[0]->principal,
						    	'sku_code' => $csv[$i][0],
						    	'description' => $csv[$i][1],
						    	'unit_of_measurement' => $csv[$i][3],
						    	'sku_type' => $csv[0][2],
						    	'butal_equivalent' => $csv[$i][2],
						    	'reference' => $csv[0][5],
						    	'beg' => $beg,
						    	'van_load' => 0,
						    	'sales' => 0,
						        'adjustments' => $csv[$i][4],
						    	'end' => $end,
						    	'unit_price' => $csv[$i][5],
						        'status' => '',
						        'status_cancel' => '',
						        'date' => $date,
				 			]);

				 			$van_selling_upload_details->save();
					 	}else{
					 		return 'walay_sku_nga_na_upload_sa_ledger';
					 	}		
				 	}
		 		}

		 		return 'saved';
		 	}
		 }else{
		 	return 'incorrect_file';
		 }

   }
}
