<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Van_selling_upload_ledger;
use App\Models\Van_selling_transaction;
use App\Models\Van_selling_transaction_cm;
use App\Models\Van_selling_transaction_cm_details;
use Illuminate\Http\Request;

class Van_selling_credit_memo_controller extends Controller
{
    public function index()
    {
    	return view('van_selling_credit_memo')->with('active','van_selling_credit_memo');
    }

    public function van_selling_credit_memo_generate_dr_data(Request $request)
    {
    	$van_selling_transaction = Van_selling_transaction::where('delivery_receipt',$request->input('delivery_receipt'))->first();

    	if ($van_selling_transaction->status != 'CANCELLED') {
    		return view('van_selling_credit_memo_generate_dr_data_page',[
    			'van_selling_transaction' => $van_selling_transaction,
    		]);
    	}else{
    		return 'CANCELLED';
    	}
    }

    public function van_selling_credit_memo_proceed_to_final_summary(Request $request)
    {
        //return $request->input();
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d');
        $time = date('His');
        $export_code = 'VSCM-'.date('Ymd') ."-". $time;


        foreach ($request->input('details_id') as $key => $data) {
           if ($request->input('rgs_quantity')[$data] + $request->input('bo_quantity')[$data] > $request->input('quantity')[$data]) {
               return 'over_quantity_for_rgs_and_bo';
           }elseif ($request->input('rgs_quantity')[$data] > $request->input('quantity')[$data]) {
               return 'over_rgs_quantity';
           }elseif ($request->input('bo_quantity')[$data] > $request->input('quantity')[$data]) {
               return 'over_bo_quantity';
           }
        }

        $agent = User::select('name')->find(auth()->user()->id);  

        return view('van_selling_credit_memo_proceed_to_final_summary_page')
            ->with('details_id',$request->input('details_id'))
            ->with('bo_quantity',$request->input('bo_quantity'))
            ->with('description',$request->input('description'))
            ->with('quantity',$request->input('quantity'))
            ->with('remarks',$request->input('remarks'))
            ->with('rgs_quantity',$request->input('rgs_quantity'))
            ->with('sku_code',$request->input('sku_code'))
            ->with('unit_price',$request->input('unit_price'))
            ->with('van_selling_transaction_id',$request->input('van_selling_transaction_id'))
            ->with('delivery_receipt',$request->input('delivery_receipt'))
            ->with('user_id',auth()->user()->id)
            ->with('export_code',$export_code)
            ->with('agent',$agent)
            ->with('date',$date);
    }

    public function van_selling_credit_memo_save(Request $request)
    {
        
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d'); 

        $van_selling_cm_save = new Van_selling_transaction_cm([
            'van_selling_trans_id' => $request->input('van_selling_transaction_id'),
            'date' => $date,
            'user_id' => auth()->user()->id,
        ]);

        $van_selling_cm_save->save();
        $van_selling_cm_save_last_id = $van_selling_cm_save->id;

        foreach ($request->input('details_id') as $key => $data) {
           if($request->input('rgs_quantity')[$data] + $request->input('bo_quantity')[$data] * $request->input('unit_price')[$data] != 0){
                $van_selling_cm_details_save = new Van_selling_transaction_cm_details([
                    'vs_trans_cm_id' => $van_selling_cm_save_last_id,
                    'sku_code' => $request->input('sku_code')[$data],
                    'description' => $request->input('description')[$data],
                    'dr_quantity' => $request->input('quantity')[$data],
                    'rgs_quantity' => $request->input('rgs_quantity')[$data],
                    'bo_quantity' => $request->input('bo_quantity')[$data],
                    'unit_price' => $request->input('unit_price')[$data],
                    'remarks' => $request->input('remarks')[$data],
                ]);
                $van_selling_cm_details_save->save();
           }
        }

        return 'saved';
    }
}
