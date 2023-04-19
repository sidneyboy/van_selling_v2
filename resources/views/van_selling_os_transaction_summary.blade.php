<form id="van_selling_os_transaction_final_summary">
    <div class="table table-responsive">
        <table class="table table-bordered table-sm table-striped">
            <thead>
                <tr>
                    <th>Desc</th>
                    <th>Serve</th>
                    <th>U/P</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($os as $data)
                    <tr>
                        <td><b style="color:green;">{{ $data->sku_code }}</b><br /> {{ $data->sku->description }}
                        </td>
                        <td style="text-align: right">{{ $served_quantity[$data->sku_code] }}</td>
                        <td style="text-align: right">{{ number_format($unit_price[$data->sku_code], 2, '.', ',') }}</td>
                        <td style="text-align: right">
                            @php
                                $total = $served_quantity[$data->sku_code] * $unit_price[$data->sku_code];
                                $sum_total[] = $total;
                                echo number_format($total, 2, '.', ',');
                            @endphp
                            <input type="hidden" name="served_quantity[{{ $data->sku_code }}]" value="{{ $served_quantity[$data->sku_code] }}">
                            <input type="hidden" name="unit_price[{{ $data->sku_code }}]" value="{{ $unit_price[$data->sku_code] }}">
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <thead>
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
            </thead>
        </table>
    </div>
    <br />
    <input type="hidden" name="os_code" value="{{ $os_code }}">
    <button class="btn btn-sm btn-block btn-info">Proceed</button>
</form>

<script>
    $("#van_selling_os_transaction_final_summary").on('submit', (function(e) {
        e.preventDefault();
        //$('.loading').show();
        $.ajax({
            url: "van_selling_os_transaction_final_summary",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $('.loading').hide();
                $('#van_selling_os_transaction_final_summary_page').html(data);
                $('#hide_if_trigger').show();
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
