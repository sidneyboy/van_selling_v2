<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Van_selling_transaction;
use App\Models\Van_selling_transaction_details;
use App\Models\Van_selling_upload_ledger;
use App\Models\Van_selling_customer;
use App\Models\Van_selling_inventories;
use App\Models\Location;
use App\Models\Agent_user;
use App\Models\Van_selling_transaction_cart_details;
use App\Models\Van_selling_bo_deduction;
use App\Models\Van_selling_os_cart_details;
use App\Models\Van_selling_os_data;
use App\Models\Van_selling_calls;
use App\Models\Vs_upload_inventory;
use App\Models\Vs_os_inventories;
use App\Models\Vs_cart;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class Van_selling_transaction_controller extends Controller
{
    public function index()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('Vs_carts')->truncate();
        DB::table('Van_selling_os_cart_details')->truncate();
        Schema::enableForeignKeyConstraints();

        $agent_user = Agent_user::first();
        $location = Location::first();
        if (empty($agent_user)) {
            return redirect('agent_user');
        } else if (empty($location)) {
            return redirect('location');
        } else {
            $van_selling_customer = Van_selling_customer::get();
            $van_selling_customer_check = Van_selling_customer::where('status', null)->count();
            $principal = Vs_upload_inventory::select('principal')->groupBy('principal')->get();
            return view('van_selling_transaction', [
                'principal' => $principal,
                'van_selling_customer_check' => $van_selling_customer_check,
            ])->with('active', 'van_selling_transaction')
                ->with('agent_user', $agent_user)
                ->with('van_selling_customer', $van_selling_customer);
        }
    }

    public function van_selling_transaction_show_sku(Request $request)
    {
        //return $request->input();
        $principal = $request->input('principal');
        $sku = DB::select("SELECT * FROM Vs_upload_inventories WHERE id IN (SELECT MAX(id) FROM Vs_upload_inventories WHERE principal = '$principal'  GROUP BY sku_code)");
        $os_sku = Vs_os_inventories::select('sku_code', 'description', 'unit_price')->get();
        return view('van_selling_transaction_show_sku_page', [
            'sku' => $sku,
            'os_sku' => $os_sku,
        ]);
    }

    public function van_selling_transaction_proceed(Request $request)
    {
        //return $request->input();
        $sku_quantity = array_filter($request->input('sku_quantity'));
        $os_quantity = array_filter($request->input('os_quantity'));

        foreach ($sku_quantity as $checker_key => $checker_value) {
            if ($checker_value > $request->input('running_balance')[$checker_key]) {
                return 'Insufficient';
            }
        }

        foreach ($sku_quantity as $key => $data) {
            $cart_checker = Vs_cart::select('id')->where('sku_code', $key)->count();
            if ($cart_checker > 0) {
                Vs_cart::where('id', $cart_checker)
                    ->update(['quantity' => $data]);
            } else {
                $sku = Vs_os_inventories::where('sku_code', $key)->latest()->first();
                $vs_cart = new Vs_cart([
                    'sku_code' => $key,
                    'description' => $sku->description,
                    'principal' => $sku->principal,
                    'quantity' => $data,
                    'unit_of_measurement' => $sku->unit_of_measurement,
                    'sku_type' => $sku->sku_type,
                    'price' => $sku->unit_price
                ]);
                $vs_cart->save();
            }
        }

        foreach ($os_quantity as $os_key => $os_data) {
            # code...
        }

        $cart = Vs_cart::get();

        return view('van_selling_transaction_proceed_page',[
            'cart' => $cart,
        ]);
    }

    public function van_selling_transaction_summary(Request $request)
    {

        //return $request->input();

        if ($request->input('customer_selection') == 'NEW_CUSTOMER') {
            $check_customer_dup = Van_selling_customer::where('store_name', strtoupper($request->input('store_name')))->first();
            if ($check_customer_dup) {
                return 'existing';
            }
        }

        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d');
        $time = date('h:i:s a');
        $date_receipt = date('Y-m');

        $van_selling_transaction = Van_selling_transaction::select('delivery_receipt')->latest()->first();

        if (!is_null($van_selling_transaction)) {
            $var_explode = explode('-', $van_selling_transaction->delivery_receipt);
            $year_and_month = $var_explode[2] . "-" . $var_explode[3];
            $series = $var_explode[4];


            if ($date_receipt != $year_and_month) {
                $delivery_receipt = "VS-" . $request->input('user_id') . "-" . $date_receipt  . "-0001";
            } else {
                $delivery_receipt = "VS-" . $request->input('user_id') . "-" . $date_receipt . "-" . str_pad($series + 1, 4, 0, STR_PAD_LEFT);
            }
        } else {
            $delivery_receipt = "VS-" . $request->input('user_id') . "-" . $date_receipt  . "-0001";
        }

        $van_selling_cart_data = Van_selling_transaction_cart_details::all();

        $van_selling_os_cart_details = Van_selling_os_cart_details::all();

        $van_selling_os_data = Van_selling_os_data::select('sku_code')
            ->where('served_date', NULL)
            ->where('store_name', $request->input('store_name'))
            ->orderBy('id', 'desc')
            ->get();

        if (count($van_selling_os_data) != 0) {
            $van_selling_cart_os_data = Van_selling_transaction_cart_details::select('sku_code', 'quantity', 'price')->whereIn('sku_code', $van_selling_os_data->toArray())->get();
            foreach ($van_selling_cart_os_data as $key => $os_data_temp_quantity) {
                Van_selling_os_data::where('sku_code', $os_data_temp_quantity->sku_code)
                    ->where('served_date', NULL)
                    ->where('store_name', $request->input('store_name'))
                    ->orderBy('id', 'desc')
                    ->update([
                        'temp_quantity' => $os_data_temp_quantity->quantity,
                        'temp_unit_price' => $os_data_temp_quantity->price,
                    ]);
            }
        } else {
            $van_selling_cart_os_data = [];
        }

        return view('van_selling_transaction_summary_page', [
            'van_selling_cart_data' => $van_selling_cart_data,
            'van_selling_cart_os_data' => $van_selling_cart_os_data,
            'van_selling_os_cart_details' => $van_selling_os_cart_details,
        ])->with('customer_selection', $request->input('customer_selection'))
            ->with('store_id', $request->input('store_id'))
            ->with('full_name', $request->input('full_name'))
            ->with('user_id', $request->input('user_id'))
            ->with('pcm_number', strtoupper($request->input('pcm_number')))
            ->with('bo_amount', str_replace(',', '', $request->input('bo_amount')))
            ->with('delivery_receipt', $delivery_receipt)
            ->with('date', $date)
            ->with('time', $time)
            ->with('address', strtoupper($request->input('address')))
            ->with('barangay', strtoupper($request->input('barangay')))
            ->with('location', strtoupper($request->input('location_data')))
            ->with('store_name', strtoupper($request->input('store_name')))
            ->with('store_type', strtoupper($request->input('store_type')));
    }

    public function van_selling_transaction_summary_save(Request $request)
    {
        //return $request->input();
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d');

        //return $request->input();

        $explode = explode('-', $request->input('location'));
        $location_id = $explode[0];
        $location_data = $explode[1];

        $van_selling_os_data_code = uniqid();

        if ($request->input('total_amount') != 0) {
            //return 'asdasd';
            if ($request->input('customer_selection') == 'NEW_CUSTOMER') {
                $van_selling_customer = new Van_selling_customer([
                    'store_name' => $request->input('store_name'),
                    'store_type' => $request->input('store_type'),
                    'address' => $request->input('address'),
                    'location_id' => $location_id,
                    'barangay' => $request->input('barangay'),
                ]);

                $van_selling_customer->save();
            }

            $van_selling_transaction_save = new Van_selling_transaction([
                'delivery_receipt' => $request->input('delivery_receipt'),
                'store_name' => $request->input('store_name'),
                'store_type' => $request->input('store_type'),
                'total_amount' => $request->input('total_amount'),
                'full_address' => $location_id,
                'status' => 'PAID',
                'pcm_number' => $request->input('pcm_number'),
                'bo_amount' => $request->input('bo_amount'),
                'date' => $date,
                'remarks' => $request->input('date_time'),
                'address' => $request->input('address'),
                'barangay' => $request->input('barangay'),
            ]);

            $van_selling_transaction_save->save();

            $van_selling_cart_data = Van_selling_transaction_cart_details::all();

            foreach ($van_selling_cart_data as $key => $data) {
                if ($data->quantity != 0) {

                    $van_selling_transaction_details_save = new Van_selling_transaction_details([
                        'van_selling_trans_id' => $van_selling_transaction_save->id,
                        'description' => $data->description,
                        'principal' => $data->principal,
                        'sku_code' => $data->sku_code,
                        'quantity' => $data->quantity,
                        'price' => $data->price,
                        'amount' => $request->input('amount')[$data->sku_code],
                        'status' => '',
                        'remarks' => '',
                    ]);

                    $van_selling_transaction_details_save->save();

                    $van_selling_upload_ledger = new Van_selling_upload_ledger([
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
                        'sales' => $data->quantity * -1,
                        'adjustments' => 0,
                        'end' => $data->beg - $data->quantity,
                        'unit_price' => $data->price,
                        'date' => $date,
                        'status' => '',
                        'status_cancel' => '',
                    ]);

                    $van_selling_upload_ledger->save();
                }
            }

            $van_sellling_os_cart_data = Van_selling_os_cart_details::all();
            if (count($van_sellling_os_cart_data) != 0) {
                foreach ($van_sellling_os_cart_data as $key_2 => $os_data) {
                    $new_os_data = new Van_selling_os_data([
                        'van_selling_inventory_id' => $os_data->van_selling_os_sku->id,
                        'store_name' =>  $request->input('store_name'),
                        'sku_code' => $os_data->van_selling_os_sku->sku_code,
                        'description' => $os_data->van_selling_os_sku->description,
                        'quantity' => $os_data->quantity,
                        'principal' => $os_data->van_selling_os_sku->principal,
                        'date' => $date,
                        'code' => $van_selling_os_data_code,
                        'unit_price' => $os_data->unit_price,
                    ]);

                    $new_os_data->save();
                }
            }

            $new_calls = new Van_selling_calls([
                'store_name' => $request->input('store_name'),
                'location_id' => $location_data,
                'address' => $request->input('address'),
                'date' => $date,
                'remarks' => 'PRODUCTIVE',
            ]);

            $new_calls->save();
        } else {
            if ($request->input('customer_selection') == 'NEW_CUSTOMER') {
                $van_selling_customer = new Van_selling_customer([
                    'store_name' => strtoupper(str_replace(',', '', $request->input('store_name'))),
                    'store_type' => $request->input('store_type'),
                    'address' => strtoupper(str_replace(',', '', $request->input('address'))),
                    'location_id' => $location_id,
                    'barangay' => strtoupper(str_replace(',', '', $request->input('barangay'))),
                ]);

                $van_selling_customer->save();
            }

            $van_sellling_os_cart_data = Van_selling_os_cart_details::all();
            if (count($van_sellling_os_cart_data) != 0) {
                foreach ($van_sellling_os_cart_data as $key_2 => $os_data) {
                    $new_os_data = new Van_selling_os_data([
                        'van_selling_inventory_id' => $os_data->van_selling_os_sku->id,
                        'store_name' =>  $request->input('store_name'),
                        'sku_code' => $os_data->van_selling_os_sku->sku_code,
                        'description' => $os_data->van_selling_os_sku->description,
                        'quantity' => $os_data->quantity,
                        'principal' => $os_data->van_selling_os_sku->principal,
                        'date' => $date,
                        'code' => $van_selling_os_data_code,
                        'unit_price' => $os_data->unit_price,
                    ]);

                    $new_os_data->save();
                }
            }

            $new_calls = new Van_selling_calls([
                'store_name' => $request->input('store_name'),
                'location_id' => $location_data,
                'address' => $request->input('address'),
                'date' => $date,
                'remarks' => 'UNPRODUCTIVE',
            ]);

            $new_calls->save();
        }

        if ($request->input('van_selling_os_cart_data') == 'true') {
            $van_selling_os_data_to_update = Van_selling_os_data::select('id', 'temp_quantity', 'temp_unit_price')->where('store_name', $request->input('store_name'))->get();

            foreach ($van_selling_os_data_to_update as $key => $os_data_to_update) {
                Van_selling_os_data::where('store_name', $request->input('store_name'))
                    ->where('id', $os_data_to_update->id)
                    ->update([
                        'served_quantity' => $os_data_to_update->temp_quantity,
                        'served_date' => $date,
                        'served_unit_price' => $os_data_to_update->temp_unit_price,
                    ]);
            }
        }


        return redirect()->route('van_selling_transaction_report');
    }

    public function van_selling_transaction_unproductive_process(Request $request)
    {

        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d');

        $store_name = $request->input('store_name');
        $store_type = $request->input('store_type');
        $location = $request->input('location');
        $barangay = $request->input('barangay');
        $address = $request->input('address');


        if (!isset($store_name)) {
            return 'Fill Up Customer Data First';
        }

        if (!isset($store_type)) {
            return 'Fill Up Customer Data First';
        }

        if (!isset($location)) {
            return 'Fill Up Customer Data First';
        } else {
            $var_explode = explode('-', $location);
            $location_id = $var_explode[0];
            $location_data = $var_explode[1];
        }

        if (!isset($barangay)) {
            return 'Fill Up Customer Data First';
        }

        if (!isset($address)) {
            return 'Fill Up Customer Data First';
        }

        $new = new Van_selling_calls([
            'store_name' => $store_name,
            'location_id' => $location_data,
            'address' => $address,
            'date' => $date,
            'remarks' => 'UNPRODUCTIVE',
        ]);

        $new->save();

        $van_selling_customer = new Van_selling_customer([
            'store_name' => strtoupper(str_replace(',', '', $store_name)),
            'store_type' => $request->input('store_type'),
            'address' => strtoupper(str_replace(',', '', $address)),
            'location_id' => $location_id,
            'barangay' => strtoupper(str_replace(',', '', $barangay)),
        ]);



        $van_selling_customer->save();

        return 'saved';
    }
}
