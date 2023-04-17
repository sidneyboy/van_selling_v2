


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
