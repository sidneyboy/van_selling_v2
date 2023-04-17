<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Principal;
use App\Models\Agent_applied_customer;
use App\Models\Location;
use App\Models\Customer;
use App\Models\Customer_principal_code;
use App\Models\Customer_principal_price;
use App\Models\Summary_of_transaction_ledger;
use App\Models\Sku_inventory;
use App\Models\Sales_order;
use App\Models\Sales_order_details;
use App\Models\Sales_register_uploaded;
use App\Models\Sales_register_details;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use DB;

class Daily_routine_controller extends Controller
{
    public function index(Request $request)
    { 
        if (isset(auth()->user()->id)) {
        	$agent = User::find(auth()->user()->id);
        	$principal = Principal::get();
        	$location = Location::get();


        $request->session()->forget(['sales_order_id', 'customer_id','principal_id','mode_of_transaction']);

        	return view('daily_routine')->with('active','daily_routine')
        								->with('agent',$agent)
        								->with('principal',$principal)
        								->with('location',$location);
        }else{
             return redirect()->route('login');
        }
    }

    public function daily_routine_proceed(Request $request)
    {

    	$agent_applied_customer = Agent_applied_customer::where('user_id',auth()->user()->id)->where('location_id',$request->input('location'))->get();
        $principal = Principal::get();

    	return view('daily_routine_proceed_page',[
    		'agent_applied_customer' => $agent_applied_customer,
            'principal' => $principal
    	]);

    }

    public function daily_routine_proceed_to_inventory(Request $request)
    {
    	//return $request->input();
       $sales_order = Sales_order::where('customer_id',$request->input('customer'))->latest()->get();
       $sales_order_counter = count($sales_order);
       
       
       $sku = Sku_inventory::select('id','sku_code','unit_of_measurement','description','sku_type')->where('principal_id',$request->input('principal'))->get();
	   return view('daily_routine_proceed_to_inventory_page',[
    		'sku' => $sku
    	])->with('customer_id',$request->input('customer'))
          ->with('principal_id',$request->input('principal'))
          ->with('sales_order_counter',$sales_order_counter);
    }


    public function daily_routine_proceed_to_submit_beginning_inventory(Request $request)
    {
        date_default_timezone_set('Asia/Manila');


        $date = date('Y-m-d');
        $sales_order = new Sales_order([
                    'user_id' => auth()->user()->id,
                    'customer_id' => $request->input('customer_id'),
                    'sales_order_number' => '',
                    'date' => $request->input('date'),
                    'sku_type' => 'Case',
                    'principal_id' => $request->input('principal_id')
                ]);
        $sales_order->save();
        $sales_order_saved_last_id = $sales_order->id;

        $sales_register = new Sales_register_uploaded([
            'customer_id' => $request->input('customer_id'),
            'date' => $date,
            'principal_id' => $request->input('principal_id'),
            'user_id' => auth()->user()->id,
        ]);

        $sales_register->save();
        $sales_register_saved_last_id = $sales_register->id;



        foreach ($request->input('sku') as $key => $data) {
            if ($request->input('quantity')[$data] != 0) {
                $sales_order_details = new Sales_order_details([
                    'sku_id' => $data,
                    'customer_id' => $request->input('customer_id'),
                    'quantity' => $request->input('quantity')[$data],
                    'ending_inventory' => $request->input('quantity')[$data],
                    'remarks' => '',
                    'sales_order_id' => $sales_order_saved_last_id,
                    'date' => $request->input('date'),
                    'sku_type' => $request->input('sku_type')[$data],
                    'unit_of_measurement' => $request->input('unit_of_measurement')[$data],
                ]);
                 $sales_order_details->save();

                $sales_register_details = new Sales_register_details([
                    'sales_register_id' => $sales_register_saved_last_id,
                    'sku_id' => $data,
                    'quantity' => $request->input('prev_delivery_quantity')[$data],
                ]);

                $sales_register_details->save();
            }
        }

        $summary_of_transaction_ledger = new Summary_of_transaction_ledger([
            'customer_id' => $request->input('customer_id'),
            'so_number' => '',
            'so_amount' => '',
            'dr' => '',
            'ref_id' => $sales_order_saved_last_id,
            'check_no' => '',
            'check_date' => '',
            'collection' => '',
            'bo' => '',
            'image' => '',
            'remarks' => 'VERY FIRST INVENTORY',
            'date' => $date,
        ]);

        $summary_of_transaction_ledger->save();

         return redirect()->route('daily_routine');


    }

    public function daily_routine_proceed_to_final_summary (Request $request)
    {
        //return $request->input();
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d');
        $customer_data = Customer::select('store_name')->find($request->input('customer_id'));
        $customer_principal_code = Customer_principal_code::select('store_code')->where('principal_id',$request->input('principal_id'))->where('customer_id',$request->input('customer_id'))->first();
        $previous_sales_register = Sales_register_uploaded::where('customer_id',$request->input('customer_id'))->latest()->first();

        if (!$previous_sales_register) {
           return 'no_sales_register';
        }


        $sales_register_details = Sales_register_details::where('sales_register_id', $previous_sales_register->id)->where('sku_type','Case')->get();

        $sales_order = Sales_order::where('customer_id',$request->input('customer_id'))->where('user_id',auth()->user()->id)->where('sku_type','Case')->latest()->first();
        $sales_order_details = Sales_order_details::where('sales_order_id',$sales_order->id)->where('sku_type','Case')->get();

        $sku = Sku_inventory::findMany($request->input('sku'));

        $sku_counter = count($sku);

    	return view('daily_routine_proceed_to_final_summary_page',[
            'previous_sales_register' => $previous_sales_register,
        ])->with('sku', $sku)
            ->with('date', $date)
    			->with('quantity', $request->input('quantity'))
    			->with('description', $request->input('description'))
    			->with('sku_type', $request->input('sku_type'))
    			->with('quantity', $request->input('quantity'))
    			->with('remarks', $request->input('remarks'))
    			->with('sku_code', $request->input('sku_code'))
    			->with('customer_id', $request->input('customer_id'))
                ->with('principal_id', $request->input('principal_id'))
                ->with('customer_data', $customer_data)
                ->with('customer_principal_code', $customer_principal_code)
                ->with('sku_counter', $sku_counter)
                ->with('sales_order', $sales_order)
                ->with('sales_register_details', $sales_register_details)
                ->with('sales_order_details', $sales_order_details)
                ->with('cm_quantity',$request->input('cm_quantity'))
                ;
    }

    public function daily_routine_proceed_to_final(Request $request)
    {
        //return $request->input();

        $sales_order_name = preg_replace('/[^A-Za-z0-9\-]/', '', $request->input('store_name'));
        $principal = Principal::select('principal')->find($request->input('principal_id'));
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d');
        $time = date('His');
        $agent = User::select('name')->find(auth()->user()->id);
        $customer_location = Customer::select('location_id')->find($request->input('customer_id'));
        $customer_principal_price = Customer_principal_price::select('price_level')->where('customer_id',$request->input('customer_id'))->where('principal_id',$request->input('principal_id'))->first();

        $sku_data = Sku_inventory::findMany($request->input('sku'));
        $sku_counter = count($sku_data);

        return view('daily_routine_proceed_to_final')
                    ->with('sku_code',$request->input('sku_code'))
                    ->with('final_quantity_ordered',$request->input('final_quantity_ordered'))
                    ->with('description',$request->input('description'))
                    ->with('sku',$request->input('sku'))
                    ->with('sku_type',$request->input('sku_type'))
                    ->with('customer_id',$request->input('customer_id'))
                    ->with('principal_id',$request->input('principal_id'))
                    ->with('store_code',$request->input('store_code'))
                    ->with('store_name',$request->input('store_name'))
                    ->with('date',$date)
                    ->with('time',$time)
                    ->with('sales_order_name',$sales_order_name)
                    ->with('principal',$principal)
                    ->with('agent',$agent)
                    ->with('customer_location',$customer_location)
                    ->with('customer_principal_price',$customer_principal_price)
                    ->with('sku_data',$sku_data)
                     ->with('sku_counter',$sku_counter)
                    ->with('mode_of_transaction',$request->input('mode_of_transaction'))
                    ->with('unit_of_measurement',$request->input('unit_of_measurement'))
                    ->with('ending_inventory',$request->input('ending_inventory'));

    }

    public function daily_routine_submit_sales_order_and_proceed(Request $request)
    {
       //return $request->input();
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d');

        //return $request->input();

        $sales_order = new Sales_order([
                    'user_id' => auth()->user()->id,
                    'customer_id' => $request->input('customer_id'),
                    'sales_order_number' => $request->input('sales_order_number'),
                    'date' => $date,
                    'sku_type' => 'Case',
                    'principal_id' => $request->input('principal_id'),
                    'mode_of_transaction' => $request->input('mode_of_transaction')
                    
                ]);
        $sales_order->save();
        $sales_order_saved_last_id = $sales_order->id;

        foreach ($request->input('sku') as $key => $data) {

            $sales_order_details = new Sales_order_details([
                    'sku_id' => $data,
                    'customer_id' => $request->input('customer_id'),
                    'quantity' => $request->input('final_quantity_ordered')[$data],
                    'ending_inventory' => $request->input('ending_inventory')[$data],
                    'remarks' => '',
                    'sales_order_id' => $sales_order_saved_last_id,
                    'sku_type' => 'Case',
                    'unit_of_measurement' => $request->input('unit_of_measurement')[$data],
                    'date' => $date,
                    'price' => $request->input('price')[$data],
                ]);
            $sales_order_details->save();
        }

        $summary_of_transaction_ledger = new Summary_of_transaction_ledger([
            'customer_id' => $request->input('customer_id'),
            'so_number' => $request->input('sales_order_number'),
            'so_amount' => $request->input('so_amount'),
            'dr' => '',
            'ref_id' => $sales_order_saved_last_id,
            'check_no' => '',
            'check_date' => '',
            'collection' => '',
            'bo' => '',
            'image' => '',
            'remarks' => 'SO CASE',
            'date' => $date,
        ]);

        $summary_of_transaction_ledger->save();




        // foreach ($request->input('ending_inventory') as $key => $value) {
        //    $explode = explode('-', $value);
        //    $id = $explode[0];
        //    $ending_inventory = $explode[1];

        //    Sales_order_details::where('sales_order_id', $sales_order_saved_last_id)
        //       ->where('sku_id', $id)
        //       ->update(['ending_inventory' => $ending_inventory]);
        // }



        session(['sales_order_id' => $sales_order_saved_last_id]);
        session(['customer_id' => $request->input('customer_id')]);
        session(['principal_id' => $request->input('principal_id')]);
        session(['mode_of_transaction' => $request->input('mode_of_transaction')]);
        return redirect()->route('daily_routine_butal');
      

 
    }

   
}
