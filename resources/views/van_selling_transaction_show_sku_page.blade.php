<div class="table table-responsive">
    <table class="table table-bordered table-sm table-striped" style="font-size:13px;height: 10px;
    overflow: hidden"
        id="example2">
        <thead>
            <tr>
                <th>Desc</th>
                <th>Inventory</th>
                <th>U/P</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sku as $data)
                <tr>
                    <td><b style="color:green">{{ $data->sku_code }}</b> <br />
                        {{ $data->description }}<br />
                        <b style="color:blue">{{ $data->sku_type }}</b>
                    </td>
                    <td style="text-align: right">{{ $data->running_balance }}</td>
                    <td style="text-align: right">{{ number_format($data->unit_price, 2, '.', ',') }}</td>
                    <td>
                        <input type="number" min="0" style="width:70px;" name="sku_quantity[{{ $data->sku_id }}]"
                            class="form-control form-control-sm">
                        <input type="hidden" value="{{ $data->running_balance }}"
                            name="running_balance[{{ $data->sku_id }}]">
                    </td>
                </tr>
            @endforeach
            @foreach ($os_sku as $os_data)
                <tr>
                    <td><b style="color:red">{{ $os_data->sku_code }}</b> <br />
                        {{ $os_data->description }}<br />
                        <b style="color:blue;">{{ $os_data->sku_type }}</b>
                    </td>
                    <td style="text-align: right">0</td>
                    <td style="text-align: right">{{ number_format($os_data->unit_price, 2, '.', ',') }}</td>
                    <td><input type="number" min="0" style="width:70px;"
                            name="os_quantity[{{ $os_data->sku_id }}]" class="form-control form-control-sm"></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    $("#example1").DataTable();
    $('#example2').DataTable({
        "paging": false,
        "lengthChange": false,
        "searching": true,
        "ordering": false,
        "info": false,
        "autoWidth": false,
        "scrollY": '300px',
    });
</script>
