<?php

namespace App\Http\Controllers;
use App\Models\Bo;
use App\Models\Bo_details;
use App\Models\Summary_of_transaction_ledger;
use App\Models\User;
use App\Models\Sales_register_uploaded;
use App\Models\Sales_register_details;
use App\Models\Customer;
use App\Models\Customer_principal_code;
use App\Models\Principal;
use Illuminate\Http\Request;

class Bad_order_controller extends Controller
{
    public function index()
    {
    	if (isset(auth()->user()->id)) {
        	date_default_timezone_set('Asia/Manila');
            $date = date('Y-m-d');

          
            $agent = User::find(auth()->user()->id);      
            $customer =  Customer::get();
            $principal = Principal::get();
            return view('bad_order')->with('active','bad_order')
                                        ->with('agent',$agent)
                                        ->with('customer',$customer)
                                         ->with('principal',$principal)
                                        ;
        }else{
             return redirect()->route('login');
        }
    }

    public function bad_order_show_dr(Request $request)
    {
        $sales_register = Sales_register_uploaded::select('id','dr')->where('customer_id',$request->input('customer'))->get();

        return view('bad_order_show_dr_page',[
            'sales_register' => $sales_register,
        ])->with('customer',$request->input('customer'))
        ;
    }

    public function bad_order_proceed(Request $request)
    {

    	$sales_register_details = Sales_register_details::select('id','price','quantity','sku_id','sku_type')->where('sales_register_id',$request->input('sales_register_id'))->get();

        return view('daily_routine_bo_proceed_page',[
            'sales_register_details' => $sales_register_details,
        ])->with('sales_register_id',$request->input('sales_register_id'))
         ->with('customer_id',$request->input('customer'))
         ->with('principal_id',$request->input('principal_id'));
    }

    public function bad_order_proceed_to_final_summary(Request $request)
    {
       // return $request->input('customer_id');
       date_default_timezone_set('Asia/Manila');
       $date = date('Y-m-d');
       $time = date('His');

       $sales_register = Sales_register_uploaded::find($request->input('sales_register_id'));
       $customer_principal_code = Customer_principal_code::select('store_code')->where('customer_id',$request->input('customer_id'))->where('principal_id',$request->input('principal_id'))->first();
       $customer = Customer::select('id','store_name')->find($request->input('customer_id'));
       $bo_rgs_name = preg_replace('/[^A-Za-z0-9\-]/', '', $customer->store_name);

       return view('daily_routine_bo_proceed_final_summary')->with('bo_quantity',$request->input('bo_quantity'))
                                                            ->with('delivered_quantity',$request->input('delivered_quantity'))
                                                            ->with('description',$request->input('description'))
                                                            ->with('remarks',$request->input('remarks'))
                                                            ->with('rgs_quantity',$request->input('rgs_quantity'))
                                                            ->with('sku',$request->input('sku'))
                                                            ->with('sku_code',$request->input('sku_code'))
                                                            ->with('unit_of_measurement',$request->input('unit_of_measurement'))
                                                             ->with('customer_id',$request->input('customer_id'))
                                                              ->with('principal_id',$request->input('principal_id'))
                                                            ->with('unit_price',$request->input('unit_price'))
                                                            ->with('customer_principal_code',$customer_principal_code)
                                                            ->with('customer',$customer)
                                                            ->with('sales_register',$sales_register)
                                                            ->with('bo_rgs_name',$bo_rgs_name)
                                                            ->with('date',$date)
                                                            ->with('time',$time);
    }

    public function bad_order_save(Request $request)
    {
        //return $request->input();
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d');
        $bo_saved = new Bo([
                'bo_number' => $request->input('bo_number'),
                'customer_id' => $request->input('customer_id'),
                'principal_id' => $request->input('principal_id'),
                'total_amount' => $request->input('total_bo_amount'),
                'user_id' => auth()->user()->id,
                'date' => $date,
            ]);
        $bo_saved->save();
        $bo_saved_last_id = $bo_saved->id;

        $summary_of_transaction_ledger = new Summary_of_transaction_ledger([
            'customer_id' => $request->input('customer_id'),
            'so_number' => '',
            'so_amount' => '',
            'dr' => '',
            'ref_id' => $bo_saved_last_id,
            'check_no' => '',
            'check_date' => '',
            'collection' => '',
            'bo' => $request->input('total_bo_amount'),
            'image' => '',
            'remarks' => 'BO',
            'date' => $date,
        ]);

        $summary_of_transaction_ledger->save();



        foreach ($request->input('sku_id') as $key => $data) {
            if (is_null($request->input('remarks')[$data])) {
                $remarks = '';
            }else{
                $remarks = $request->input('remarks')[$data];
            }
             $bo_details_saved = new Bo_details([
               'bo_id' => $bo_saved_last_id,
               'sku_id' => $data,
               'rgs_quantity' => $request->input('rgs_quantity')[$data],
               'bo_quantity' => $request->input('bo_quantity')[$data],
               'price' => $request->input('unit_price')[$data],
               'remarks' => $remarks,
            ]);
            $bo_details_saved->save();
            
        }

        return redirect()->route('bad_order');
    }
}
