<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Agent_applied_customer_controller extends Controller
{
    public function index()
    {
    	return view('agent_applied_customer')->with('active','agent_applied_customer');
    }

    public function agent_applied_customer_upload()
    {
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
		 for ($i=0; $i < $counter; $i++) { 
		 	echo $csv[$i][0];

		 	$sku_inventory_saved = new Sku_inventory([
					'sku_code' => $csv[$i][1],
					'sku_type' => $csv[$i][2],
					'description' => $csv[$i][3],
					'principal_id' => $csv[$i][4],
					'quantity' => $csv[$i][5],
					
				]);

		 	$sku_inventory_saved->save();
		 }
		 

		 fclose($handle);
    }
}
