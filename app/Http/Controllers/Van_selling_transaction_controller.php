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
use App\Models\Vs_os_cart;
use App\Models\Vs_os;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class Van_selling_transaction_controller extends Controller
{
    public function index()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('Vs_carts')->truncate();
        DB::table('Vs_os_carts')->truncate();
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

        if ($sku) {
            for ($i = 0; $i < count($sku); $i++) {
                $not_included[] = $sku[$i]->sku_code;
            }
            $os_sku = Vs_os_inventories::select('sku_code', 'description', 'unit_price')
                ->whereNotIn('sku_code', $not_included)
                ->get();
        } else {
            $os_sku = Vs_os_inventories::select('sku_code', 'description', 'unit_price')
                ->get();
        }



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

        foreach ($sku_quantity as $key => $quantity_data) {
            $cart_checker = Vs_cart::select('id')->where('sku_code', $key)->first();
            if ($cart_checker) {
                Vs_cart::where('id', $cart_checker->id)
                    ->update(['quantity' => $quantity_data]);
            } else {
                $sku = Vs_upload_inventory::where('sku_code', $key)->orderBy('id', 'desc')
                    ->limit(1)
                    ->first();
                $vs_cart = new Vs_cart([
                    'sku_code' => $key,
                    'description' => $sku->description,
                    'principal' => $sku->principal,
                    'quantity' => $quantity_data,
                    'unit_of_measurement' => $sku->unit_of_measurement,
                    'sku_type' => $sku->sku_type,
                    'price' => $sku->unit_price
                ]);
                $vs_cart->save();
            }
        }

        foreach ($os_quantity as $os_key => $os_quantity) {
            $os_cart_checker = Vs_os_cart::select('id')->where('sku_code', $os_key)->first();
            if ($os_cart_checker) {
                Vs_os_cart::where('id', $os_cart_checker->id)
                    ->update(['quantity' => $os_quantity]);
            } else {
                $new_os_cart = new Vs_os_cart([
                    'sku_code' => $os_key,
                    'quantity' => $os_quantity,
                ]);

                $new_os_cart->save();
            }
        }

        $cart = Vs_cart::get();
        $os_cart = Vs_os_cart::get();

        if ($request->input('customer_selection') == 'NEW_CUSTOMER') {
            $van_selling_customer = '';
            $location = Location::select('id', 'location')->get();
        } else {
            $van_selling_customer = Van_selling_customer::find($request->input('customer_selection'));
            $location = '';
        }

        return view('van_selling_transaction_proceed_page', [
            'cart' => $cart,
            'os_cart' => $os_cart,
            'van_selling_customer' => $van_selling_customer,
            'location' => $location,
        ])->with('customer_selection', $request->input('customer_selection'));
    }

    public function van_selling_transaction_summary(Request $request)
    {
        //return $request->input();
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d');
        $time = date('h:i:s a');
        $date_receipt = date('Y-m');

        $van_selling_transaction = Van_selling_transaction::select('delivery_receipt')->latest()->first();
        $agent_user = Agent_user::first();

        if (!is_null($van_selling_transaction)) {
            $var_explode = explode('-', $van_selling_transaction->delivery_receipt);
            $year_and_month = $var_explode[2] . "-" . $var_explode[3];
            $series = $var_explode[4];
            if ($date_receipt != $year_and_month) {
                $delivery_receipt = "VS-" . $agent_user->id . "-" . $date_receipt  . "-0001";
            } else {
                $delivery_receipt = "VS-" . $agent_user->id . "-" . $date_receipt . "-" . str_pad($series + 1, 4, 0, STR_PAD_LEFT);
            }
        } else {
            $delivery_receipt = "VS-" . $agent_user->id . "-" . $date_receipt  . "-0001";
        }

        $cart = Vs_cart::get();
        $explode = explode('-', $request->input('location_data'));
        $location_id = $explode[0];

        return view('van_selling_transaction_summary_page', [
            'cart' => $cart,
            'agent_user' => $agent_user,
            'delivery_receipt' => $delivery_receipt,
        ])->with('address', $request->input('address'))
            ->with('barangay', $request->input('barangay'))
            ->with('customer_selection', $request->input('customer_selection'))
            ->with('location_data', $request->input('location_data'))
            ->with('store_id', $request->input('store_id'))
            ->with('store_name', $request->input('store_name'))
            ->with('store_type', $request->input('store_type'))
            ->with('pcm_number', $request->input('pcm_number'))
            ->with('location_id', $location_id)
            ->with('date', $date)
            ->with('time', $time)
            ->with('bo_amount', str_replace(',', '', $request->input('bo_amount')));
    }

    public function van_selling_transaction_summary_save(Request $request)
    {
        //return $request->input();
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d');


        if ($request->input('customer_selection') == 'NEW_CUSTOMER') {
            $van_selling_customer = new Van_selling_customer([
                'store_name' => $request->input('store_name'),
                'store_type' => $request->input('store_type'),
                'address' => $request->input('address'),
                'location_id' => $request->input('location_id'),
                'barangay' => $request->input('barangay'),
            ]);

            $van_selling_customer->save();
        }

        if ($request->input('total_amount') != 0) {
            $van_selling_transaction_save = new Van_selling_transaction([
                'delivery_receipt' => $request->input('delivery_receipt'),
                'store_name' => $request->input('store_name'),
                'store_type' => $request->input('store_type'),
                'total_amount' => $request->input('total_amount'),
                'full_address' => $request->input('location_id'),
                'status' => 'PAID',
                'pcm_number' => $request->input('pcm_number'),
                'bo_amount' => $request->input('bo_amount'),
                'date' => $date,
                'remarks' => $request->input('date_time'),
                'address' => $request->input('address'),
                'barangay' => $request->input('barangay'),
            ]);

            $van_selling_transaction_save->save();

            $van_selling_cart_data = Vs_cart::all();

            foreach ($van_selling_cart_data as $key => $data) {
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

                $sku_ledger = Vs_upload_inventory::where('sku_code', $data->sku_code)
                    ->orderBy('id', 'desc')
                    ->limit(1)
                    ->first();

                $new_vs_inventory = new Vs_upload_inventory([
                    'store_name' => $request->input('store_name'),
                    'principal' =>  $sku_ledger->principal,
                    'sku_code' => $sku_ledger->sku_code,
                    'description' => $sku_ledger->description,
                    'unit_of_measurement' => $sku_ledger->unit_of_measurement,
                    'sku_type' => $sku_ledger->sku_type,
                    'butal_equivalent' => $sku_ledger->butal_equivalent,
                    'reference' => $request->input('delivery_receipt'),
                    'quantity' => $data->quantity,
                    'running_balance' => $sku_ledger->running_balance - $data->quantity,
                    'unit_price' => $data->price,
                    'date' => $date,
                ]);

                $new_vs_inventory->save();
            }
        }

        $van_sellling_os_cart_data = Vs_os_cart::all();
        if ($van_sellling_os_cart_data) {
            $van_selling_os_data_code = uniqid();
            foreach ($van_sellling_os_cart_data as $key_2 => $os_data) {
                $new_os_data = new Vs_os([
                    'store_name' => $request->input('store_name'),
                    'sku_code' => $os_data->sku_code,
                    'quantity' => $os_data->quantity,
                    'os_code' => $van_selling_os_data_code,
                    'date' => $date,
                ]);

                $new_os_data->save();
            }
        }

        $new_calls = new Van_selling_calls([
            'store_name' => $request->input('store_name'),
            'location_id' => $request->input('location_id'),
            'address' => $request->input('address'),
            'date' => $date,
            'remarks' => $request->input('remarks'),
        ]);

        $new_calls->save();
    }

    public function van_selling_transaction_unproductive_process(Request $request)
    {
        //return $request->input();
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
            'location_id' => $location_id,
            'address' => $address,
            'date' => $date,
            'remarks' => 'UNPRODUCTIVE',
        ]);

        $new->save();

        if ($request->input('customer_selection') == 'NEW_CUSTOMER') {
            $van_selling_customer = new Van_selling_customer([
                'store_name' => strtoupper(str_replace(',', '', $store_name)),
                'store_type' => $request->input('store_type'),
                'address' => strtoupper(str_replace(',', '', $address)),
                'location_id' => $location_id,
                'barangay' => strtoupper(str_replace(',', '', $barangay)),
            ]);

            $van_selling_customer->save();
        }

        return 'saved';
    }
}
