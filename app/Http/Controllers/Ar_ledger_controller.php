<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Ar_ledger;
use Illuminate\Http\Request;

class Ar_ledger_controller extends Controller
{
    public function index()
    {
    	if (isset(auth()->user()->id)) {
            $agent = User::find(auth()->user()->id);      
            return view('ar_ledger_upload')->with('active','ar_ledger_upload')
                                        ->with('agent',$agent);
        }else{
             return redirect()->route('login');
        }
    }

    public function ar_ledger_proceed_to_upload(Request $request)
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

		
		array_pop($csv); // Removes the last element in the array
			$out = fopen($fileName,'w');
			foreach ($csv as $row) { // sorry for writing it badly, try now
				fputcsv($out, $row);
			}
		fclose($out);

		//return $csv;
		$counter = count($csv);

		if ($csv[0][6] == 'AR CONTROL') {
			$ar_ledger_check = Ar_ledger::select('export_code')->where('export_code',$csv[1][6])->first();
			if ($ar_ledger_check) {
				return 'existing_export_code';
			}else{
				for ($i=3; $i < $counter; $i++) { 
					$ar_ledger = new Ar_ledger([
						'customer_id' =>  $csv[$i][1],
				    	'user_id' =>  $csv[$i][0],
				        'export_code' =>  $csv[1][6],
				    	'date_delivered' =>  $csv[$i][2],
				    	'delivery_receipt' =>  $csv[$i][5],
				    	'amount' =>  $csv[$i][6],
				    	'collected' =>  $csv[$i][7],
				    	'balance' =>  $csv[$i][8],
				    	'check_details' =>  '',
				    	'total_cm' =>  $csv[$i][9],
				    	'final_balance' =>  $csv[$i][10],
					]);

					$ar_ledger->save();
				}

				return 'saved';
			}
		}else{
			return 'wrong_file_input';
		}
    }
}
