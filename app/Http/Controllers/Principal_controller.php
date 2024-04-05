<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Principal;
use App\Models\Agent_user;
use Illuminate\Http\Request;

class Principal_controller extends Controller
{
    public function index()
    {
    	$principal = Principal::get();
    	$principal_counter = count($principal);
    	$agent_user = Agent_user::first();
    	return view('principal')
    		->with('active','principal')
    		->with('principal', $principal)
    		->with('principal_counter', $principal_counter)
    		->with('agent_user', $agent_user);
    }

    public function principal_upload(Request $request)
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

		 $counter = count($csv);
		 //return $csv;
		 for ($i=1; $i < $counter; $i++) { 
		 	if($csv[$i][0] != null){
			 	$principal_search = Principal::where('principal',$csv[$i][1])->first();
			 	if (!$principal_search) {
			 	
			 		$principal_saved = new Principal([
						'id' => $csv[$i][0],
						'principal' => $csv[$i][1],
					]);
			 		$principal_saved->save();
			 		
			 	}
		 	}
		 }
		 

		 fclose($handle);

		 return 'saved';
    }
}
