<div class="table table-responsive">
    <table class="table table-sm" style="font-family: Arial, Helvetica, sans-serif;" id="export_table">
        <thead>
            <tr>
                <th style="text-align: center;">PRE INVENTORY COUNT</th>
                <th style="text-align: center;">{{ $principal }}</th>
                <th></th>
            </tr>
            <tr>
                <th style="text-align: center;">DATE</th>
                <th style="text-align: center;">{{ $date }}</th>
                <th></th>
            </tr>
            <tr>
                <th style="text-align: center;">SALESMAN</th>
                <th style="text-align: center;">{{ $agent_user->full_name }}</th>
                <th></th>
            </tr>
            <tr>
                <th style="text-align: center;">DESCRIPTION</th>
                <th style="text-align: center;">ACTUAL</th>
                <th style="text-align: center;">TOTAL ACTUAL</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sku_code as $data)
                @php
                    $ledger = DB::select(DB::raw("SELECT * FROM(SELECT * FROM Van_selling_upload_ledgers WHERE sku_code = '$data' ORDER BY id DESC LIMIT 1)Var1 ORDER BY id ASC"));
                @endphp
                <tr>
                    <th>{{ $ledger[0]->sku_code }} - {{ $ledger[0]->description }} - {{ $ledger[0]->unit_price }}
                        - RB: {{ $ledger[0]->end }}</th>
                    <th style="text-align: right;">{{ $quantity[$data] }}</th>
                    <th style="text-align: right">
                        @php
                            $total_inventory_sum[] = $ledger[0]->end * $ledger[0]->unit_price;
                            $total_actual = $quantity[$data] * $ledger[0]->unit_price;
                            $total_actual_sum[] = $total_actual;
                            echo $total_actual;
                        @endphp
                    </th>
                </tr>
                <tr>
                    <th style="text-align: right;">REMARKS: </th>
                    <th style="text-align: center;"> {{ $remarks[$data] }}</th>
                    <th></th>
                </tr>
            @endforeach
            <tr>
                <th>INV LEDGER x UNIT PRICE</th>
                <th></th>
                <th style="text-align: right">{{ array_sum($total_inventory_sum) }}</th>
            </tr>
            <tr>
                <th>ACTUAL x UNIT PRICE</th>
                <th></th>
                <th style="text-align: right">{{ array_sum($total_actual_sum) }}</th>
            </tr>
            <tr>
                <th>(OVER) / SHORT</th>
                <th></th>
                <th style="text-align: right">{{ array_sum($total_inventory_sum) - array_sum($total_actual_sum) }}
                </th>
            </tr>
        </tbody>
    </table>
</div>


<div id="result"></div>


<div class="row">
    <div class="col-md-12">
        <button class="btn btn-info btn-block" id="convert">DOWNLOAD PRE INVENTORY</button>
    </div>
    <br /> <br />
    <div class="col-md-12">
        <br />
        <button class="btn btn-block btn-success" style="text-transform: uppercase;"
            onclick="exportTableToCSV('{{ $agent_user->full_name . '-VAN_SELLING_PRE_INVENTORY-' . $date }}.csv')">EXPORT
            TABLE DATA</button>
    </div>
</div>

<script>
    $("#convert").on('click', (function(e) {
        $('.loading').show();
        var resultDiv = document.getElementById("result");
        html2canvas(document.getElementById("export_table"), {
            onrendered: function(canvas) {
                var img = canvas.toDataURL("image/png");
                result.innerHTML =
                    '<a download="PRE INVENTORY.jpeg" style="display:block;width:100%;border:none;background-color: #04AA6D;padding: 14px 28px;font-size: 16px;cursor: pointer;text-align: center;color:white;" href="' +
                    img + '" id="download_button">DOWNLOAD IMAGE</a>';
                $('.loading').hide();
                document.getElementById('download_button').click();
                $('#download_button').hide();
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
        var csv = [];
        var rows = document.querySelectorAll("#export_table tr");

        for (var i = 0; i < rows.length; i++) {
            var row = [],
                cols = rows[i].querySelectorAll("td, th");

            for (var j = 0; j < cols.length; j++)
                row.push(cols[j].innerText);

            csv.push(row.join(","));
        }

        // Download CSV file
        downloadCSV(csv.join("\n"), filename);
    }
</script>
