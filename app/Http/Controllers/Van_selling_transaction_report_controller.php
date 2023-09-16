<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Van_selling_cancellation;
use App\Models\Van_selling_cancellation_details;
use App\Models\Van_selling_transaction;
use App\Models\Van_selling_transaction_details;
use App\Models\Van_selling_upload_ledger;
use App\Models\Vs_os;
use App\Models\Van_selling_calls;
use App\Models\Vs_upload_inventory;
use App\Models\Agent_user;
use DB;
use Illuminate\Http\Request;

class Van_selling_transaction_report_controller extends Controller
{
    public function index()
    {
        $agent_user = Agent_user::first();
        return view('Van_selling_transaction_report')
            ->with('active', 'van_selling_transaction_report')
            ->with('agent_user', $agent_user);
    }

    public function van_selling_transaction_report_generate(Request $request)
    {
        //return $request->input();
        $var = explode('-', $request->input('date_range'));
        $date_from = date('Y-m-d', strtotime($var[0]));
        $date_to = date('Y-m-d', strtotime($var[1]));
        $time = date('His');


        if ($request->input('search_for') == 'CUSTOMER_SALES_REPORT') {
            $van_selling_transaction = Van_selling_transaction::whereBetween('date', [$date_from, $date_to])->where('status', '!=', 'CANCELLED')->get();
            return view('van_selling_transaction_report_customer_sales_generate_page', [
                'van_selling_transaction' => $van_selling_transaction,
            ])->with('date_from', $date_from)
                ->with('date_to', $date_to)
                ->with('time', $time)
                ->with('full_name', $request->input('full_name'))
                ->with('user_id', $request->input('user_id'));
        } elseif ($request->input('search_for') == 'OS_REPORT') {
            $van_selling_os_data = Vs_os::whereBetween('date', [$date_from, $date_to])->where('status', null)->get();
            return view('van_selling_os_data_report_customer_sales_generate_page', [
                'van_selling_os_data' => $van_selling_os_data,
            ])->with('date_from', $date_from)
                ->with('date_to', $date_to)
                ->with('time', $time)
                ->with('full_name', $request->input('full_name'))
                ->with('user_id', $request->input('user_id'));
        } elseif ($request->input('search_for') == 'CALLS') {
            $van_selling_calls = Van_selling_calls::whereBetween('date', [$date_from, $date_to])
                ->where('status', null)
                ->get();
            $van_selling_productive_calls = Van_selling_calls::whereBetween('date', [$date_from, $date_to])
                ->where('remarks', 'PRODUCTIVE')
                ->count();

            $van_selling_unproductive_calls = Van_selling_calls::whereBetween('date', [$date_from, $date_to])
                ->where('remarks', 'UNPRODUCTIVE')
                ->count();

            return view('van_selling_calls_report', [
                'van_selling_calls' => $van_selling_calls,
                'van_selling_productive_calls' => $van_selling_productive_calls,
                'van_selling_unproductive_calls' => $van_selling_unproductive_calls,
            ])->with('date_from', $date_from)
                ->with('date_to', $date_to)
                ->with('time', $time)
                ->with('full_name', $request->input('full_name'))
                ->with('user_id', $request->input('user_id'));
        } else {
            $van_selling_transaction = Van_selling_transaction::whereBetween('date', [$date_from, $date_to])->where('status', '!=', 'CANCELLED')->get();
            return view('van_selling_transaction_report_details_customer_sales_generate_page', [
                'van_selling_transaction' => $van_selling_transaction,
            ])->with('date_from', $date_from)
                ->with('date_to', $date_to)
                ->with('time', $time)
                ->with('full_name', $request->input('full_name'))
                ->with('user_id', $request->input('user_id'));
        }
    }

    public function van_selling_transaction_report_cancel(Request $request)
    {
        //return $request->input();
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d');
        $van_selling_transaction_data = Van_selling_transaction_details::where('van_selling_trans_id', $request->input('van_selling_transaction_id'))->get();

        $van_selling_cancelation = new Van_selling_cancellation([
            'van_selling_trans_id' => $request->input('van_selling_transaction_id'),
            'remarks' => $request->input('text'),
            'date' => $date,
        ]);

        $van_selling_cancelation->save();

        foreach ($van_selling_transaction_data as $key => $data) {
            $sku_id = $data->sku_id;
            $sku_ledger = Vs_upload_inventory::where('sku_id', $data->sku_id)
                ->orderBy('id', 'desc')
                ->limit(1)
                ->first();



            $van_selling_cancelation_details = new Van_selling_cancellation_details([
                'vs_cancelation_id' => $van_selling_cancelation->id,
                'sku_code' => $data->sku_code,
                'description' => $sku_ledger->description,
                'principal' =>  $sku_ledger->principal,
                'quantity' => $data->quantity,
                'unit_price' => $sku_ledger->unit_price,
                'unit_of_measurement' => $sku_ledger->unit_of_measurement,
            ]);

            $van_selling_cancelation_details->save();



            $new_vs_inventory = new Vs_upload_inventory([
                'store_name' => $data->van_selling_transaction->store_name,
                'principal' =>  $sku_ledger->principal,
                'sku_code' => $sku_ledger->sku_code,
                'description' => $sku_ledger->description,
                'unit_of_measurement' => $sku_ledger->unit_of_measurement,
                'sku_type' => $sku_ledger->sku_type,
                'butal_equivalent' => $sku_ledger->butal_equivalent,
                'reference' => 'cancelled',
                'quantity' => $data->quantity,
                'running_balance' => $sku_ledger->running_balance + $data->quantity,
                'unit_price' => $sku_ledger->unit_price,
                'date' => $date,
                'status_cancel' => 'CANCELLED',
                'sku_id' => $sku_id,
            ]);

            $new_vs_inventory->save();
        }

        Van_selling_transaction::where('id', $request->input('van_selling_transaction_id'))
            ->update(['status' => 'CANCELLED']);

        return 'saved';
    }

    public function van_selling_transaction_report_print_table($id)
    {
        $var = explode('=', $id);
        $date_from = date('Y-m-d', strtotime($var[0]));
        $date_to = date('Y-m-d', strtotime($var[1]));

        $van_selling_transaction = Van_selling_transaction::whereBetween('date', [$date_from, $date_to])->get();

        return view('van_selling_transaction_report_print_table', [
            'van_selling_transaction' => $van_selling_transaction,
        ])->with('date_from', $date_from)
            ->with('date_to', $date_to);
    }

    public function van_selling_calls_report_export(Request $request)
    {
        foreach ($request->input('id') as $key => $data) {
            Van_selling_calls::where('id', $data)
                ->update(['status' => 'exported']);
        }

        return redirect('van_selling_transaction_report');
    }
}
