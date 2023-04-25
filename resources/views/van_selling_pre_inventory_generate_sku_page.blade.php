<form id="van_selling_pre_inventory_generate_summary">
    <div class="table table-responsive">
        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th>CODE</th>
                    <th>SKU</th>
                    <th>QTY</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sku_data as $data)
                    <tr>
                        <td>
                            <b
                                style="color:green">{{ $data->sku_code }}</b><br />{{ $data->description }}<br /><b>{{ $data->sku_type }}</b>
                            <input type="hidden" value="{{ $data->sku_id }}" name="sku_id[]">
                            <input type="hidden" value="{{ $data->sku_code }}" name="sku_code[{{ $data->sku_id }}]">
                        </td>
                        <td>{{ $data->description }}</td>
                        <td><input type="number" name="quantity[{{ $data->sku_id }}]" class="form-control" required
                                value="0" style="width:100px;text-align:center;"></td>
                    </tr>
                    <tr>
                        <td>REMARKS:</td>
                        <td colspan="2"><input type="text" class="form-control" placeholder="Input SKU Remarks"
                                min="1" name="remarks[{{ $data->sku_id }}]"></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <input type="hidden" value="{{ $principal }}" name="principal">
        <button class="btn btn-info btn-block" type="submit">PROCEED TO SUMMARY</button>
    </div>
</form>

<script>
    $("#van_selling_pre_inventory_generate_summary").on('submit', (function(e) {
        e.preventDefault();
        $('.loading').show();
        $.ajax({
            url: "van_selling_pre_inventory_generate_summary",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                if (data == 'NO_DATA_FOUND') {
                    Swal.fire(
                        'NO DATA FOUND!',
                        'CANNOT PROCEED!',
                        'error'
                    )
                    $('.loading').hide();
                } else {
                    $('#van_selling_pre_inventory_generate_summary_page').html(data);
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
