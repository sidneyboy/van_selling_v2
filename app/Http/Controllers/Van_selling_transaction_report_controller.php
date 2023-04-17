<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Van_selling_cancellation;
use App\Models\Van_selling_cancellation_details;
use App\Models\Van_selling_transaction;
use App\Models\Van_selling_transaction_details;
use App\Models\Van_selling_upload_ledger;
use App\Models\Van_selling_os_data;
use App\Models\Van_selling_calls;

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
            $van_selling_os_data = Van_selling_os_data::whereBetween('date', [$date_from, $date_to])->where('status', null)->get();
            return view('van_selling_os_data_report_customer_sales_generate_page', [
                'van_selling_os_data' => $van_selling_os_data,
            ])->with('date_from', $date_from)
                ->with('date_to', $date_to)
                ->with('time', $time)
                ->with('full_name', $request->input('full_name'))
                ->with('user_id', $request->input('user_id'));
        } elseif ($request->input('search_for') == 'CALLS') {
            $van_selling_calls = Van_selling_calls::whereBetween('date', [$date_from, $date_to])->get();
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
            $sku_code = $data->sku_code;
            $ledger = DB::select(DB::raw("SELECT * FROM(SELECT * FROM Van_selling_upload_ledgers WHERE sku_code = '$sku_code' ORDER BY id DESC LIMIT 1)Var1 ORDER BY id ASC"));
            $total = $data->quantity * $ledger[0]->unit_price;

            $van_selling_cancelation_details = new Van_selling_cancellation_details([
                'vs_cancelation_id' => $van_selling_cancelation->id,
                'sku_code' => $sku_code,
                'description' => $ledger[0]->description,
                'principal' => $ledger[0]->principal,
                'quantity' => $data->quantity,
                'unit_price' => $ledger[0]->unit_price,
                'unit_of_measurement' => $ledger[0]->unit_of_measurement,
            ]);

            $van_selling_cancelation_details->save();

            $van_selling_upload_ledger = new Van_selling_upload_ledger([
                'store_name' => $data->van_selling_transaction->store_name,
                'principal' =>  $ledger[0]->principal,
                'sku_code' => $sku_code,
                'description' => $ledger[0]->description,
                'unit_of_measurement' => $ledger[0]->unit_of_measurement,
                'sku_type' => $ledger[0]->sku_type,
                'butal_equivalent' => $ledger[0]->butal_equivalent,
                'reference' => $data->van_selling_transaction->delivery_receipt,
                'beg' => $ledger[0]->end,
                'van_load' => 0,
                'sales' => 0,
                'adjustments' => $data->quantity,
                'end' => $ledger[0]->end + $data->quantity,
                'unit_price' => $ledger[0]->unit_price,
                'total' => $total,
                'date' => $date,
                'status' => '',
                'status_cancel' => 'CANCELLED',
            ]);

            $van_selling_upload_ledger->save();
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
}
