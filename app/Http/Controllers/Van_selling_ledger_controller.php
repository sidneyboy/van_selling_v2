<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Van_selling_upload;
use App\Models\Van_selling_upload_ledger;
use App\Models\Van_selling_transaction_details;
use App\Models\Van_selling_upload_transaction;
use App\Models\Customer;
use App\Models\Agent_user;
use DB;
use Illuminate\Http\Request;

class Van_selling_ledger_controller extends Controller
{
    public function index()
    {

        $agent_user = Agent_user::first();
        $sku_ledger = DB::select("SELECT * FROM Vs_upload_inventories WHERE id IN (SELECT MAX(id) FROM Vs_upload_inventories GROUP BY sku_code)");
        return view('van_selling_ledger', [
            'sku_ledger' => $sku_ledger,
        ])->with('active', 'van_selling_ledger')
            ->with('agent_user', $agent_user);
    }

    public function van_selling_ledger_generate(Request $request)
    {
        //return $request->input();
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d');
        $time = date('His');
        $var = explode('-', $request->input('date_range'));
        $date_from = date('Y-m-d', strtotime($var[0]));
        $date_to = date('Y-m-d', strtotime($var[1]));



        // $counter = count($van_selling_details);

        // if ($counter != 0) {
        //     foreach ($van_selling_details as $key => $data) {
        //         $new_query_for_van_selling_ledger[] = Van_selling_upload_ledger::select('sku_code','butal_equivalent','unit_price')->where('sku_code',$data->sku_code)->latest()->first();
        //     }

        //     return view('van_selling_ledger_generate_page',[
        //         'van_selling_details' => $van_selling_details,
        //         'new_query_for_van_selling_ledger' => $new_query_for_van_selling_ledger,
        //     ])->with('counter', $counter)
        //       ->with('date_from',$date_from)
        //       ->with('date_to', $date_to)
        //       ->with('date', $date)
        //       ->with('time', $time)
        //       ->with('agent_user',$request->input('agent_user'))
        //        ->with('principal', $request->input('principal'));
        // }else{
        //     return 'NO_DATA_FOUND';
        // }
    }

    public function van_selling_ledger_show_details(Request $request)
    {
        //return $request->input();
        $explode = explode(',', $request->input('data'));
        $sku_code = $explode[0];
        $date_from = $explode[1];
        $date_to = $explode[2];

        $van_selling_details = Van_selling_upload_ledger::select('principal', 'sku_code', 'unit_of_measurement', 'description', 'beg', 'butal_equivalent', 'beg', 'van_load', 'sales', 'date', 'unit_price', 'end', 'reference', 'status_cancel', 'adjustments')->where('sku_code', $sku_code)->whereBetween('date', [$date_from, $date_to])->get();

        return view('van_selling_ledger_show_details_page', [
            'van_selling_details' => $van_selling_details,
        ])->with('date_from', $date_from)
            ->with('date_to', $date_to);
    }

    public function van_selling_ledger_update_status(Request $request)
    {

        foreach ($request->input('sku_code') as $key => $data) {
            Van_selling_upload_ledger::where('sku_code', $data)
                ->whereBetween('date', [$request->input('date_from'), $request->input('date_to')])
                ->update(['status' => 'exported']);
        }
    }
}
