@if ($search_for == 'dsrr')
    <div class="table table-responsive">
        <table class="table table-bordered table-sm table-striped" id="dsrr_table"
            style="font-size:20px;font-family: Arial, Helvetica, sans-serif;">
            <thead>
                <tr>
                    <th colspan="4" style="text-align: center;">JULMAR COMMERCIAL INC.</th>
                </tr>
                <tr>
                    <th colspan="4" style="text-align: center;">Kauswagan Cagayan de Oro City</th>
                </tr>
                <tr>
                    <th colspan="4" style="text-align: center;">DAILY SALES REMITTANCE REPORT</th>
                </tr>
                <tr>
                    <th colspan="4" style="text-align: center;">{{ $full_name }}</th>
                </tr>
                <tr>
                    <th colspan="4" style="text-align: center;">{{ $date_from . ' TO ' . $date_to }}</th>
                </tr>
                <tr>
                    <th>CSI #</th>
                    <th>STORE</th>
                    <th>BO</th>
                    <th>AMOUNT</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($van_selling_transaction as $data)
                    <tr>
                        <th>{{ $data->delivery_receipt }}</th>
                        <th>{{ $data->store_name }}
                        </th>
                        <th style="text-align: right;">({{ $data->bo_amount }})</th>
                        <th style="text-align: right;">
                            @php
                                $total = $data->total_amount + $data->bo_amount;
                                $sum_total[] = $total;
                                $sum_bo_amount[] = $data->bo_amount;
                                echo $total;
                            @endphp
                        </th>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th style="text-align: center">GROSS::</th>
                    <th></th>
                    <th></th>
                    <th style="text-align: right;">{{ array_sum($sum_total) }}</th>
                </tr>
                <tr>
                    <th style="text-align: center">TOTAL BO:</th>
                    <th></th>
                    <th></th>
                    <th style="text-align: right;">({{ array_sum($sum_bo_amount) }})</th>
                </tr>
                <tr>
                    <th style="text-align: center;">TOTAL SALES:</th>
                    <th></th>
                    <th></th>
                    <th style="text-align: right;">{{ array_sum($sum_total) - array_sum($sum_bo_amount) }}</th>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-info btn-block" id="convert">DOWNLOAD DSRR</button>
            <div style="" id="result"></div>
        </div>
        <div class="col-md-12">
            <label>&nbsp;</label>
            <button class="btn btn-block btn-success"
                onclick="exportTableToCSV('{{ $full_name . ' ' . $search_for . ' ' . $date_from . ' - ' . $date_to }}.csv')">EXPORT
                DATA</button>
        </div>
    </div>
@elseif($search_for == 'all_principal')
    <div class="table table-responsive">
        <table class="table table-bordered table-sm table-striped" id="dsrr_table"
            style="font-size:19px;font-family: Arial, Helvetica, sans-serif;">
            <thead>
                <tr>
                    <th colspan="5" style="text-align: center;">JULMAR COMMERCIAL INC.</th>
                </tr>
                <tr>
                    <th colspan="5" style="text-align: center;">Kauswagan Cagayan de Oro City</th>
                </tr>
                <tr>
                    <th colspan="5" style="text-align: center;">All Principal</th>
                </tr>
                <tr>
                    <th colspan="5" style="text-align: center;">{{ $full_name }}</th>
                </tr>
                <tr>
                    <th colspan="5" style="text-align: center;">FROM {{ $date_from . ' TO ' . $date_to }}</th>
                </tr>
                <tr>
                    <th>STORE</th>
                    <th>DESC</th>
                    <th>QTY</th>
                    <th>AMOUNT</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($van_selling_transaction as $data)
                    @foreach ($data->van_selling_transaction_details as $details)
                        <tr>
                            <th>{{ $data->store_name }}</th>
                            <th>
                                {{$details->sku_code}} <b>({{ $details->sku->sku_type }})</b> <br />
                                {{ $details->description }} <br />{{ $details->price }}</th>
                            <th style="text-align: right;">{{ $details->quantity }}</th>
                            <th style="text-align: right;">
                                @php
                                    $amount = $details->price * $details->quantity;
                                    $sum_amount[] = $amount;
                                    echo $amount;
                                @endphp
                            </th>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>TOTAL</th>
                    <th></th>
                    <th></th>
                    <th style="text-align: right;">{{ array_sum($sum_amount) }}</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-info btn-block" id="convert">DOWNLOAD DSRR</button>
            <div style="" id="result"></div>
        </div>
        <div class="col-md-12">
            <label>&nbsp;</label>
            <button class="btn btn-block btn-success"
                onclick="exportTableToCSV('{{ $full_name . ' ' . $search_for . ' ' . $date_from . ' - ' . $date_to }}.csv')">EXPORT
                DATA</button>
        </div>
    </div>
@else
    <div class="table table-responsive">
        <table class="table table-bordered table-sm table-striped" id="dsrr_table"
            style="font-size:19px;font-family: Arial, Helvetica, sans-serif;">
            <thead>
                <tr>
                    <th colspan="5" style="text-align: center;">JULMAR COMMERCIAL INC.</th>
                </tr>
                <tr>
                    <th colspan="5" style="text-align: center;">Kauswagan Cagayan de Oro City</th>
                </tr>
                <tr>
                    <th colspan="5" style="text-align: center;">{{ $search_for }}</th>
                </tr>
                <tr>
                    <th colspan="5" style="text-align: center;">{{ $full_name }}</th>
                </tr>
                <tr>
                    <th colspan="5" style="text-align: center;">{{ $date_from . ' TO ' . $date_to }}</th>
                </tr>
                <tr>
                    <th>STORE</th>
                    <th>DESC</th>
                    <th>QTY</th>
                    <th>AMOUNT</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($van_selling_transaction_details as $details)
                    <tr>
                        <th>{{ $details->van_selling_transaction->store_name }}</th>
                        <th>
                                {{$details->sku_code}}<br />

                                {{ $details->description }} <br />  {{ $details->price }}</th>
                        <th style="text-align: right;">{{ $details->quantity }}</th>
                        <th style="text-align: right;">
                            @php
                                $amount = $details->price * $details->quantity;
                                $sum_amount[] = $amount;
                                echo $amount;
                            @endphp
                        </th>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>TOTAL</th>
                    <th></th>
                    <th></th>
                    <th style="text-align: right;">{{ array_sum($sum_amount) }}</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-info btn-block" id="convert">SCREENSHOT</button>
            <div style="" id="result"></div>
        </div>
        <div class="col-md-12">
            <label>&nbsp;</label>
            <button class="btn btn-block btn-success"
                onclick="exportTableToCSV('{{ $full_name . ' ' . $search_for . ' ' . $date_from . ' - ' . $date_to }}.csv')">EXPORT</button>
        </div>
    </div>
@endif

<script type="text/javascript">
    $("#convert").on('click', (function(e) {
        $('.loading').show();
        var resultDiv = document.getElementById("result");
        html2canvas(document.getElementById("dsrr_table"), {
            onrendered: function(canvas) {
                var img = canvas.toDataURL("image/png");
                result.innerHTML =
                    '<a download="dsrr.jpeg" style="display:block;width:100%;border:none;background-color: #04AA6D;padding: 14px 28px;font-size: 16px;cursor: pointer;text-align: center;color:white;" href="' +
                    img + '" id="download_button">DOWNLOAD IMAGE</a>';
                $('.loading').hide();
                document.getElementById('download_button').click();

                $('#download_button').hide();
                window.location.replace("{{ route('van_selling_transaction_report') }}");
            }
        });
    }));

    function downloadCSV(csv, filename) {
        var csvFile;
        var downloadLink;

        // CSV file
        csvFile = new Blob([csv], {
            type: "text/csv"
        });

        // Download link
        downloadLink = document.createElement("a");

        // File name
        downloadLink.download = filename;

        // Create a link to the file
        downloadLink.href = window.URL.createObjectURL(csvFile);

        // Hide download link
        downloadLink.style.display = "none";

        // Add the link to DOM
        document.body.appendChild(downloadLink);

        // Click download link
        downloadLink.click();
    }

    function exportTableToCSV(filename) {
        $('.loading').show();
        var csv = [];
        var rows = document.querySelectorAll("#dsrr_table tr");

        for (var i = 0; i < rows.length; i++) {
            var row = [],
                cols = rows[i].querySelectorAll("td, th");

            for (var j = 0; j < cols.length; j++)
                row.push(cols[j].innerText);

            csv.push(row.join(","));
        }

        // Download CSV file
        downloadCSV(csv.join("\n"), filename);
        window.location.replace("{{ route('van_selling_transaction') }}");
    }
</script>
