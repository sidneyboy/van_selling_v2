<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Sales_order;
use App\Models\Sales_order_details;
use App\Models\Collection;
use App\Models\Customer_principal_code;
use App\Models\Collection_image;
use App\Models\Bo;
use App\Models\Summary_of_transaction_ledger;

use Illuminate\Http\Request;

class Summary_of_transaction_controller extends Controller
{
    public function index()
    {	
    	$agent = User::find(auth()->user()->id);
    	return view('summary_of_transaction_ledger')
    		->with('active','summary_of_transaction_ledger')
    		->with('agent', $agent);
    }

    public function summary_of_transaction_ledger_generate(Request $request)
    {
    	//return $request->input();

    	$var = explode('-', $request->input('date_range'));
        $date_from = date('Y-m-d',strtotime($var[0]));
        $date_to = date('Y-m-d',strtotime($var[1]));
        $ledger = Summary_of_transaction_ledger::whereBetween('date', [$date_from, $date_to])->get();
        //whereBetween('date', [$date_from, $date_to])

        return view('summary_of_transaction_ledger_generate_page',[
        	'ledger' => $ledger
        ]);
    }

    public function summary_of_transaction_ledger_generate_detailed_report(Request $request)
    {
        //return $request->input();
        $variable_explode = explode('-', $request->input('ref_id'));
        $ref_id = $variable_explode[0];
        $remarks = $variable_explode[1];
        if ($remarks == 'SO CASE' OR $remarks == 'SO BUTAL' OR $remarks == 'VERY FIRST INVENTORY') {
            $data = Sales_order::find($request->input('ref_id'));
            $customer_principal_code = Customer_principal_code::select('store_code')->where('customer_id',$data->customer_id)->where('principal_id',$data->principal_id)->first(); 
        }else if ($remarks == 'COLLECTION') {
            $data = Collection::find($request->input('ref_id'));
            $customer_principal_code = Customer_principal_code::select('store_code')->where('customer_id',$data->customer_id)->where('principal_id',$data->principal_id)->first(); 
        }else if($remarks == 'BO'){
            $data = Bo::find($request->input('ref_id'));
        $customer_principal_code = Customer_principal_code::select('store_code')->where('customer_id',$data->customer_id)->where('principal_id',$data->principal_id)->first(); 
        }

    

        date_default_timezone_set('Asia/Manila');
        $time = date('Y-m-d');


        return view('summary_of_transaction_ledger_generate_detailed_report_page',[
            'data' => $data,
        ])->with('customer_principal_code',$customer_principal_code)
          ->with('remarks', $remarks)
          ->with('time', $time);
    }

    public function summary_of_transaction_ledger_upload_image(Request $request)
    {



        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image_name = time().'.'.$request->image->extension();  
   
        $request->image->move(public_path('images'), $image_name);

        $image = new Collection_image([
            'customer_id' => $request->input('customer_id'),
            'collection_id' => $request->input('ref_id'),
            'image' => $image_name,
        ]);

        $image->save();

         return redirect()->route('summary_of_transaction_ledger');
    }
}
