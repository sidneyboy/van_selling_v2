<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Agent_user;
use App\Models\Vs_os;
use App\Models\Vs_upload_inventory;
use Illuminate\Http\Request;

class Van_selling_os_transaction_controller extends Controller
{
    public function index()
    {
        $agent_user = Agent_user::first();
        $location = Location::first();
        if (empty($agent_user)) {
            return redirect('agent_user');
        } else if (empty($location)) {
            return redirect('location');
        } else {
            $os = Vs_os::select('os_code', 'store_name', 'date')->groupBy('os_code')->orderBy('id', 'desc')->get();
            return view('van_selling_os_transaction', [
                'os' => $os,
            ])->with('active', 'van_selling_os_transaction')
                ->with('agent_user', $agent_user);
        }
    }

    public function van_selling_os_transaction_proceed(Request $request)
    {
        $os = Vs_os::where('os_code', $request->input('os_code'))->get();
        foreach ($os as $key => $data) {
            $inventory = Vs_upload_inventory::select('sku_code', 'running_balance', 'unit_price')
                ->where('sku_code', $data->sku_code)
                ->latest()
                ->first();

            $running_inventory[$data->sku_code] = $inventory->running_balance;
            $unit_price[$data->sku_code] = $inventory->unit_price;
        }

        //return $running_inventory;

        return view('van_selling_os_transaction_proceed', [
            'os' => $os,
            'running_inventory' => $running_inventory,
            'unit_price' => $unit_price,
        ])->with('os_code', $request->input('os_code'));
    }

    public function van_selling_os_transaction_summary(Request $request)
    {
        //return $request->input();
        $served_quantity = array_filter($request->input('served_quantity'));

        foreach ($served_quantity as $checker_key => $checker_value) {
            if ($checker_value > $request->input('running_inventory')[$checker_key]) {
                return 'Insufficient';
            }
        }

        $os = Vs_os::where('os_code', $request->input('os_code'))
            ->whereIn('sku_code', array_keys($served_quantity))
            ->get();

        return view('van_selling_os_transaction_summary', [
            'served_quantity' => $served_quantity,
            'unit_price' => $request->input('unit_price'),
            'os' => $os,
        ])->with('os_code', $request->input('os_code'));
    }

    public function van_selling_os_transaction_final_summary(Request $request)
    {
        $served_quantity = array_filter($request->input('served_quantity'));

        $os = Vs_os::where('os_code', $request->input('os_code'))
            ->whereIn('sku_code', array_keys($served_quantity))
            ->get();

        return view('van_selling_os_transaction_final_summary', [
            'served_quantity' => $served_quantity,
            'unit_price' => $request->input('unit_price'),
            'os' => $os,
        ])->with('os_code', $request->input('os_code'));
    }
}
