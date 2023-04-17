<?php

namespace App\Http\Controllers;
use App\Models\Sales_register_uploaded;
use App\Models\Sales_register_details;
use App\Models\User;
use Illuminate\Http\Request;

class Sales_register_controller extends Controller
{
    public function index()
    {
    
    	$agent = User::find(auth()->user()->id);
    	return view('sales_register')
    		->with('active','sales_register')
    		->with('agent', $agent);
    		
    }

    public function sales_register_upload(Request $request)
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


     	$export_id_filter = Sales_register_uploaded::where('export_id',$csv[1][3])->first();

     	if ($export_id_filter) {
     		return 'file already uploaded';
     	}else{
     		//change ang csv[0] to csv[1] if mag gamit nag data from julmar_system
     		$sales_register_saved = new Sales_register_uploaded([
			 		'customer_id' => $csv[1][0],
					'principal_id' => $csv[1][1],
					'user_id' => $csv[1][2],
					'export_id' => $csv[1][3],
					'total_amount' => $csv[1][4],
					'dr' => $csv[1][5],
					'date' => $csv[1][6],
				]);
			$sales_register_saved->save();
        	$sales_register_saved_last_id = $sales_register_saved->id;

        	for ($i=2; $i < $counter; $i++) { 

        		$sales_register_details = new Sales_register_details([
	        		'sales_register_id' => $sales_register_saved_last_id,
	        		'sku_id' => $csv[$i][0],
	        		'quantity' => $csv[$i][1],
	        		'price' => $csv[$i][2],
	        		'sku_type' => $csv[$i][3],
	        	]);

	        	$sales_register_details->save();
        	}
     	}

     	return 'saved';
	}
}
