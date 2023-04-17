<div class="table table-responsive">
    <table class="table table-bordered table-striped table-sm" style="font-size:13px">
        <thead>
            <tr>
                <th colspan="4">TRANSACTION</th>
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
                    <td style="text-align: right">{{ number_format($data->unit_price,2,".",",")  }}</td>
                    <td style="text-align: right">
                        {{ number_format($data->quantity * $data->unit_price,2,".",",") }}
                        @php
                            $total = $data->quantity*$data->unit_price;
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
                <th style="text-align: right">{{ number_format(array_sum($sum_total),2,".",",") }}</th>
            </tr>
        </tfoot>
    </table>
</div>