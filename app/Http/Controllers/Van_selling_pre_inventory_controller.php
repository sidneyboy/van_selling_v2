<?php

namespace App\Http\Controllers;
use App\Models\Agent_user;
use DB;
use App\Models\Vs_upload_inventory;
use Illuminate\Http\Request;

class Van_selling_pre_inventory_controller extends Controller
{
    public function index()
    {
        $agent_user = Agent_user::first();
        $principal = Vs_upload_inventory::select('principal')->groupBy('principal')->get();
        return view('van_selling_pre_inventory',[
            'principal' => $principal,
        ])->with('active','van_selling_pre_inventory')
          ->with('agent_user',$agent_user);
                                        
    }

    public function van_selling_pre_inventory_generate_sku(Request $request)
    {
        $sku_data = Vs_upload_inventory::select('sku_code','description','sku_type','sku_id')->where('principal',$request->input('principal'))->groupBy('sku_id')->get();

        return view('van_selling_pre_inventory_generate_sku_page',[
            'sku_data' => $sku_data,
        ])->with('principal',$request->input('principal'));
    }

    public function van_selling_pre_inventory_generate_summary(Request $request)
    {
        //return $request->input();
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d');

        $agent_user = Agent_user::select('full_name')->first();
        return view('van_selling_pre_inventory_generate_summary_page',[
            'sku_code' => $request->input('sku_code'),
            'sku_id' => $request->input('sku_id'),
            'quantity' => $request->input('quantity'),
            'remarks' => $request->input('remarks'),
        ])->with('date',$date)
          ->with('agent_user',$agent_user)
          ->with('principal',$request->input('principal'));
    }
}
