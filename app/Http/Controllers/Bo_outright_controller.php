<?php

namespace App\Http\Controllers;
use App\Models\Agent_user;
use App\Models\Van_selling_upload_ledger;
use App\Models\Van_selling_transaction;
use App\Models\Van_selling_transaction_details;
use App\Models\Van_selling_transaction_cart_details;
use App\Models\Van_selling_bo_outright;
use App\Models\Van_selling_bo_outright_details;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class Bo_outright_controller extends Controller
{
    public function index()
    {
    	Schema::disableForeignKeyConstraints();
        DB::table('van_selling_transaction_cart_details')->truncate();
        Schema::enableForeignKeyConstraints();
    	$agent_user = Agent_user::first();
        
    	return view('bo_outright')
            ->with('active','bo_outright')
            ->with('agent_user',$agent_user);
    }

    public function bo_outright_proceed_to_selection_of_invoice(Request $request)
    {
    	//return $request->input();
    	$var = explode('-', $request->input('date_range'));
        $date_from = date('Y-m-d',strtotime($var[0]));
        $date_to = date('Y-m-d',strtotime($var[1]));

        //need mag butang og where('status','!=','CANCELLED')
        $van_selling_transaction = Van_selling_transaction::select('id','store_name','delivery_receipt','total_amount')->whereBetween('date',[$date_from,$date_to])->where('status','!=','CANCELLED')->get();
        if ($van_selling_transaction) {
        	return view('bo_outright_proceed_to_selection_of_invoice_page',[
	        	'van_selling_transaction' => $van_selling_transaction,
	        ]);
        }else{
        	return 'NO_DATA_FOUND';
        }
    }

    public function bo_outright_proceed(Request $request)
    {
    	$van_selling_transaction = Van_selling_transaction::where('id',$request->input('van_selling_transaction_id'))->first();

    	$van_selling_details = Van_selling_upload_ledger::select('sku_code','description','unit_of_measurement','unit_price','butal_equivalent')->where('end','!=','0')->groupBy('sku_code')->get();

    	return view('bo_outright_proceed_page',[
    		'van_selling_transaction' => $van_selling_transaction,
    		'van_selling_details' => $van_selling_details,
    	])->with('van_selling_transaction_id',$request->input('van_selling_transaction_id'))
    	  ->with('user_id',$request->input('user_id'))
          ->with('full_name',$request->input('full_name'));
    }

    public function bo_outright_proceed_generate_sku_and_deduction(Request $request)
    {

    	
        foreach ($request->input('purchase_sku_code') as $key => $purchase_sku_code) {
            if ($request->input('bo_quantity')[$purchase_sku_code] > $request->input('purchase_quantity')[$purchase_sku_code]) {
                return '<center><span style="color:red;">BO QUANTITY CANNOT BE GREATER THAN PURCHASE QUANTITY!</span></center>';
            }
        }

        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d');
        $date_receipt = date('Y-m');

    	$sku_code = $request->input('sku_code');
        $ledger = DB::select(DB::raw("SELECT * FROM(SELECT * FROM Van_selling_upload_ledgers WHERE sku_code = '$sku_code' ORDER BY id DESC LIMIT 1)Var1 ORDER BY id ASC"));

        if ($request->input('quantity') > $ledger[0]->end) {
            return '<center>INSUFFICIENT QUANTITY OF <span style="color:blue;font-weight:bold;"> '. $sku_code ." ". $ledger[0]->description ."</span>. REMAINING QUANTITY IS ONLY <span style='color:blue;font-weight:bold;'>". $ledger[0]->end ."</span></center";
        }else{
            $van_selling_cart_check = Van_selling_transaction_cart_details::where('sku_code',$sku_code)->first();

            if ($van_selling_cart_check) {
                Van_selling_transaction_cart_details::where('sku_code', $sku_code)
                  ->update(['quantity' => $request->input('quantity')]);
            }else{
                $van_selling_transaction_cart_details = new Van_selling_transaction_cart_details([
                    'sku_code' => $sku_code,
                    'description' => $ledger[0]->description,
                    'principal' => $ledger[0]->principal,
                    'quantity' => $request->input('quantity'),
                    'unit_of_measurement' => $ledger[0]->unit_of_measurement,
                    'sku_type' =>$ledger[0]->sku_type,
                    'butal_equivalent' => $ledger[0]->butal_equivalent,
                    'beg' => $ledger[0]->end,
                    'price' => $ledger[0]->unit_price,
                    'user_id' => $request->input('user_id'),
                ]);
                $van_selling_transaction_cart_details->save();
            }
        }

        $van_selling_cart_data = Van_selling_transaction_cart_details::all();

        $van_selling_transaction = Van_selling_transaction::where('id',$request->input('van_selling_transaction_id'))->first();

        $van_selling_transaction_delivery_receipt = Van_selling_transaction::select('delivery_receipt')->latest()->first();
       
        if (!is_null($van_selling_transaction_delivery_receipt)) {
            $var_explode = explode('-', $van_selling_transaction_delivery_receipt->delivery_receipt);
            $series = $var_explode[4];
            $delivery_receipt = "VS-". $request->input('user_id') ."-". $date_receipt ."-". str_pad($series + 1,4,0, STR_PAD_LEFT);
        }else{
            $delivery_receipt = "VS-". $request->input('user_id') ."-". $date_receipt  ."-0001";
        }

        return view('bo_outright_proceed_generate_sku_and_deduction_page',[
        	'van_selling_cart_data' => $van_selling_cart_data,
        	'van_selling_transaction' => $van_selling_transaction,
        ])->with('customer_id',$request->input('customer_id'))
          ->with('full_address',$request->input('full_address'))
          ->with('full_name',$request->input('full_name'))
          ->with('unit_price',$request->input('unit_price'))
          ->with('store_name',$request->input('store_name'))
          ->with('store_type',$request->input('store_type'))
          ->with('user_id',$request->input('user_id'))
          ->with('delivery_receipt',$request->input('delivery_receipt'))
          ->with('date',$request->input('date'))
          ->with('bo_quantity',$request->input('bo_quantity'))
          ->with('date',$date)
          ->with('delivery_receipt',$delivery_receipt)
          ->with('van_selling_transaction_id',$request->input('van_selling_transaction_id'));
    }

    public function bo_outright_save_transaction(Request $request)
    {
        //return $request->input();
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d');

        $sum_amount = [];
        
        $van_selling_bo_outright_save = new Van_selling_bo_outright([
            'van_selling_trans_id' => $request->input('van_selling_transaction_id'),
            'total_bo_amount' => $request->input('total_bo_amount'),
            'delivery_receipt' => $request->input('delivery_receipt'),
            'date' => $date,
            'remarks' => '',
        ]);

        $van_selling_bo_outright_save->save();

        $van_selling_transaction_save = new Van_selling_transaction([
            'delivery_receipt' => $request->input('delivery_receipt'),
            'store_name' => $request->input('store_name'),
            'store_type' => $request->input('store_type'),
            'total_amount' => $request->input('total_amount'),
            'full_address' => $request->input('full_address'),
            'status' => 'PAID',
            'date' => $date,
        ]);

        $van_selling_transaction_save->save();
        $van_selling_cart_data = Van_selling_transaction_cart_details::all();

        //para ni sa bo_outright_details and van_selling_transaction_details
        foreach ($van_selling_cart_data as $key => $data) {
            $van_selling_transaction_details_save = new Van_selling_transaction_details([
                'van_selling_trans_id' => $van_selling_transaction_save->id,
                'description' => $data->description,
                'sku_code' => $data->sku_code,
                'quantity' => $data->quantity,
                'price' => $data->price,
                'amount' => $request->input('amount')[$data->sku_code],
                'status' => '',
                'remarks' => '',
            ]);
            $van_selling_transaction_details_save->save();

            $van_selling_upload_ledger_save = new Van_selling_upload_ledger([
                'store_name' => $request->input('store_name'),
                'principal' =>  $data->principal,
                'sku_code' => $data->sku_code,
                'description' => $data->description,
                'unit_of_measurement' => $data->unit_of_measurement,
                'sku_type' => $data->sku_type,
                'butal_equivalent' => $data->butal_equivalent,
                'reference' => $request->input('delivery_receipt'),
                'beg' => $data->beg,
                'van_load' => 0,
                'sales' => $data->quantity*-1,
                'adjustments' => 0,
                'end' => $data->beg - $data->quantity,
                'unit_price' => $data->price,
                'date' => $date,
                'status' => '',
                'status_cancel' => '',
            ]);
            $van_selling_upload_ledger_save->save();
        }

        //para ni sa bo add ni sa inventory
        foreach ($request->input('bo_sku_code') as $key => $data_bo_sku_code) {
            $ledger_bo = DB::select(DB::raw("SELECT * FROM(SELECT * FROM Van_selling_upload_ledgers WHERE sku_code = '$data_bo_sku_code' ORDER BY id DESC LIMIT 1)Var1 ORDER BY id ASC"));

            $van_selling_upload_ledger_bo_save = new Van_selling_upload_ledger([
                'store_name' => $request->input('store_name'),
                'principal' =>  $ledger_bo[0]->principal,
                'sku_code' => $ledger_bo[0]->sku_code,
                'description' => $ledger_bo[0]->description,
                'unit_of_measurement' => $ledger_bo[0]->unit_of_measurement,
                'sku_type' => $ledger_bo[0]->sku_type,
                'butal_equivalent' => $ledger_bo[0]->butal_equivalent,
                'reference' => $request->input('delivery_receipt'),
                'beg' => $ledger_bo[0]->beg,
                'van_load' => 0,
                'sales' => 0,
                'adjustments' => $request->input('bo_quantity')[$data_bo_sku_code],
                'end' => $ledger_bo[0]->beg + $request->input('bo_quantity')[$data_bo_sku_code],
                'unit_price' => $ledger_bo[0]->unit_price,
                'date' => $date,
                'status' => '',
                'status_cancel' => '',
            ]);
            $van_selling_upload_ledger_bo_save->save();

            
            $bo_outright_details_save = new Van_selling_bo_outright_details([
                'vs_bo_outright_id' => $van_selling_bo_outright_save->id,
                'sku_code' => $data_bo_sku_code,
                'principal' => '',
                'description' => $request->input('bo_description')[$data_bo_sku_code],
                'purchase_quantity' => $request->input('bo_purchase_quantity')[$data_bo_sku_code],
                'bo_quantity' => $request->input('bo_quantity')[$data_bo_sku_code],
                'unit_price' => $request->input('bo_unit_price')[$data_bo_sku_code],
            ]);

            $bo_outright_details_save->save();
            $amount = ($request->input('bo_purchase_quantity')[$data_bo_sku_code] - $request->input('bo_quantity')[$data_bo_sku_code]) * $request->input('bo_unit_price')[$data_bo_sku_code];
            $bo_quantity_amount = $request->input('bo_quantity')[$data_bo_sku_code] * $request->input('bo_unit_price')[$data_bo_sku_code];
            $sum_amount[] = $bo_quantity_amount;
            Van_selling_transaction_details::where('van_selling_trans_id', $request->input('van_selling_transaction_id'))
              ->where('sku_code', $data_bo_sku_code)
              ->update([
                'quantity' => $request->input('bo_purchase_quantity')[$data_bo_sku_code] - $request->input('bo_quantity')[$data_bo_sku_code],
                'amount' => $amount,
            ]);
        }

    

        Van_selling_transaction::where('id', $request->input('van_selling_transaction_id'))
              ->update([
                'total_amount' => $request->input('prev_total') - array_sum($sum_amount),
            ]);

        return redirect()->route('van_selling_transaction_report');

        
        
    }
}
