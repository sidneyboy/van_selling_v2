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




















        


@if (isset($check_van_selling_transaction_cart))
    <div class="table table-responsive">
        <table class="table table-bordered table-sm table-striped" id="example2">
            <thead>
                <tr>
                    <th>DESC</th>
                    <th>BALANCE</th>
                    <th>U/P</th>
                    <th>QTY</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sku_database as $data)
                    <tr>
                        <th>
                            {{ $data->description }}
                            <input type="hidden" name="cart_id[]" value="{{ $data->id }}">
                            <input type="hidden" name="update_description[{{ $data->id }}]"
                                value="{{ $data->description }}">
                        </th>
                        <th style="text-align: center;">
                            {{ $data->beg }}
                            <input type="hidden" name="update_ending_balance[{{ $data->id }}]"
                                value="{{ $data->beg }}">
                            <input type="hidden" name="update_current_quantity_ordered[{{ $data->id }}]"
                                value="{{ $data->quantity }}">
                        </th>
                        <th style="text-align: center;">{{ $data->price }}</th>
                        <th><input style="text-align: center;width:200px;" type="number"
                                name="update_quantity_ordered[{{ $data->id }}]" value="{{ $data->quantity }}"
                                min="0" class="form-control"></th>
                    </tr>
                @endforeach
                @foreach ($sku_ledger as $data)
                    @php
                        $ledger = DB::select(DB::raw("SELECT * FROM(SELECT * FROM Van_selling_upload_ledgers WHERE sku_code = '$data->sku_code' ORDER BY id DESC LIMIT 1)Var1 ORDER BY id ASC"));
                    @endphp
                    <tr>
                        <th>
                            {{ $ledger[0]->description }}
                            <input type="hidden" name="description[{{ $ledger[0]->sku_code }}]"
                                value="{{ $ledger[0]->description }}">
                            <input type="hidden" name="sku_code[]" value="{{ $ledger[0]->sku_code }}">
                            <input type="hidden" name="principal_data[{{ $ledger[0]->sku_code }}]"
                                value="{{ $ledger[0]->principal }}">
                            <input type="hidden" name="unit_of_measurement[{{ $ledger[0]->sku_code }}]"
                                value="{{ $ledger[0]->unit_of_measurement }}">
                            <input type="hidden" name="beg_balance[{{ $ledger[0]->sku_code }}]"
                                value="{{ $ledger[0]->end }}">
                            <input type="hidden" name="sku_type[{{ $ledger[0]->sku_code }}]"
                                value="{{ $ledger[0]->sku_type }}">
                            <input type="hidden" name="butal_equivalent[{{ $ledger[0]->sku_code }}]"
                                value="{{ $ledger[0]->butal_equivalent }}">
                        </th>
                        <th style="text-align: center;">
                            {{ $ledger[0]->end }}
                            <input type="hidden" name="ending_balance[{{ $ledger[0]->sku_code }}]"
                                value="{{ $ledger[0]->end }}">
                        </th>
                        <th style="text-align: center;">
                            {{ $ledger[0]->unit_price }}
                            <input type="hidden" name="unit_price[{{ $ledger[0]->sku_code }}]"
                                value="{{ $ledger[0]->unit_price }}">
                        </th>
                        <th>
                            <input style="text-align: center;width:200px;" type="number"
                                name="quantity_ordered[{{ $ledger[0]->sku_code }}]" value="0" min="0"
                                class="form-control">
                        </th>
                    </tr>
                @endforeach

                @if (count($van_selling_inventory) != 0)
                    @foreach ($van_selling_inventory as $os)
                        <tr style="color:red;">
                            <th>{{ $os->description }}</th>
                            <th style="text-align: center">OS</th>
                            <th style="text-align: center">{{ $os->unit_price }}</th>
                            <th>
                                <input style="text-align: center;width:200px;" type="number"
                                    name="os_ordered[{{ $os->id }}]" value="0" min="0"
                                    class="form-control ">
                            </th>
                        </tr>
                    @endforeach
                @endif


                @foreach ($van_selling_cart_data as $os_cart)
                    <tr style="color:red;">
                        <th>{{ $os_cart->van_selling_os_sku->description }}</th>
                        <th style="text-align: center">OS</th>
                        <th style="text-align: center">{{ $os_cart->van_selling_os_sku->unit_price }}</th>
                        <th>
                            <input style="text-align: center;width:200px;" type="number"
                                name="os_ordered[{{ $os_cart->id }}]" value="{{ $os_cart->quantity }}" min="0"
                                class="form-control ">
                        </th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <div class="table table-responsive">
        <table class="table table-bordered table-sm table-striped" id="example2">
            <thead>
                <tr>
                    <th>DESC</th>
                    <th>BALANCE</th>
                    <th>U/P</th>
                    <th>QTY</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sku_ledger as $data)
                    @php
                        $ledger = DB::select(DB::raw("SELECT * FROM(SELECT * FROM Van_selling_upload_ledgers WHERE sku_code = '$data->sku_code' ORDER BY id DESC LIMIT 1)Var1 ORDER BY id ASC"));
                    @endphp
                    @if ($ledger[0]->end != 0)
                        <tr>
                            <th>
                                {{ $ledger[0]->description }}
                                <input type="hidden" name="description[{{ $ledger[0]->sku_code }}]"
                                    value="{{ $ledger[0]->description }}">
                                <input type="hidden" name="sku_code[]" value="{{ $ledger[0]->sku_code }}">
                                <input type="hidden" name="principal_data[{{ $ledger[0]->sku_code }}]"
                                    value="{{ $ledger[0]->principal }}">
                                <input type="hidden" name="unit_of_measurement[{{ $ledger[0]->sku_code }}]"
                                    value="{{ $ledger[0]->unit_of_measurement }}">
                                <input type="hidden" name="beg_balance[{{ $ledger[0]->sku_code }}]"
                                    value="{{ $ledger[0]->end }}">
                                <input type="hidden" name="sku_type[{{ $ledger[0]->sku_code }}]"
                                    value="{{ $ledger[0]->sku_type }}">
                                <input type="hidden" name="butal_equivalent[{{ $ledger[0]->sku_code }}]"
                                    value="{{ $ledger[0]->butal_equivalent }}">
                            </th>
                            <th style="text-align: center;">
                                {{ $ledger[0]->end }}
                                <input type="hidden" name="ending_balance[{{ $ledger[0]->sku_code }}]"
                                    value="{{ $ledger[0]->end }}">
                            </th>
                            <th style="text-align: center;">
                                {{ $ledger[0]->unit_price }}
                                <input type="hidden" name="unit_price[{{ $ledger[0]->sku_code }}]"
                                    value="{{ $ledger[0]->unit_price }}">
                            </th>
                            <th><input style="text-align: center;width:200px;" type="number"
                                    name="quantity_ordered[{{ $ledger[0]->sku_code }}]" value="0"
                                    min="0" class="form-control "></th>
                        </tr>
                    @endif
                @endforeach
                @foreach ($van_selling_inventory as $os)
                    <tr style="color:red;">
                        <th>{{ $os->description }}</th>
                        <th style="text-align: center">OS</th>
                        <th style="text-align: center">{{ $os->unit_price }}</th>
                        <th>

                            <input style="text-align: center;width:200px;" type="number"
                                name="os_ordered[{{ $os->id }}]" value="0" min="0"
                                class="form-control ">
                        </th>
                    </tr>
                @endforeach

                @foreach ($van_selling_cart_data as $os_cart)
                    <tr style="color:red;">
                        <th>{{ $os_cart->van_selling_os_sku->description }}</th>
                        <th style="text-align: center">OS</th>
                        <th style="text-align: center">{{ $os_cart->van_selling_os_sku->unit_price }}</th>
                        <th>
                            <input style="text-align: center;width:200px;" type="number"
                                name="os_ordered[{{ $os_cart->id }}]" value="{{ $os_cart->quantity }}"
                                min="0" class="form-control ">
                        </th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif

<script>
    $("#example1").DataTable();
    $('#example2').DataTable({
        "paging": false,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": false,
        "autoWidth": false,
    });

  
</script>






















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































        <button class="btn btn-sm float-left btn-danger" type="button" id="unproductive_button">SET AS UNPRODUCTIVE</button>

<br />


<form id="van_selling_transaction_summary">
    @if (isset($quantity_error))
        @foreach ($quantity_error as $error)
            <p>{!! $error !!}</p>
        @endforeach
    @endif
    @if ($customer_selection == 'NEW_CUSTOMER')
        <div class="form-group">
            <label>STORE NAME:</label>
            <input type="text" placeholder="Customer Store Name" id="store_name" name="store_name" class="form-control"
                required>
        </div>
        <div class="form-group">
            <label>STORE TYPE:</label>
            <select name="store_type" id="store_type" class="form-control select2" required>
                <option value="" default>Select</option>
                <option value="SSS">SSS</option>
                <option value="GRO">GRO</option>
                <option value="SM">SM</option>
                <option value="DS">DS</option>
                <option value="PMS">PMS</option>
                <option value="CNV">CNV</option>
                <option value="HWA">HWA</option>
                <option value="WS">WS</option>
                <option value="HLS">HLS</option>
                <option value="TER">TER</option>
                <option value="INST">INST</option>
            </select>
        </div>
        <div class="form-group">
            <label>LOCATION:</label>
            <select class="form-control select2" id="location" name="location_data" required style="width:100%;">
                <option value="" default>SELECT LOCATION</option>
                @foreach ($location as $data)
                    <option value="{{ $data->id . ' - ' . $data->location }}">{{ $data->location }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>BARANGAY:</label>
            <input type="text" id="barangay" placeholder="BARANGAY / SITIO" name="barangay" class="form-control"
                required>
        </div>
        <div class="form-group">
            <label>ADDRESS:</label>
            <input type="text" id="address" placeholder="ZONE, HOUSE NUMBER, BLK, STREET" name="address"
                class="form-control" required>
        </div>
    @else
        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th>STORE NAME:</th>
                    <th>
                        {{ $van_selling_customer->store_name }}
                        <input type="hidden" id="store_name" name="store_name"
                            value="{{ $van_selling_customer->store_name }}">
                        <input type="hidden" name="store_id" value="{{ $van_selling_customer->id }}">

                    </th>
                </tr>
                <tr>
                    <th>STORE TYPE:</th>
                    <th>
                        {{ $van_selling_customer->store_type }}
                        <input type="hidden" id="store_type" name="store_type"
                            value="{{ $van_selling_customer->store_type }}">
                    </th>
                </tr>
                <tr>
                    <th>LOCATION:</th>
                    <th>
                        {{ $van_selling_customer->location->location }}
                        <input type="hidden" id="location" name="location_data"
                            value="{{ $van_selling_customer->location_id . ' - ' . $van_selling_customer->location->location }}">


                    </th>
                </tr>
                <tr>
                    <th>BARANGAY:</th>
                    <th>
                        {{ $van_selling_customer->barangay }}
                        <input type="hidden" id="barangay" name="barangay"
                            value="{{ $van_selling_customer->barangay }}">
                    </th>
                </tr>
                <tr>
                    <th>ADDRESS:</th>
                    <th>
                        {{ $van_selling_customer->address }}
                        <input type="hidden" id="address" name="address"
                            value="{{ $van_selling_customer->address }}">
                    </th>
                </tr>
            </thead>
        </table>
    @endif
    <div class="table table-responsive">
        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th colspan="3" style="text-align: center;">SOLD AS BUTAL</th>
                </tr>
                <tr>
                    <th style="text-align: center;">Desc</th>
                    <th style="text-align: center;">Qty</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($van_selling_cart_data as $data)
                    @if ($data->quantity != 0)
                        <tr>
                            <td>
                                <span style="font-weight: bold;color:green;">[{{ $data->sku_code }}] - </span>
                                {{ $data->description }}<br />
                                <b>UOM -</b> <span
                                    style="font-weight: bold;color:orange">{{ $data->unit_of_measurement }}</span><br />
                                <b>P -</b> <span
                                    style="font-weight: bold;color:blue;">{{ number_format($data->price, 2, '.', ',') }}</span>
                                <br />
                                <b>RB -</b> <span style="font-weight: bold;color:red;">{{ $data->beg }} </span>
                                <br />
                                <b>E QTY -</b> <span
                                    style="font-weight: bold;color:green">{{ $data->quantity_butal . ' ' . $data->unit_of_measurement }}/CASE
                                </span>
                            </td>
                            <td style="text-align: right;">{{ $data->quantity }}</td>
                            <td style="text-align: right;">
                                @php
                                    $sub_total = $data->quantity * $data->price;
                                    $sum_total[] = $sub_total;
                                    echo number_format($sub_total, 2, '.', ',');
                                @endphp
                            </td>
                        </tr>
                    @endif
                @endforeach
                @foreach ($van_selling_os_cart_data as $os_data)
                    <tr>
                        <td>
                            <span style="font-weight: bold;color:green;">[{{ $os_data->van_selling_os_sku->sku_code }}]
                                - </span>
                            {{ $os_data->van_selling_os_sku->description }}<br />
                            <span style="font-weight: bold;color:red">OS</span><br />
                        </td>
                        <td>{{ $os_data->quantity }}</td>
                        <td>0.00</td>
                    </tr>
                @endforeach
                <tr>
                    <th colspan="2">TOTAL</th>
                    <th style="text-align: right;">
                        @if (isset($sum_total))
                            {{ number_format(array_sum($sum_total), 2, '.', ',') }}
                        @endif
                    </th>
                </tr>
                <tr>
                    <th colspan="3">BO DEDUCTION</th>
                </tr>
                <tr>
                    <th colspan="2">PCM NO:</th>
                    <th><input type="text" style="text-align: center;" name="pcm_number" class="form-control"
                            required></th>
                </tr>
                <tr>
                    <th colspan="2">BO AMOUNT:</th>
                    <th><input type="text" class="currency-default" name="bo_amount" required
                            style="display: block;
                                    width: 100%;
                                    height: calc(2.25rem + 2px);
                                    padding: 0.375rem 0.75rem;
                                    font-size: 1rem;
                                    font-weight: 400;
                                    line-height: 1.5;
                                    color: #495057;
                                    background-color: #fff;
                                    background-clip: padding-box;
                                    border: 1px solid #ced4da;
                                    border-radius: 0.25rem;
                                    box-shadow: inset 0 0 0 transparent;
                                    text-align:center;
                                    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;">
                    </th>
                </tr>
                <tr>
                    <td colspan="3">
                        <input type="hidden" name="customer_selection" value="{{ $customer_selection }}">
                        <input type="hidden" name="user_id" value="{{ $user_id }}">
                        <input type="hidden" name="full_name" value="{{ $full_name }}">
                        {{-- @if (isset($sum_total)) --}}
                        <button type="submit" class="btn btn-info btn-block">PROCEED TO SUMMARY</button>
                        {{-- @endif --}}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</form>

<script type="text/javascript">
    $('.select2').select2()
    $("#van_selling_transaction_summary").on('submit', (function(e) {
        e.preventDefault();
        //$('.loading').show();
        $.ajax({
            url: "van_selling_transaction_summary",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                if (data == 'existing') {
                    Swal.fire(
                        'Error',
                        'Existing Customer Please Restart Transaction',
                        'error'
                    );
                } else {
                    $('#van_selling_transaction_summary_page').html(data);
                    $('.loading').hide();
                }
            },
        });
    }));


    $('[class=currency-default]').maskNumber();
    $('[class=currency-data-attributes]').maskNumber();
    $('[class=currency-configuration]').maskNumber({
        decimal: '_',
        thousands: '*'
    });
    $('[class=integer-default]').maskNumber({
        integer: true
    });
    $('[class=integer-data-attribute]').maskNumber({
        integer: true
    });
    $('[class=integer-configuration]').maskNumber({
        integer: true,
        thousands: '_'
    });

    $("#unproductive_button").click(function() {
        // alert($('#store_name').val());
        var store_name = $('#store_name').val();
        var location = $('#location').val();
        var store_type = $('#store_type').val();
        var barangay = $('#barangay').val();
        var address = $('#address').val();

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, set as Unproductive!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.post({
                    type: "POST",
                    url: "/van_selling_transaction_unproductive_process",
                    data: 'store_name=' + store_name + '&location=' + location +
                        '&store_type=' + store_type + '&barangay=' + barangay + '&address=' +
                        address,
                    success: function(data) {
                        if (data == 'saved') {
                            Swal.fire(
                                'Set!',
                                'Customer has been set to Unproductive.',
                                'success'
                            );

                            window.location.replace('van_selling_customer_list');
                        } else {
                            Swal.fire(
                                'Error',
                                'Fill Up Customer Data First!',
                                'error'
                            );
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
                // Swal.fire(
                //     'Set!',
                //     'Customer has been set to Unproductive.',
                //     'success'
                // )
            }
        })
    });
</script>

































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