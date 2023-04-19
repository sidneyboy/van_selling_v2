<form id="van_selling_os_transaction_summary">
    <div class="table table-responsive">
        <table class="table table-bordered table-sm table-striped">
            <thead>
                <tr>
                    <th>Desc</th>
                    <th>Inventory</th>
                    <th>Qty</th>
                    <th>Serve</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($os as $data)
                    <tr>
                        <td><b style="color:green;">{{ $data->sku->sku_code }}</b><br /> {{ $data->sku->description }}
                        </td>
                        <td style="text-align: right;">{{ $running_inventory[$data->sku_code] }}</td>
                        <td style="text-align: right;">{{ $data->quantity }}</td>
                        <td>
                            <input type="number" class="form-control form-contol-sm" style="text-align:center;width:100px;"
                                name="served_quantity[{{ $data->sku_code }}]">
                            <input type="hidden" value="{{ $running_inventory[$data->sku_code] }}"
                                name="running_inventory[{{ $data->sku_code }}]">
                                <input type="hidden" value="{{ $unit_price[$data->sku_code] }}"
                                name="unit_price[{{ $data->sku_code }}]">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <br />
    <input type="hidden" name="os_code" value="{{ $os_code }}">
    <button class="btn btn-sm btn-block btn-info">Proceed</button>
</form>

<script>
    $("#van_selling_os_transaction_summary").on('submit', (function(e) {
        e.preventDefault();
        // $('.loading').show();
        $.ajax({
            url: "van_selling_os_transaction_summary",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                if (data == 'Insufficient') {
                    $('.loading').hide();
                    Swal.fire(
                        'Cannot Proceed',
                        'Insufficient Quantity',
                        'error'
                    )
                } else {
                    $('#van_selling_os_transaction_summary_page').html(data);
                    $('#hide_if_trigger').show();
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
