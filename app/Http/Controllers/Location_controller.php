<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Location;
use App\Models\agent_user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use DB;

class Location_controller extends Controller
{
   public function index()
   {
   	 $location = Location::get();
   	 $location_counter = count($location);
   	 $agent_user = Agent_user::first();
    	return view('location')->with('active','location')
    		->with('location_counter', $location_counter)
    		->with('location', $location)
    		->with('agent_user', $agent_user);
   }

   public function location_upload(Request $request)
   {
   	
   	Schema::disableForeignKeyConstraints();
    	DB::table('locations')->truncate();
    	Schema::enableForeignKeyConstraints();
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

		 for ($i=1; $i < $counter; $i++) { 
		 	 if($csv[$i][0] != null){
		 	 		$location_saved = new Location([
					'id' => $csv[$i][0],
					'location' => $csv[$i][1],	
				]);
		 		$location_saved->save();
		 	 }
		 }
		 

		 fclose($handle);

		 return 'saved';
   }

   
}
