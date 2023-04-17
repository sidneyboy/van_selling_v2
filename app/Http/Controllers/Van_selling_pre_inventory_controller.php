<?php

namespace App\Http\Controllers;
use App\Models\Agent_user;
use DB;
use App\Models\Van_selling_upload_ledger;
use Illuminate\Http\Request;

class Van_selling_pre_inventory_controller extends Controller
{
    public function index()
    {
        $agent_user = Agent_user::first();
        $principal = Van_selling_upload_ledger::select('principal')->where('end', '!=', '0')->groupBy('principal')->get();
        return view('van_selling_pre_inventory',[
            'principal' => $principal,
        ])->with('active','van_selling_pre_inventory')
          ->with('agent_user',$agent_user);
                                        
    }

    public function van_selling_pre_inventory_generate_sku(Request $request)
    {
        $sku_data = Van_selling_upload_ledger::select('sku_code','description')->where('principal',$request->input('principal'))->groupBy('sku_code')->get();

        return view('van_selling_pre_inventory_generate_sku_page',[
            'sku_data' => $sku_data,
        ])->with('principal',$request->input('principal'));
    }

    public function van_selling_pre_inventory_generate_summary(Request $request)
    {
        // $request->input();
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d');

        $agent_user = Agent_user::select('full_name')->first();
        return view('van_selling_pre_inventory_generate_summary_page',[
            'sku_code' => $request->input('sku_code'),
            'quantity' => $request->input('quantity'),
            'remarks' => $request->input('remarks'),
        ])->with('date',$date)
          ->with('agent_user',$agent_user)
          ->with('principal',$request->input('principal'));
    }
}
