<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Collection;
use App\Models\Collection_details;
use App\Models\Collection_upload_image;
use App\Models\Collection_upload_details;
use App\Models\Collection_upload_customer;
use Illuminate\Http\Request;

class Locpd_controller extends Controller
{
    public function index()
    {
    	$agent = User::find(auth()->user()->id);
    	return view('locpd')->with('active','locpd')
    								->with('agent',$agent);
    }

    public function locpd_generate_final_summary(Request $request)
    {
    	//return $request->input();
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d');
    	$var = explode('-', $request->input('date_range'));
        $date_from = date('Y-m-d',strtotime($var[0]));
        $date_to = date('Y-m-d',strtotime($var[1]));

        $collection = Collection::whereBetween('date_collected',[$date_from, $date_to])->get();

        return view('locpd_generate_final_summary_page',[
        	'collection' => $collection,
        ])->with('date',$date);
    }
}
