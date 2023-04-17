<?php

namespace App\Http\Controllers;
use App\Models\Agent_user;
use App\Models\Van_selling_van_load;
use Illuminate\Http\Request;

class Van_selling_ar_ledger_controller extends Controller
{
    public function index()
    {
    	$agent_user = Agent_user::first();
        return view('van_selling_ar_ledger')
            ->with('active','van_selling_ar_ledger')
            ->with('agent_user',$agent_user);
    }

    public function van_selling_ar_generate(Request $request)
    {   
        //return $request->input();
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d');
    	$van_selling_van_load = Van_selling_van_load::select('id','delivery_receipt','new_van_load','principal')->where('remarks','!=','printed')->get();


        return view('van_selling_ar_ledger_generate',[
            'van_selling_van_load' => $van_selling_van_load,
        ])->with('bo_not_submitted', str_replace(',', '', $request->input('bo_not_submitted')))
        ->with('bo_submitted',  str_replace(',', '',$request->input('bo_submitted')))
        ->with('total_shipment_stock',  str_replace(',', '',$request->input('total_shipment_stock')))
        ->with('less_cm',  str_replace(',', '',$request->input('less_cm')))
        ->with('less_remittance',  str_replace(',', '',$request->input('less_remittance')))
        ->with('prev_outstanding_balance',  str_replace(',', '',$request->input('prev_outstanding_balance')))
        ->with('stocks_on_hand',  str_replace(',', '',$request->input('stocks_on_hand')))
        ->with('total_outlet_visited',  str_replace(',', '',$request->input('total_outlet_visited')))
        ->with('debit',  str_replace(',', '',$request->input('debit')))
        ->with('charge_payment',  str_replace(',', '',$request->input('charge_payment')))
        ->with('agent_user',  $request->input('agent_user'))
        ->with('date',$date);
    }

    public function van_selling_ar_ledger_save(Request $request)
    {
        if ($request->input('id') != 'NONE') {
            foreach ($request->input('id') as $key => $data) {
                Van_selling_van_load::where('id', $data)
                  ->update(['remarks' => 'printed']);
            }
            return redirect('van_selling_transaction');
        }else{
            return redirect('van_selling_transaction');
        }
      
    }
}
