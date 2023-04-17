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
