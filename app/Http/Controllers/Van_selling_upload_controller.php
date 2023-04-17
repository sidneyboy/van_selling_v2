<?php

namespace App\Http\Controllers;

use App\Models\User;
use DB;
use App\Models\Van_selling_van_load;
use App\Models\Van_selling_upload;
use App\Models\Van_selling_upload_ledger;
use App\Models\Van_selling_upload_transaction;
use App\Models\Van_selling_inventories;
use App\Models\Customer;
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

		if ($csv[0][0] == 'VAN SELLING NEW INVENTORY') {
			$check_filter = Van_selling_upload::where('van_selling_export_code', $csv[1][3])->first();
			if ($check_filter) {
				return 'file_already_uploaded';
			} else {
				$customer = Customer::first();
				if ($customer->id == $csv[1][0]) {

					$van_selling_upload = new Van_selling_upload([
						'customer_id' => $csv[1][0],
						'van_selling_export_code' => $csv[1][3],
						'date' => $date,
					]);

					$van_selling_upload->save();

					for ($i = 2; $i < $data_counter; $i++) {
						if ($csv[$i][0] == 'NEW VAN LOAD') {
							$van_selling_van_load = new Van_selling_van_load([
								'delivery_receipt' => $csv[$i][1],
								'date' => $date,
								'principal' => $csv[$i][2],
								'new_van_load' => $csv[$i][3],
								'remarks' => '',
							]);

							$van_selling_van_load->save();
						} else if ($csv[$i][0] == 'TYPE') {
						} else {
							$sku_code = $csv[$i][3];
							$van_ledger = DB::select(DB::raw("SELECT * FROM(SELECT * FROM Van_selling_upload_ledgers WHERE sku_code = '$sku_code' ORDER BY id DESC LIMIT 1)Var1 ORDER BY id ASC"));

							$counter = count($van_ledger);

							if ($counter != 0) {
								if ($csv[$i][0] == 'CASE') {
									$total_left = $csv[$i][8];
									$quantity_butal = $csv[$i][6] * $csv[$i][7];
									$unit_price_right = $total_left;
									$total_right = $quantity_butal * $unit_price_right;

									$van_selling_upload_transaction = new Van_selling_upload_transaction([
										'sku_code' => $csv[$i][3],
										'description' => $csv[$i][4],
										'sku_type' => $csv[$i][0],
										'unit_of_measurement' => $csv[$i][5],
										'quantity' => $csv[$i][6],
										'unit_price_left' => $csv[$i][8],
										'total_left' => $total_left,
										'butal_equivalent' => $csv[$i][7],
										'quantity_butal' => $quantity_butal,
										'unit_price_right' => $unit_price_right,
										'total_right' => $total_right,
									]);

									$van_selling_upload_transaction->save();

									$beg = $van_ledger[0]->end;
									$van_load = $csv[$i][6] * $csv[$i][7];
									$end = $beg + $van_load;
									$total = $unit_price_right * $van_load;

									$van_selling_upload_ledger = new Van_selling_upload_ledger([
										'store_name' => 'VAN LOAD',
										'principal' => $csv[$i][2],
										'sku_code' => $csv[$i][3],
										'description' => $csv[$i][4],
										'unit_of_measurement' => $csv[$i][5],
										'sku_type' => $csv[$i][0],
										'butal_equivalent' => $csv[$i][7],
										'reference' => $csv[1][2],
										'beg' => $beg,
										'van_load' => $van_load,
										'sales' => 0,
										'adjustments' => 0,
										'end' => $end,
										'unit_price' => $unit_price_right,
										'total' => $total,
										'date' => $date
									]);

									$van_selling_upload_ledger->save();
								} else {
									$total_left = $csv[$i][6] * $csv[$i][8];
									$quantity_butal = $csv[$i][6];
									$unit_price_right = $total_left / $quantity_butal;
									$total_right = $quantity_butal * $unit_price_right;

									$van_selling_upload_transaction = new Van_selling_upload_transaction([
										'sku_code' => $csv[$i][3],
										'description' => $csv[$i][4],
										'sku_type' => $csv[$i][0],
										'unit_of_measurement' => $csv[$i][5],
										'quantity' => $csv[$i][6],
										'unit_price_left' => $csv[$i][8],
										'total_left' => $total_left,
										'butal_equivalent' => $csv[$i][7],
										'quantity_butal' => $quantity_butal,
										'unit_price_right' => $unit_price_right,
										'total_right' => $total_right,
									]);

									$van_selling_upload_transaction->save();

									$beg = $van_ledger[0]->end;
									$van_load = $csv[$i][6];
									$end = $beg + $van_load;
									$total = $unit_price_right * $van_load;
									$van_selling_upload_ledger = new Van_selling_upload_ledger([
										'store_name' => 'VAN LOAD',
										'principal' => $csv[$i][2],
										'sku_code' => $csv[$i][3],
										'description' => $csv[$i][4],
										'unit_of_measurement' => $csv[$i][5],
										'sku_type' => $csv[$i][0],
										'butal_equivalent' => $csv[$i][7],
										'reference' => $csv[1][2],
										'beg' => $beg,
										'van_load' => $van_load,
										'sales' => 0,
										'adjustments' => 0,
										'end' => $end,
										'unit_price' => $unit_price_right,
										'total' => $total,
										'date' => $date
									]);

									$van_selling_upload_ledger->save();
								}
							} else {
								if ($csv[$i][0] == 'CASE') {
									$total_left =  $csv[$i][8];
									$quantity_butal = $csv[$i][6] * $csv[$i][7];
									$unit_price_right = $total_left;
									$total_right = $quantity_butal * $unit_price_right;

									$van_selling_upload_transaction = new Van_selling_upload_transaction([
										'sku_code' => $csv[$i][3],
										'description' => $csv[$i][4],
										'sku_type' => $csv[$i][0],
										'unit_of_measurement' => $csv[$i][5],
										'quantity' => $csv[$i][6],
										'unit_price_left' => $csv[$i][8],
										'total_left' => $total_left,
										'butal_equivalent' => $csv[$i][7],
										'quantity_butal' => $quantity_butal,
										'unit_price_right' => $unit_price_right,
										'total_right' => $total_right,
									]);

									$van_selling_upload_transaction->save();


									$van_selling_upload_ledger = new Van_selling_upload_ledger([
										'store_name' => 'VAN LOAD',
										'principal' => $csv[$i][2],
										'sku_code' => $csv[$i][3],
										'description' => $csv[$i][4],
										'unit_of_measurement' => $csv[$i][5],
										'sku_type' => $csv[$i][0],
										'butal_equivalent' => $csv[$i][7],
										'reference' => $csv[1][2],
										'beg' => 0,
										'van_load' => $quantity_butal,
										'sales' => 0,
										'adjustments' => 0,
										'end' => $quantity_butal,
										'unit_price' => $unit_price_right,
										'total' => $total_right,
										'date' => $date
									]);

									$van_selling_upload_ledger->save();
								} else {
									$total_left = $csv[$i][6] * $csv[$i][8];
									$quantity_butal = $csv[$i][6];
									$unit_price_right = $total_left / $quantity_butal;
									$total_right = $quantity_butal * $unit_price_right;

									$van_selling_upload_transaction = new Van_selling_upload_transaction([
										'sku_code' => $csv[$i][3],
										'description' => $csv[$i][4],
										'sku_type' => $csv[$i][0],
										'unit_of_measurement' => $csv[$i][5],
										'quantity' => $csv[$i][6],
										'unit_price_left' => $csv[$i][8],
										'total_left' => $total_left,
										'butal_equivalent' => $csv[$i][7],
										'quantity_butal' => $quantity_butal,
										'unit_price_right' => $unit_price_right,
										'total_right' => $total_right,
									]);

									$van_selling_upload_transaction->save();

									$van_load = $csv[$i][6];
									$van_selling_upload_ledger = new Van_selling_upload_ledger([
										'store_name' => 'VAN LOAD',
										'principal' => $csv[$i][2],
										'sku_code' => $csv[$i][3],
										'description' => $csv[$i][4],
										'unit_of_measurement' => $csv[$i][5],
										'sku_type' => $csv[$i][0],
										'butal_equivalent' => $csv[$i][7],
										'reference' => $csv[1][2],
										'beg' => 0,
										'van_load' => $van_load,
										'sales' => 0,
										'adjustments' => 0,
										'end' => $csv[$i][6],
										'unit_price' => $csv[$i][8],
										'total' => $csv[$i][8] * $van_load,
										'date' => $date
									]);

									$van_selling_upload_ledger->save();
								}
							}
						}
					}



					//return Van_selling_ar_ledger::where('date',$date)->get();


					return 'saved';
				} else {
					return 'customer_id_not_equal';
				}
			}
		} else if ($csv[0][2] == 'VAN SELLING ADMIN EXPORT DATA') {
			$check_filter = Van_selling_upload::where('van_selling_export_code', $csv[1][2])->first();
			if ($check_filter) {
				return 'file_already_uploaded';
			} else {
				Schema::disableForeignKeyConstraints();
				// DB::table('van_selling_transactions')->truncate();
				// DB::table('van_selling_transaction_details')->truncate();
				DB::table('van_selling_upload_ledgers')->truncate();
				Schema::enableForeignKeyConstraints();


				$customer = Customer::first();
				if ($customer->id == $csv[0][1]) {
					$van_selling_upload = new Van_selling_upload([
						'customer_id' => $csv[0][1],
						'van_selling_export_code' => $csv[0][4],
						'date' => $date,
					]);
					$van_selling_upload->save();

					for ($i = 2; $i < $data_counter; $i++) {
						$van_selling_upload_ledger = new Van_selling_upload_ledger([
							'store_name' => 'VAN LOAD',
							'principal' => $csv[$i][1],
							'sku_code' => $csv[$i][2],
							'description' => $csv[$i][3],
							'unit_of_measurement' => $csv[$i][4],
							'sku_type' => $csv[$i][0],
							'butal_equivalent' => $csv[$i][6],
							'reference' => $csv[0][2],
							'beg' => 0,
							'van_load' => $csv[$i][5],
							'sales' => 0,
							'adjustments' => 0,
							'end' => $csv[$i][5],
							'unit_price' => $csv[$i][7],
							'total' => $csv[$i][5] * $csv[$i][7],
							'date' => $date
						]);

						$van_selling_upload_ledger->save();
					}
					return 'saved';
				} else {
					return 'customer_id_not_equal';
				}
			}
		} else if ($csv[0][3] == 'VAN SELLING INVENTORY ADJUSTMENTS') {
			$check_filter = Van_selling_upload::where('van_selling_export_code', $csv[1][2])->first();
			if ($check_filter) {
				return 'file_already_uploaded';
			} else {

				$customer = Customer::first();
				if ($customer->id == $csv[0][0]) {

					$van_selling_upload = new Van_selling_upload([
						'customer_id' => $csv[0][0],
						'van_selling_export_code' => $csv[0][4],
						'date' => $date,
					]);

					$van_selling_upload->save();


					for ($i = 2; $i < $data_counter; $i++) {
						$sku_code = $csv[$i][1];
						$van_ledger = DB::select(DB::raw("SELECT * FROM(SELECT * FROM Van_selling_upload_ledgers WHERE sku_code = '$sku_code' ORDER BY id DESC LIMIT 1)Var1 ORDER BY id ASC"));

						$ending_balance = $van_ledger[0]->end + $csv[$i][4];
						$total = $ending_balance * $van_ledger[0]->unit_price;

						$van_selling_upload_ledger = new Van_selling_upload_ledger([
							'store_name' => 'VAN LOAD',
							'principal' => $csv[$i][0],
							'sku_code' => $csv[$i][1],
							'description' => $csv[$i][3],
							'unit_of_measurement' => $van_ledger[0]->unit_of_measurement,
							'sku_type' => $van_ledger[0]->sku_type,
							'butal_equivalent' => $van_ledger[0]->butal_equivalent,
							'reference' => $csv[0][3],
							'beg' => $van_ledger[0]->end,
							'van_load' => 0,
							'sales' => 0,
							'adjustments' => $csv[$i][4],
							'end' => $ending_balance,
							'unit_price' => $van_ledger[0]->unit_price,
							'total' => $total,
							'date' => $date
						]);

						$van_selling_upload_ledger->save();
					}
					return 'saved';
				} else {
					return 'customer_id_not_equal';
				}
			}
		} else if ($csv[0][7] == 'VAN SELLING INVENTORY') {
			for ($i = 1; $i < $data_counter; $i++) {
				$checker = Van_selling_inventories::find($csv[$i][0]);
				if ($checker) {
					Van_selling_inventories::where('id', $csv[$i][0])
						->update([
							'unit_price' => $csv[$i][6],
						]);
				} else {
					$new_inventory = new Van_selling_inventories([
						'id' => $csv[$i][0],
						'sku_code' => $csv[$i][1],
						'description' => $csv[$i][2],
						'principal' => $csv[$i][3],
						'sku_type' => $csv[$i][4],
						'unit_of_measurement' => $csv[$i][5],
						'unit_price' => $csv[$i][6],
					]);

					$new_inventory->save();
				}
			}

			return 'saved';
		} else {
			return 'incorrect_file';
		}
	}
}
