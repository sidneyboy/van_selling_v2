<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Principal;
use App\Models\Agent_applied_customer;
use App\Models\Location;
use App\Models\Customer;
use App\Models\Customer_principal_code;
use App\Models\Summary_of_transaction_ledger;
use App\Models\Customer_principal_price;
use App\Models\Sku_inventory;
use App\Models\Sales_order;
use App\Models\Sales_order_details;
use App\Models\Sales_register_uploaded;
use App\Models\Sales_register_details;
use Illuminate\Http\Request;
use DB;


class Daily_routine_butal_controller extends Controller
{
  public function index(Request $request)
  {
    //return $request->session()->all();
    if (isset(auth()->user()->id)) {
    	$agent = User::find(auth()->user()->id);
      $principal = Principal::find($request->session()->get('principal_id'));
      $customer = Customer::select('store_name')->find($request->session()->get('customer_id'));
      $customer_principal_code = Customer_principal_code::select('store_code')->where('customer_id',$request->session()->get('customer_id'))->where('principal_id',$request->session()->get('principal_id'))->first();
      $sku = Sku_inventory::select('id','sku_code','unit_of_measurement','description')->where('principal_id',$request->session()->get('principal_id'))->where('sku_type','butal')->get();

      return view('daily_routine_butal',[
            'sku' => $sku
          ])->with('active','daily_routine')
      								->with('agent',$agent)
      								->with('principal',$principal)
      								->with('customer',$customer)
      								->with('customer_principal_code',$customer_principal_code);
      }else{
             return redirect()->route('login');
      }
  }

  public function daily_routine_butal_proceed_to_suggested_so(Request $request)
  {
    //return $request->input();
    date_default_timezone_set('Asia/Manila');
    $date = date('Y-m-d');
   
    $sales_register_butal = Sales_register_uploaded::select('id')->where('customer_id',$request->session()->get('customer_id'))->latest()->first();
    $sales_register_details = Sales_register_details::where('sales_register_id',$sales_register_butal->id)->where('sku_type','Butal')->get();
    
    $sales_order_details = Sales_order_details::orderBy('sku_id','Desc')->where('sku_type','Butal')->groupBy('sku_id')->where('customer_id',$request->session()->get('customer_id'))->latest()->get();

    $counter = count($sales_register_details);

     foreach ($sales_order_details as $key => $data) {
        $sales_order_details_ending_inventory[$data->sku_id] = $data->ending_inventory;
      }

  


    $sku_data = Sku_inventory::findMany($request->input('sku'));

    $sku_counter = count($sku_data);
    
    return view('daily_routine_butal_proceed_to_suggested_so_page')->with('sales_register_butal',$sales_register_butal)
                                                              ->with('sales_register_details',$sales_register_details)
                                                              ->with('sku',$request->input('sku'))
                                                              ->with('description',$request->input('description'))
                                                              ->with('quantity',$request->input('quantity'))
                                                              ->with('remarks',$request->input('remarks'))
                                                              ->with('sku_code',$request->input('sku_code'))
                                                              ->with('store_code',$request->input('store_code'))
                                                              ->with('store_name',$request->input('store_name'))
                                                              ->with('unit_of_measurement',$request->input('unit_of_measurement'))
                                                              ->with('cm_quantity',$request->input('cm_quantity'))
                                                              ->with('sku_data',$sku_data)
                                                              ->with('sku_counter',$sku_counter)
                                                              // ->with('sales_order',$sales_order)
                                                              ->with('date',$date)
                                                              ->with('sales_order_details',$sales_order_details)
                                                              ->with('sales_order_details_ending_inventory',$sales_order_details_ending_inventory);

  }

  public function daily_routine_butal_proceed_to_final_summary(Request $request)
  {
    //return $request->input();

     date_default_timezone_set('Asia/Manila');
    $date = date('Y-m-d');
    $time = date('His');
    $sales_order_name = preg_replace('/[^A-Za-z0-9\-]/', '', $request->input('store_name'));
    $agent = User::find(auth()->user()->id);
    $customer = Customer::select('id','location_id')->find($request->session()->get('customer_id'));
    $principal = Principal::select('id','principal')->find($request->session()->get('principal_id'));
    $customer_principal_price = Customer_principal_price::select('price_level')->where('customer_id',$request->session()->get('customer_id'))->where('principal_id',$request->session()->get('principal_id'))->first();

    $sku_data = Sku_inventory::findMany($request->input('sku'));
    return view('daily_routine_butal_proceed_to_final_summary_page')->with('sku',$request->input('sku'))
                                                                    ->with('description',$request->input('description'))
                                                                    ->with('final_quantity_ordered',$request->input('final_quantity_ordered'))
                                                                    ->with('sku_code',$request->input('sku_code'))
                                                                    ->with('sku_type',$request->input('sku_type'))
                                                                    ->with('store_name',$request->input('store_name'))
                                                                    ->with('store_code',$request->input('store_code'))
                                                                    ->with('agent',$agent)
                                                                    ->with('customer',$customer)
                                                                    ->with('principal',$principal)
                                                                    ->with('sales_order_name',$sales_order_name)
                                                                    ->with('date',$date)
                                                                    ->with('customer_principal_price',$customer_principal_price)
                                                                    ->with('sku_data',$sku_data)
                                                                     ->with('time',$time)
                                                                    ->with('mode_of_transaction',$request->input('mode_of_transaction_butal'))
                                                                     ->with('ending_inventory',$request->input('ending_inventory'));
                                                                    
  }

  public function daily_routine_butal_save(Request $request)
  {
    

        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d');

        $sales_order = new Sales_order([
                    'user_id' => auth()->user()->id,
                    'customer_id' => $request->session()->get('customer_id'),
                    'sales_order_number' => $request->input('sales_order_number'),
                    'date' => $date,
                    'sku_type' => 'Butal',
                    'principal_id' => $request->input('principal_id'),
                    'mode_of_transaction' => $request->input('mode_of_transaction')
                    
                ]);
        $sales_order->save();
        $sales_order_saved_last_id = $sales_order->id;

        foreach ($request->input('sku') as $key => $data) {

            $sales_order_details = new Sales_order_details([
                    'sku_id' => $data,
                    'customer_id' => $request->session()->get('customer_id'),
                    'quantity' => $request->input('final_quantity_ordered')[$data],
                    'ending_inventory' => $request->input('ending_inventory')[$data],
                    'remarks' => '',
                    'sales_order_id' => $sales_order_saved_last_id,
                    'sku_type' => 'Butal',
                    'unit_of_measurement' => $request->input('unit_of_measurement')[$data],
                    'date' => $date,
                    'price' => $request->input('price')[$data],
                    
                ]);
            $sales_order_details->save();
        }

         $summary_of_transaction_ledger = new Summary_of_transaction_ledger([
            'customer_id' => $request->session()->get('customer_id'),
            'so_number' => $request->input('sales_order_number'),
            'so_amount' => $request->input('so_amount'),
            'dr' => '',
            'ref_id' => $sales_order_saved_last_id,
            'check_no' => '',
            'check_date' => '',
            'collection' => '',
            'bo' => '',
            'image' => '',
            'remarks' => 'SO BUTAL',
            'date' => $date,
        ]);

        $summary_of_transaction_ledger->save();

        //   foreach ($request->input('ending_inventory') as $key => $value) {
        //    $explode = explode('-', $value);
        //    $id = $explode[0];
        //    $ending_inventory = $explode[1];

        //    Sales_order_details::where('sales_order_id', $request->session()->get('sales_order_id'))
        //       ->where('sku_id', $id)
        //       ->update(['ending_inventory' => $ending_inventory]);
        // }

        return redirect()->route('daily_routine_collection');
  }
}
