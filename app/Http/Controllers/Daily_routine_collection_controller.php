<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Principal;
use App\Models\Agent_applied_customer;
use App\Models\Location;
use App\Models\Customer;
use App\Models\Sku_inventory;
use App\Models\Sales_order;
use App\Models\Sales_order_details;
use App\Models\Ar_ledger;
use App\Models\Sales_register_details;
use App\Models\Collection;
use App\Models\Collection_details;
use App\Models\Collection_referal;
use App\Models\Collection_cash_check;
use App\Models\Customer_principal_code;
use App\Models\Summary_of_transaction_ledger;
use DB;
use Illuminate\Http\Request;


class Daily_routine_collection_controller extends Controller
{
    public function index(Request $request)
    { 
       if (isset(auth()->user()->id)) {
        $customer = Customer::select('store_name','id')->find($request->session()->get('customer_id'));
        $ar_ledger = Ar_ledger::select('delivery_receipt')->groupBy('delivery_receipt')->get();

      
        foreach ($ar_ledger as $key => $data) {
            $delivery_receipt = $data->delivery_receipt;
            $ledger_results = DB::select(DB::raw("SELECT * FROM (SELECT * FROM Ar_ledgers WHERE delivery_receipt = '$delivery_receipt' ORDER BY id DESC LIMIT 1)Var1 ORDER BY id ASC"));

            $array_delivery_receipt[] = $ledger_results[0]->delivery_receipt;
            $array_final_balance[] = $ledger_results[0]->final_balance;
            $array_id[] = $ledger_results[0]->id;
            $array_counter[] = 1;
        }
        
          $agent = User::find(auth()->user()->id);
          return view('daily_routine_collection')->with('active','daily_routine')
                                      ->with('agent',$agent)
                                      ->with('customer',$customer)
                                      ->with('ar_ledger',$ar_ledger)
                                      ->with('array_delivery_receipt',$array_delivery_receipt)
                                      ->with('array_final_balance',$array_final_balance)
                                      ->with('array_id',$array_id)
                                      ->with('array_counter',$array_counter);
        }else{
          return redirect()->route('login');
        }
    }

    public function daily_routine_collection_proceed(Request $request)
    {

        // /return $request->input();

        $or_check = Collection::select('or_number')->where('or_number',$request->input('or_number'))->first();
        if ($or_check) {
         return 'EXISTING_OR_NUMBER';
        }else{
          $ar_ledger_data = $request->input('ar_ledger_data');
          if (isset($ar_ledger_data)) {
              foreach ($request->input('ar_ledger_data') as $key => $data) {
                  $explode = explode('/', $data);
                  $ar_ledger_id[] = $explode[0];
                  $delivery_receipt[] = $explode[1];
                  $final_balance[] = $explode[2];
              }

              $counter = count($request->input('ar_ledger_data'));
              $sales_register_status = 'set';
              return view('daily_routine_collection_proceed_page')->with('ar_ledger_id',$ar_ledger_id)
                                                              ->with('delivery_receipt',$delivery_receipt)
                                                              ->with('final_balance',$final_balance)
                                                              ->with('sales_register_status',$sales_register_status)
                                                              ->with('counter',$counter)
                                                              ->with('less_referals',$request->input('less_referals'))
                                                              ->with('particulars',$request->input('particulars'))
                                                              ->with('or_number',$request->input('or_number'));
          }else{
              $sales_register_status = 'not_set';
              return view('daily_routine_collection_proceed_page')->with('sales_register_status',$sales_register_status)
                                                              ->with('less_referals',$request->input('less_referals'))
                                                              ->with('particulars',$request->input('particulars'))
                                                              ->with('or_number',$request->input('or_number'));
          }
        }


    }

    public function daily_routine_collection_proceed_to_final_summary(Request $request)
    {
      
       date_default_timezone_set('Asia/Manila');
       $date = date('Y-m-d');


      if ($request->input('sales_register_status') == 'set') {
          foreach ($request->input('ar_ledger_id') as $key => $data) {
             $locpd_cash[$data] = str_replace(',', '', $request->input('locpd_cash')[$data]);
             $locpd_check[$data] = str_replace(',', '', $request->input('locpd_check')[$data]);
          }

          for ($i=0; $i < $request->input('less_referals'); $i++) { 
             $less_refer_cash = str_replace(',', '', $request->input('less_refer_cash'));
             $less_refer_check = str_replace(',', '', $request->input('less_refer_check'));
          }

          for ($i=0; $i < $request->input('particulars'); $i++) { 
             $particular_amount = str_replace(',', '', $request->input('amount'));
          }

             $agent = User::find(auth()->user()->id);

       return view('daily_routine_collection_proceed_to_final_summary_page')
                   ->with('amount',$request->input('amount'))
                   ->with('check_no',$request->input('check_no'))
                   ->with('counter',$request->input('counter'))
                   ->with('date_collected',$request->input('date_collected'))
                   ->with('less_refer_agent',$request->input('less_refer_agent'))
                   ->with('less_refer_dr',$request->input('less_refer_dr'))
                   ->with('less_refer_principal',$request->input('less_refer_principal'))
                   ->with('less_refer_remarks',$request->input('less_refer_remarks'))
                   ->with('less_referals',$request->input('less_referals'))
                   ->with('locpd_cash',$request->input('locpd_cash'))
                   ->with('locpd_check',$request->input('locpd_check'))
                   ->with('locpd_delivery_receipt',$request->input('locpd_delivery_receipt'))
                   ->with('locpd_remarks',$request->input('locpd_remarks'))
                   ->with('locpd_total_amount',$request->input('locpd_total_amount'))
                   ->with('particulars',$request->input('particulars'))
                   ->with('remarks',$request->input('remarks'))
                   ->with('ar_ledger_id',$request->input('ar_ledger_id'))
                   ->with('locpd_cash',$locpd_cash)
                   ->with('locpd_check',$locpd_check)
                   ->with('less_refer_cash',$less_refer_cash)
                   ->with('less_refer_check',$less_refer_check)
                   ->with('particular_amount',$particular_amount)
                   ->with('particular_cash_or_check',$request->input('particular_cash_or_check'))
                   ->with('bank',$request->input('bank'))
                   ->with('sales_register_status', $request->input('sales_register_status'))
                   ->with('or_number', $request->input('or_number'))
                   ->with('agent', $agent);
          
      }else{

         for ($i=0; $i < $request->input('particulars'); $i++) { 
             $particular_amount = str_replace(',', '', $request->input('amount'));
         }

         if ($request->input('less_referals') != 0) {
          for ($i=0; $i < $request->input('less_referals'); $i++) {
            $less_refer_cash = str_replace(',', '', $request->input('less_refer_cash'));
            $less_refer_check = str_replace(',', '', $request->input('less_refer_check'));
          }
         }else{
            $less_refer_cash = 0;
            $less_refer_check = 0;
         }

          $agent = User::find(auth()->user()->id);


            return view('daily_routine_collection_proceed_to_final_summary_page')
                   ->with('amount',$request->input('amount'))
                   ->with('check_no',$request->input('check_no'))
                   ->with('counter',$request->input('counter'))
                   ->with('date_collected',$request->input('date_collected'))
                   ->with('less_refer_agent',$request->input('less_refer_agent'))
                   ->with('less_refer_dr',$request->input('less_refer_dr'))
                   ->with('less_refer_principal',$request->input('less_refer_principal'))
                   ->with('less_refer_remarks',$request->input('less_refer_remarks'))
                   ->with('less_referals',$request->input('less_referals'))
                   ->with('particulars',$request->input('particulars'))
                   ->with('remarks',$request->input('remarks'))
                   ->with('less_refer_cash',$less_refer_cash)
                   ->with('less_refer_check',$less_refer_check)
                   ->with('particular_amount',$particular_amount)
                   ->with('particular_cash_or_check',$request->input('particular_cash_or_check'))
                   ->with('bank',$request->input('bank'))
                   ->with('sales_register_status', $request->input('sales_register_status'))
                   ->with('or_number', $request->input('or_number'))
                   ->with('agent', $agent);


      }

   
    }

    public function daily_routine_collection_end_and_proceed(Request $request)
    {
        
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d');
          
        if ($request->input('sales_register_status') == 'set') {


              $collection_save = new Collection([
                'date_collected' => $date,
                'total_amount_collected' => $request->input('total_collected_sum_total'),
                'customer_id' => $request->session()->get('customer_id'),
                'principal_id' => $request->session()->get('principal_id'),
                'user_id' => auth()->user()->id,
                'or_number' => $request->input('or_number'),
              ]);

              $collection_save->save();
              $collection_save_last_id = $collection_save->id;
              
              for ($i=0; $i < $request->input('particulars'); $i++) { 
                    $collection_cash_check = new Collection_cash_check([
                      'collection_id' => $collection_save_last_id,
                      'particulars' => $request->input('particular_cash_or_check')[$i],
                      'check_no' => $request->input('check_no')[$i],
                      'bank' => $request->input('bank')[$i],
                      'check_date' => $request->input('check_date')[$i],
                      'amount' => $request->input('particular_amount')[$i],
                      'remarks' => $request->input('remarks')[$i],
                    ]);  

                    $collection_cash_check->save();
              }

              foreach ($request->input('ar_ledger_id') as $key => $data) {
                  $collection_details = new Collection_details([
                    'collection_id' => $collection_save_last_id,
                    'total_dr_amount' => $request->input('locpd_total_amount')[$data],
                    'cash' => $request->input('locpd_cash')[$data],
                    'check' => $request->input('locpd_check')[$data],
                    'remarks' => $request->input('locpd_remarks')[$data],
                    'delivery_receipt' => $request->input('locpd_delivery_receipt')[$data],
                    'over_payment' => $request->input('locpd_over_payment')[$data],
                  ]);

                  $collection_details->save();
              }

              // for ($i=0; $i < $request->input('particular_counter'); $i++) { 
              //     $collection_refer_details = new Collection_details([
              //       'collection_id' => $collection_save_last_id,
              //       'total_dr_amount' => $request->input('particular_refer_total_amount')[$i],
              //       'cash' => $request->input('particular_refer_cash')[$i],
              //       'check' => $request->input('particular_refer_check')[$i],
              //       'remarks' => $request->input('particular_refer_remarks')[$i],
              //       'delivery_receipt' => $request->input('particular_refer_delivery_receipt')[$i],
              //       'over_payment' => $request->input('particular_refer_over_payment')[$i],
              //     ]);

              //     $collection_refer_details->save();
              // }

              for ($i=0; $i < $request->input('less_referals'); $i++) { 
                 $collection_referals = new Collection_referal([
                    'collection_id' => $collection_save_last_id,
                    'refer_agent' => $request->input('less_refer_agent')[$i],
                    'refer_delivery_receipt' => $request->input('less_refer_delivery_receipt')[$i],
                    'refer_principal' => $request->input('less_refer_principal')[$i],
                    'refer_cash' => $request->input('less_refer_cash')[$i],
                    'refer_check' => $request->input('less_refer_check')[$i],
                    'refer_remarks' => $request->input('less_refer_remarks')[$i],
                 ]);

                 $collection_referals->save();
              }

              $summary_of_transaction_ledger = new Summary_of_transaction_ledger([
                  'customer_id' => $request->session()->get('customer_id'),
                  'so_number' => '',
                  'so_amount' => '',
                  'dr' => '',
                  'ref_id' => $collection_save_last_id,
                  'check_no' => '',
                  'check_date' => '',
                  'collection' => $request->input('total_collected_sum_total'),
                  'bo' => '',
                  'image' => '',
                  'remarks' => 'COLLECTION',
                  'date' => $date,
              ]);

              $summary_of_transaction_ledger->save();
              

              return redirect()->route('daily_routine_bo');
        }else{
              $collection_save = new Collection([
                'date_collected' => $date,
                'total_amount_collected' => $request->input('total_collected_sum_total'),
                'customer_id' => $request->session()->get('customer_id'),
                'principal_id' => $request->session()->get('principal_id'),
                'user_id' => auth()->user()->id,
                'or_number' => $request->input('or_number'),
              ]);

              $collection_save->save();
              $collection_save_last_id = $collection_save->id;

              for ($i=0; $i < $request->input('particulars'); $i++) { 
                    $collection_cash_check = new Collection_cash_check([
                      'collection_id' => $collection_save_last_id,
                      'particulars' => $request->input('particular_cash_or_check')[$i],
                      'check_no' => $request->input('check_no')[$i],
                      'bank' => $request->input('bank')[$i],
                      'check_date' => $request->input('check_date')[$i],
                      'amount' => $request->input('particular_amount')[$i],
                      'remarks' => $request->input('remarks')[$i],
                    ]);  

                    $collection_cash_check->save();
              }

              for ($i=0; $i < $request->input('particular_counter'); $i++) { 
                  $collection_refer_details = new Collection_details([
                    'collection_id' => $collection_save_last_id,
                    'total_dr_amount' => $request->input('particular_refer_total_amount')[$i],
                    'cash' => $request->input('particular_refer_cash')[$i],
                    'check' => $request->input('particular_refer_check')[$i],
                    'remarks' => $request->input('particular_refer_remarks')[$i],
                    'delivery_receipt' => $request->input('particular_refer_delivery_receipt')[$i],
                    'over_payment' => $request->input('particular_refer_over_payment')[$i],
                  ]);

                  $collection_refer_details->save();
              }

              for ($i=0; $i < $request->input('less_referals'); $i++) { 
                 $collection_referals = new Collection_referal([
                    'collection_id' => $collection_save_last_id,
                    'refer_agent' => $request->input('less_refer_agent')[$i],
                    'refer_delivery_receipt' => $request->input('less_refer_delivery_receipt')[$i],
                    'refer_principal' => $request->input('less_refer_principal')[$i],
                    'refer_cash' => $request->input('less_refer_cash')[$i],
                    'refer_check' => $request->input('less_refer_check')[$i],
                    'refer_remarks' => $request->input('less_refer_remarks')[$i],
                 ]);

                 $collection_referals->save();
              }

               $summary_of_transaction_ledger = new Summary_of_transaction_ledger([
                  'customer_id' => $request->session()->get('customer_id'),
                  'so_number' => '',
                  'so_amount' => '',
                  'dr' => '',
                  'ref_id' => $collection_save_last_id,
                  'check_no' => '',
                  'check_date' => '',
                  'collection' => $request->input('total_collected_sum_total'),
                  'bo' => '',
                  'image' => '',
                  'remarks' => 'COLLECTION',
                  'date' => $date,
              ]);

              $summary_of_transaction_ledger->save();
              return redirect()->route('daily_routine_bo');
        }
        
       
        


    }
}
