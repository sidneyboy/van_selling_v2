<?php

namespace App\Http\Controllers;

use App\Models\User;
use DB;
use App\Models\Van_selling_van_load;
use App\Models\Van_selling_upload;
use App\Models\Van_selling_upload_ledger;
use App\Models\Vs_upload_inventory;
use App\Models\Van_selling_inventories;
use App\Models\Vs_os_inventories;
use App\Models\Agent_user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class Van_selling_upload_controller extends Controller
{
	public function index()
	{


		// Schema::disableForeignKeyConstraints();
		// DB::table('van_selling_transactions')->truncate();
		// DB::table('van_selling_transaction_details')->truncate();
		// Schema::enableForeignKeyConstraints();
		// Schema::dropIfExists('van_selling_bo_outright');
		// Schema::dropIfExists('van_selling_bo_outright_details');
		//  		Schema::disableForeignKeyConstraints();
		// //DB::table('van_selling_van_loads')->truncate();
		// Schema::drop('van_selling_van_loads');
		// Schema::enableForeignKeyConstraints();

		// return van_selling_van_load::all();

		$agent_user = Agent_user::first();
		return view('van_selling_upload')
			->with('active', 'van_selling_upload')
			->with('agent_user', $agent_user);
	}

	public function van_selling_upload_new_inventory(Request $request)
	{


		date_default_timezone_set('Asia/Manila');
		$date = date('Y-m-d');

		$fileName = $_FILES["agent_csv_file"]["tmp_name"];
		$csv = array();

		if (($handle = fopen($fileName, "r")) !== FALSE) {
			while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
				$csv[] = $data;
			}
		}
		//return $csv;
		$data_counter = count($csv);

		if ($csv[0][2] == 'VAN SELLING ADMIN EXPORT DATA') {
			Schema::disableForeignKeyConstraints();
			DB::table('Vs_upload_inventories')->truncate();
			Schema::enableForeignKeyConstraints();

			for ($i = 2; $i < $data_counter; $i++) {
				$new = new Vs_upload_inventory([
					'store_name' => $csv[0][0],
					'principal' => $csv[$i][1],
					'sku_code' => $csv[$i][2],
					'description' => $csv[$i][3],
					'unit_of_measurement' => $csv[$i][4],
					'sku_type' => $csv[$i][0],
					'butal_equivalent' => $csv[$i][6],
					'reference' => 'upload',
					'quantity' => $csv[$i][5],
					'running_balance' => $csv[$i][5],
					'unit_price' => $csv[$i][7],
					'date' => $date,
				]);

				$new->save();
			}
		} else if ($csv[0][0] == 'VAN SELLING INVENTORY') {
			Schema::disableForeignKeyConstraints();
			DB::table('Vs_os_inventories')->truncate();
			Schema::enableForeignKeyConstraints();
			for ($i = 1; $i < $data_counter; $i++) {
				$new_inventory = new Vs_os_inventories([
					'id' => $csv[$i][1],
					'sku_code' => $csv[$i][2],
					'description' => $csv[$i][3],
					'principal' => $csv[$i][4],
					'sku_type' => $csv[$i][5],
					'unit_of_measurement' => $csv[$i][6],
					'unit_price' => $csv[$i][7],
				]);

				$new_inventory->save();
			}
		} else {
			return 'incorrect_file';
		}
	}
}
