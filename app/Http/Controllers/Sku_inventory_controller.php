<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sku_upload;
use App\Models\Sku_inventory;
use App\Models\User;
use DB;
use Illuminate\Support\Facades\Schema;
class Sku_inventory_controller extends Controller
{
   public function index()
   {
   	 $agent = User::find(auth()->user()->id);
   	 $sku_inventory = Sku_inventory::get();
   	 $sku_counter = count($sku_inventory);
   	 return view('sku_inventory',[
   	 		'sku_inventory' => $sku_inventory,
   	 	])
   	 		->with('active','sku_inventory')
   	 		->with('agent',$agent)
   	 		->with('sku_counter',$sku_counter);
   }

   public function sku_inventory_upload(Request $request)
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

		$sku_upload = Sku_upload::where('sku_upload_code',$csv[0][0])->first();

		if ($sku_upload) {
			return 'existing_sku_upload_code';
		}else{
			$sku_upload = new Sku_upload([
			 	'sku_upload_code' => $csv[0][0],
			]);

			$sku_upload->save();
			$sku_upload_last_id = $sku_upload->id;

			$counter = count($csv);
			for ($i=1; $i < $counter; $i++) { 
				$sku = Sku_inventory::find($csv[$i][0]);

				if ($sku) {
					Sku_inventory::where('id', $csv[$i][0])
				      ->update([
				      	'running_balance' => $csv[$i][5],
				      	'price_1' => $csv[$i][6],
						'price_2' => $csv[$i][7],
						'price_3' => $csv[$i][8],
						'price_4' => $csv[$i][9],
				      ]);
				}else{
					$sku_inventory_saved = new Sku_inventory([
			 			'id' => $csv[$i][0],
						'sku_code' => $csv[$i][1],
						'description' => $csv[$i][2],
						'sku_type' => $csv[$i][3],
						'principal_id' => $csv[$i][4],
						'running_balance' => $csv[$i][5],
						'price_1' => $csv[$i][6],
						'price_2' => $csv[$i][7],
						'price_3' => $csv[$i][8],
						'price_4' => $csv[$i][9],
						'unit_of_measurement' => $csv[$i][10],
					]);

			 		$sku_inventory_saved->save();
				}
			}

			fclose($handle);

			return 'saved';
		}
		

		 	


		

		
   	}
}
