<button class="btn btn-sm float-right btn-danger" type="button" id="unproductive_button">SET AS UNPRODUCTIVE</button>
<br /><br />
<form id="van_selling_transaction_summary">
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
        <table class="table table-bordered table-sm table-striped" style="font-size:13px;">
            <thead>
                <tr>
                    <th colspan="2" style="background-color:bisque">Customer Profile</th>
                </tr>
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

    @if (count($os_cart) != 0)
        <div class="table table-responsive">
            <table class="table table-bordered table-striped table-sm" style="font-size:13px">
                <thead>
                    <tr>
                        <th colspan="4" style="background-color:orange">OS TRANSACTION</th>
                    </tr>
                    <tr>
                        <th>Desc</th>
                        <th>Qty</th>
                        <th>U/P</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($os_cart as $os_data)
                        <tr>
                            <td><b style="color:green">{{ $os_data->sku_code }}</b><br />
                                {{ $os_data->sku->description }}
                            </td>
                            <td style="text-align: right">{{ $os_data->quantity }}</td>
                            <td style="text-align: right">{{ number_format($os_data->sku->unit_price, 2, '.', ',') }}
                            </td>
                            <td style="text-align: right">
                                {{ number_format($os_data->quantity * $os_data->sku->unit_price, 2, '.', ',') }}
                                @php
                                    $total_os = $os_data->quantity * $os_data->sku->unit_price;
                                    $sum_total_os[] = $total_os;
                                @endphp
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Grand Total</th>
                        <th></th>
                        <th></th>
                        <th style="text-align: right">{{ number_format(array_sum($sum_total_os), 2, '.', ',') }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    @endif

    @if (count($cart) != 0)
        <div class="table table-responsive">
            <table class="table table-bordered table-striped table-sm" style="font-size:13px">
                <thead>
                    <tr>
                        <th colspan="4" style="background-color:yellowgreen">TRANSACTION</th>
                    </tr>
                    <tr>
                        <th>Desc</th>
                        <th>Qty</th>
                        <th>U/P</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cart as $data)
                        <tr>
                            <td><b style="color:green">{{ $data->sku_code }}</b><br />
                                {{ $data->description }}
                            </td>
                            <td style="text-align: right">{{ $data->quantity }}</td>
                            <td style="text-align: right">{{ number_format($data->price, 2, '.', ',') }}</td>
                            <td style="text-align: right">
                                {{ number_format($data->quantity * $data->price, 2, '.', ',') }}
                                @php
                                    $total = $data->quantity * $data->price;
                                    $sum_total[] = $total;
                                @endphp
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Grand Total</th>
                        <th></th>
                        <th></th>
                        <th style="text-align: right">{{ number_format(array_sum($sum_total), 2, '.', ',') }}</th>
                    </tr>
                    <tr>
                        <th colspan="4">BO DEDUCTION</th>
                    </tr>
                    <tr>
                        <th colspan="3">PCM No:</th>
                        <th><input type="text" style="text-align: center;" name="pcm_number"
                                class="form-control form-control-sm" required></th>
                    </tr>
                    <tr>
                        <th colspan="3">BO Amount:</th>
                        <th><input type="text" class="form-control form-control-sm" style="text-align: center;"
                                onkeypress="return isNumberKey(event)" name="bo_amount" required>
                        </th>
                    </tr>
                </tfoot>
            </table>
        </div>
    @endif

    <br />
    <input type="hidden" value="{{ $customer_selection }}" name="customer_selection" id="customer_selection">
    <button class="btn btn-block btn-info" type="submit">Proceed</button>
</form>


<script>
    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode != 46 && charCode > 31 &&
            (charCode < 48 || charCode > 57))
            return false;

        return true;
    }

    $("#unproductive_button").click(function() {
        // alert($('#store_name').val());
        $('.loading').show();
        var store_name = $('#store_name').val();
        var location = $('#location').val();
        var store_type = $('#store_type').val();
        var barangay = $('#barangay').val();
        var address = $('#address').val();
        var customer_selection = $('#customer_selection').val();

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
                        address + '&customer_selection=' + customer_selection,
                    success: function(data) {
                        if (data == 'saved') {
                            $('.loading').hide();
                            Swal.fire(
                                'Set!',
                                'Customer has been set to Unproductive.',
                                'success'
                            );

                            window.location.replace('van_selling_customer_list');
                        } else {
                            $('.loading').hide();
                            Swal.fire(
                                'Error',
                                'Fill Up Customer Data First!',
                                'error'
                            );
                        }
                    },
                    error: function(error) {
                        $('.loading').hide();
                        Swal.fire(
                            'Cannot Proceed',
                            'Please Contact IT Support',
                            'error'
                        )
                    }
                });
            }
        })
    });

    $("#van_selling_transaction_summary").on('submit', (function(e) {
        e.preventDefault();
        $('.loading').show();
        $.ajax({
            url: "van_selling_transaction_summary",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                if (data == 'existing') {
                    $('.loading').hide();
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
            error: function(error) {
                $('.loading').hide();
                Swal.fire(
                    'Cannot Proceed',
                    'Please Contact IT Support',
                    'error'
                )
            }
        });
    }));
</script>
