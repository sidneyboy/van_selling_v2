<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Van_selling_transaction;
use App\Models\Van_selling_transaction_details;
use App\Models\Van_selling_upload_ledger;
use App\Models\Van_selling_price_update;
use App\Models\Van_selling_price_update_details;
use App\Models\Agent_user;
use DB;
use Illuminate\Http\Request;

class Van_selling_price_update_controller extends Controller
{
    public function index()
    {
    	$agent_user = Agent_user::first();
        return view('van_selling_price_update')
        	->with('active','van_selling_price_update')
        	->with('agent_user',$agent_user);
    }

    public function van_selling_price_update_save(Request $request)
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

		if ($csv[0][1] == 'VAN SELLING UPDATED PRICE LIST') {
			$check_export_code = Van_selling_price_update::select('van_selling_price_update_export_code')->where('van_selling_price_update_export_code',$csv[0][2])->first();

			if ($check_export_code) {
				return 'file_already_uploaded';
			}else{
				$van_selling_price_update_save = new Van_selling_price_update([
				'van_selling_price_update_export_code' => $csv[0][2],
		    	'date' => $date,
				]);

				
				$van_selling_price_update_save->save();
				$van_selling_price_update_last_id = $van_selling_price_update_save->id;

				for ($i=2; $i < $data_counter; $i++) { 
					$van_selling_price_update_details = new Van_selling_price_update_details([
						'vs_price_update_id' => $van_selling_price_update_last_id,
				    	'sku_code' => $csv[$i][0],
				    	'description' => $csv[$i][1],
				    	'updated_price' => $csv[$i][2],
					]);

					$van_selling_price_update_details->save();

					$sku_code = $csv[$i][0];
					$ledger = DB::select(DB::raw("SELECT * FROM(SELECT * FROM Van_selling_upload_ledgers WHERE sku_code = '$sku_code' ORDER BY id DESC LIMIT 1)Var1 ORDER BY id ASC"));

					if($ledger){
						   $van_selling_upload_ledger = new Van_selling_upload_ledger([
		                'store_name' => 'UPDATED PRICE FROM MAIN SYSTEM' ,
		                'principal' =>  $ledger[0]->principal,
		                'sku_code' => $sku_code,
		                'description' => $ledger[0]->description,
		                'unit_of_measurement' => $ledger[0]->unit_of_measurement,
		                'sku_type' => $ledger[0]->sku_type,
		                'butal_equivalent' => $ledger[0]->butal_equivalent,
		                'reference' => $csv[0][2],
		                'beg' => $ledger[0]->beg,
		                'van_load' => 0,
		                'sales' => 0,
		                'adjustments' => 0,
		                'end' => $ledger[0]->end,
		               	'unit_price' => $csv[$i][2],
		                'date' => $date,
		                'status' => '',
		                'status_cancel' => '',
		            ]);

		           $van_selling_upload_ledger->save();
					}
				}

				//return $ledger;
				return 'saved';
		 	}
		}else{
			return 'incorrect_file';
		}
    }

}
