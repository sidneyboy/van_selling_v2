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
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class Van_selling_transaction_controller extends Controller
{
    public function index()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('van_selling_transaction_cart_details')->truncate();
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
            $principal = Van_selling_upload_ledger::select('principal')->where('end', '!=', '0')->groupBy('principal')->get();
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

        $check_van_selling_transaction_cart = Van_selling_transaction_cart_details::select('sku_code')->where('principal', $request->input('principal'))->get();


        if (count($check_van_selling_transaction_cart) != 0) {
            $check_van_selling_os_cart = Van_selling_os_cart_details::select('sku_code')->where('principal', $request->input('principal'))->get();

            $counter = count($check_van_selling_transaction_cart);

            $sku_ledger = Van_selling_upload_ledger::select('sku_code')
                ->where('principal', $request->input('principal'))
                ->groupBy('sku_code')
                ->whereNotIn('sku_code', $check_van_selling_transaction_cart->toArray())
                ->get();

            $sku_database = Van_selling_transaction_cart_details::select('id', 'description', 'price', 'beg', 'quantity')->whereIn('sku_code', $check_van_selling_transaction_cart->toArray())->get();

            $van_selling_inventory = Van_selling_inventories::where('principal', $request->input('principal'))
                ->whereNotIn('sku_code', $sku_ledger->toArray())
                ->whereNotIn('sku_code', $check_van_selling_os_cart->toArray())
                ->get();

            $van_selling_cart_data = Van_selling_os_cart_details::where('principal', $request->input('principal'))->get();

            $counter_sku_ledger = count($sku_ledger);
            return view('van_selling_transaction_show_sku_page', [
                'check_van_selling_transaction_cart' => $check_van_selling_transaction_cart,
                'sku_ledger' => $sku_ledger,
                'van_selling_inventory' => $van_selling_inventory,
                'sku_database' => $sku_database,
                'van_selling_cart_data' => $van_selling_cart_data,
            ])->with('counter_sku_ledger', $counter_sku_ledger)
                ->with('counter', $counter);
        } else {
            if ($request->input('customer_selection') == 'NEW_CUSTOMER') {
                $sku_ledger = Van_selling_upload_ledger::select('sku_code')
                    ->where('principal', $request->input('principal'))
                    ->groupBy('sku_code')
                    ->get();

                $check_van_selling_os_cart = Van_selling_os_cart_details::select('sku_code')->where('principal', $request->input('principal'))->get();

                $van_selling_inventory = Van_selling_inventories::where('principal', $request->input('principal'))
                    ->whereNotIn('sku_code', $sku_ledger->toArray())
                    ->whereNotIn('sku_code', $check_van_selling_os_cart->toArray())
                    ->get();

                $van_selling_cart_data = Van_selling_os_cart_details::where('principal', $request->input('principal'))->get();

                $counter = count($sku_ledger);

                return view('van_selling_transaction_show_sku_page', [
                    'sku_ledger' => $sku_ledger,
                    'van_selling_inventory' => $van_selling_inventory,
                    'van_selling_cart_data' => $van_selling_cart_data,
                ])->with('counter', $counter);
            } else {
                $vs_customer = Van_selling_customer::select('store_name')->find($request->input('store_name'));

                $sku_ledger = Van_selling_upload_ledger::select('sku_code')
                    ->where('principal', $request->input('principal'))
                    ->groupBy('sku_code')
                    ->get();

                $check_van_selling_os_cart = Van_selling_os_cart_details::select('sku_code')->where('principal', $request->input('principal'))->get();

                $van_selling_inventory = Van_selling_inventories::where('principal', $request->input('principal'))
                    ->whereNotIn('sku_code', $sku_ledger->toArray())
                    ->whereNotIn('sku_code', $check_van_selling_os_cart->toArray())
                    ->get();

                $van_selling_cart_data = Van_selling_os_cart_details::where('principal', $request->input('principal'))->get();

                $counter = count($sku_ledger);

                return view('van_selling_transaction_show_sku_page', [
                    'sku_ledger' => $sku_ledger,
                    'van_selling_inventory' => $van_selling_inventory,
                    'van_selling_cart_data' => $van_selling_cart_data,
                ])->with('counter', $counter);
            }
        }
    }

    public function van_selling_transaction_proceed(Request $request)
    {
        //return $request->input();
        if (is_null($request->input('cart_id'))) {
            $quantity_ordered = array_filter($request->input('quantity_ordered'));
            if (count($quantity_ordered) != 0) {
                foreach ($quantity_ordered as $key => $data) {
                    if ($data > $request->input('ending_balance')[$key]) {
                        $quantity_error[] = '<center>INSUFFICIENT QUANTITY OF <span style="color:blue;font-weight:bold;"> ' . $key . " " . $request->input('description')[$key] . "</span>. REMAINING QUANTITY IS ONLY <span style='color:red;font-weight:bold;'>" . $request->input('ending_balance')[$key] . ". SKU CANNOT BE ADDED TO TRANSACTION</span></center";
                    } else {
                        $quantity_error[] = '';
                        $check = Van_selling_transaction_cart_details::where('sku_code', $key)->first();
                        if ($check) {
                        } else {
                            $van_selling_transaction_cart_details = new Van_selling_transaction_cart_details([
                                'sku_code' => $key,
                                'description' => $request->input('description')[$key],
                                'principal' => $request->input('principal_data')[$key],
                                'quantity' => $request->input('quantity_ordered')[$key],
                                'unit_of_measurement' => $request->input('unit_of_measurement')[$key],
                                'sku_type' => $request->input('sku_type')[$key],
                                'butal_equivalent' => $request->input('butal_equivalent')[$key],
                                'beg' => $request->input('ending_balance')[$key],
                                'price' => $request->input('unit_price')[$key],
                                'user_id' => $request->input('user_id'),
                            ]);
                            $van_selling_transaction_cart_details->save();
                        }
                    }
                }
            } else {
                $quantity_error[] = '';
            }



            $os_if_not_null = $request->input('os_ordered');
            if (isset($os_if_not_null)) {
                $os_inventory = array_filter($os_if_not_null);
                foreach ($os_inventory as $key => $os_data) {
                    $check_os_cart = Van_selling_os_cart_details::where('sku_code', $key)->first();
                    $sku_os_inventory = Van_selling_inventories::find($key);
                    if ($check_os_cart) {
                        Van_selling_os_cart_details::where('van_selling_inventory_id', $check_os_cart->id)
                            ->update(['quantity' => $os_data]);
                    } else {
                        $new_van_selling_os_cart = new Van_selling_os_cart_details([
                            'van_selling_inventory_id' => $key,
                            'sku_code' => $sku_os_inventory->sku_code,
                            'principal' => $sku_os_inventory->principal,
                            'quantity' => $os_data,
                            'unit_price' => $sku_os_inventory->unit_price,
                        ]);

                        $new_van_selling_os_cart->save();
                    }
                }
            }


            if ($request->input('customer_selection') == 'NEW_CUSTOMER') {
                $van_selling_customer = '';
                $location = Location::select('id', 'location')->get();
            } else {
                $van_selling_customer = Van_selling_customer::find($request->input('customer_selection'));
                $location = '';
            }

            //return $quantity_error;

            $van_selling_cart_data = Van_selling_transaction_cart_details::all();
            $van_selling_os_cart_data = Van_selling_os_cart_details::all();
            return view('van_selling_transaction_proceed_page', [
                'van_selling_cart_data' => $van_selling_cart_data,
                'van_selling_customer' => $van_selling_customer,
                'van_selling_os_cart_data' => $van_selling_os_cart_data,
                'location' => $location,
            ])->with('customer_selection', $request->input('customer_selection'))
                ->with('full_name', $request->input('full_name'))
                ->with('user_id', $request->input('user_id'))
                ->with('quantity_error', $quantity_error);
        } else {

            $os_if_not_null = $request->input('os_ordered');
            if (isset($os_if_not_null)) {
                $os_inventory = array_filter($request->input('os_ordered'));
                $if_diff_ordered_and_current_quantity = array_diff($request->input('update_quantity_ordered'), $request->input('update_current_quantity_ordered'));
            } else {
                $if_diff_ordered_and_current_quantity = [];
            }

            foreach ($request->input('update_quantity_ordered') as $id => $data) {
                if ($request->input('update_current_quantity_ordered')[$id] != $data) {
                    if ($data > $request->input('update_ending_balance')[$id]) {
                        $quantity_error[] = '<center>INSUFFICIENT QUANTITY OF <span style="color:blue;font-weight:bold;"> ' . $request->input('update_description')[$id] . "</span>. REMAINING QUANTITY IS ONLY <span style='color:red;font-weight:bold;'>" . $request->input('update_ending_balance')[$id] . ". SKU QTY REMAINS THE SAME</span>.</center><br /> ";
                    } else {
                        $quantity_error[] = '';
                        Van_selling_transaction_cart_details::where('id', $id)
                            ->update(['quantity' => $request->input('update_quantity_ordered')[$id]]);
                    }
                }
            }



            if (count($if_diff_ordered_and_current_quantity) != 0) {
                foreach ($os_inventory as $key => $os_data) {
                    $check_os_cart = Van_selling_os_cart_details::where('sku_code', $key)->first();
                    $sku_os_inventory = Van_selling_inventories::find($key);
                    if ($check_os_cart) {
                        Van_selling_os_cart_details::where('van_selling_inventory_id', $check_os_cart->id)
                            ->update(['quantity' => $os_data]);
                    } else {
                        $new_van_selling_os_cart = new Van_selling_os_cart_details([
                            'van_selling_inventory_id' => $key,
                            'sku_code' => $sku_os_inventory->sku_code,
                            'principal' => $sku_os_inventory->principal,
                            'quantity' => $os_data,
                            'unit_price' => $sku_os_inventory->unit_price,
                        ]);

                        $new_van_selling_os_cart->save();
                    }
                }
            }

            $quantity_ordered = $request->input('quantity_ordered');
            if (isset($quantity_ordered)) {
                foreach ($quantity_ordered as $key => $data) {
                    if ($data > $request->input('ending_balance')[$key]) {
                        $quantity_error[] = '<center>INSUFFICIENT QUANTITY OF <span style="color:blue;font-weight:bold;"> ' . $key . " " . $request->input('description')[$key] . "</span>. REMAINING QUANTITY IS ONLY <span style='color:red;font-weight:bold;'>" . $request->input('ending_balance')[$key] . ". SKU CANNOT BE ADDED TO TRANSACTION</span></center><br />";
                    } else {
                        $quantity_error[] = '';
                        $check = Van_selling_transaction_cart_details::where('sku_code', $key)->first();
                        if ($check) {
                        } else {
                            $van_selling_transaction_cart_details = new Van_selling_transaction_cart_details([
                                'sku_code' => $key,
                                'description' => $request->input('description')[$key],
                                'principal' => $request->input('principal_data')[$key],
                                'quantity' => $request->input('quantity_ordered')[$key],
                                'unit_of_measurement' => $request->input('unit_of_measurement')[$key],
                                'sku_type' => $request->input('sku_type')[$key],
                                'butal_equivalent' => $request->input('butal_equivalent')[$key],
                                'beg' => $request->input('ending_balance')[$key],
                                'price' => $request->input('unit_price')[$key],
                                'user_id' => $request->input('user_id'),
                            ]);
                            $van_selling_transaction_cart_details->save();
                        }
                    }
                }
            } else {
                $quantity_error[] = '';
            }


            if ($request->input('customer_selection') == 'NEW_CUSTOMER') {
                $van_selling_customer = '';
                $location = Location::select('id', 'location')->get();
            } else {
                $van_selling_customer = Van_selling_customer::find($request->input('customer_selection'));
                $location = '';
            }

            $van_selling_cart_data = Van_selling_transaction_cart_details::all();
            $van_selling_os_cart_data = Van_selling_os_cart_details::all();


            return view('van_selling_transaction_proceed_page', [
                'van_selling_cart_data' => $van_selling_cart_data,
                'van_selling_customer' => $van_selling_customer,
                'van_selling_os_cart_data' => $van_selling_os_cart_data,
                'location' => $location,
            ])->with('customer_selection', $request->input('customer_selection'))
                ->with('full_name', $request->input('full_name'))
                ->with('user_id', $request->input('user_id'))
                ->with('quantity_error', $quantity_error);
        }
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
