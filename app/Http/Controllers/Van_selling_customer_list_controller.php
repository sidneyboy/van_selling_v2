<?php

namespace App\Http\Controllers;

use App\Models\Van_selling_customer;
use App\Models\Agent_user;
use App\Models\Location;
use Illuminate\Support\Facades\Schema;
use DB;
use Illuminate\Http\Request;

class Van_selling_customer_list_controller extends Controller
{
	public function index()
	{
		$van_selling_customer_list = Van_selling_customer::where('remarks', null)->get();
		$agent_user = Agent_user::first();
		$barangay = Van_selling_customer::select('barangay')->groupBy('barangay')->get();
		return view('van_selling_customer_list', [
			'van_selling_customer_list' => $van_selling_customer_list,
			'barangay' => $barangay,
		])->with('active', 'van_selling_customer_list')
			->with('agent_user', $agent_user);
	}

	public function van_selling_customer_edit($id)
	{
		$agent_user = Agent_user::first();
		$location = Location::first();
		if (empty($agent_user)) {
			return redirect('agent_user');
		} else if (empty($location)) {
			return redirect('location');
		} else {
			$customer = Van_selling_customer::find($id);
			return view('van_selling_customer_edit', [
				'customer' => $customer,
				'agent_user' => $agent_user,
			])->with('active', 'van_selling_customer_list');
		}
	}

	public function van_selling_customer_edit_process(Request $request)
	{
		$validatedData = $request->validate([
			'latitude' => ['required'],
			'longitude' => ['required'],
		]);

		Van_selling_customer::where('id', $request->input('id'))
			->update([
				'contact_person' => strtoupper($request->input('contact_person')),
				'contact_number' => $request->input('contact_number'),
				'longitude' => $request->input('longitude'),
				'latitude' => $request->input('latitude'),
				'status' => 'DONE',
			]);

		return redirect('van_selling_customer_list');
	}

	public function van_selling_upload_customer()
	{
		$agent_user = Agent_user::first();
		return view('van_selling_upload_customer')
			->with('active', 'van_selling_customer_list')
			->with('agent_user', $agent_user);
	}

	public function van_selling_upload_customer_process()
	{
		// Schema::disableForeignKeyConstraints();
		// DB::table('van_selling_customers')->truncate();
		// Schema::enableForeignKeyConstraints();

		$fileName = $_FILES["file"]["tmp_name"];
		$csv = array();

		if (($handle = fopen($fileName, "r")) !== FALSE) {
			while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
				$csv[] = $data;
			}
		}
		//return $csv;
		$data_counter = count($csv);

		if (isset($csv[0][0])) {
			if ($csv[0][0] == 'van_selling_customer_exported_from_main_system') {
				for ($i = 2; $i < $data_counter; $i++) {
					$new = new Van_selling_customer([
						'store_name' => $csv[$i][1],
						'store_type' => $csv[$i][2],
						'address' => $csv[$i][4],
						'location_id' => $csv[$i][0],
						'barangay' => $csv[$i][3],
						'contact_person' => $csv[$i][5],
						'contact_number' => $csv[$i][6],
						'longitude' => $csv[$i][8],
						'latitude' => $csv[$i][7],
						'status' => 'DONE',
					]);

					$new->save();
				}
				return 'saved';
			} else {
				return 'Incorrect File';
			}
		} else {
			return 'Incorrect File';
		}
	}

	public function van_selling_customer_export_process(Request $request)
	{
		foreach ($request->input('customer_id') as $key => $data) {
			Van_selling_customer::where('id', $data)
				->update(['remarks' => 'DONE']);
		}

		return redirect('van_selling_transaction')->with('success', 'success');
	}

	public function van_selling_customer_geo_tag(Request $request)
	{
		$agent_user = Agent_user::first();
		$customer = Van_selling_customer::select('store_name', 'longitude', 'address', 'latitude')->get();
		return view('van_selling_customer_geo_tag', [
			'customer' => $customer,
		])->with('active', 'van_selling_customer_list')
			->with('agent_user', $agent_user);
	}

	public function van_selling_customer_geo_tag_view($id)
	{
		//return $id;
		$customer = Van_selling_customer::find($id);
		$agent_user = Agent_user::first();
		return view('van_selling_customer_geo_tag_view', [
			'customer' => $customer,
		])->with('active', 'van_selling_customer_list')
			->with('agent_user', $agent_user);
	}

	public function van_selling_barangay_geo_tag(Request $request)
	{
		//return $request->input();
		$barangay = Van_selling_customer::where('barangay', $request->input('barangay_data'))->get();
		$agent_user = Agent_user::first();


		$isteAttributes = array();
		foreach ($barangay as $key => $value) {
			$isteAttributes[] = array(
				"id"   =>  $value->id,
				"latitude"   =>  $value->latitude,
				"longitude"  =>  $value->longitude,
			);
		}


		return view('van_selling_barangay_geo_tag', [
			'barangay' => $barangay,
			'isteAttributes' => $isteAttributes,
		])->with('active', 'van_selling_customer_list')
			->with('agent_user', $agent_user);
	}
}
