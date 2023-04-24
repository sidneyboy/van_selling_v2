@if (count($van_selling_transaction) != 0)
    <div class="table table-responsive">
        <table class="table table-bordered table-hovered table-striped table-sm" id="export_table">
            <thead>
                <tr>
                    <th>{{ $full_name }}</th>
                    <th>{{ $user_id }}</th>
                    <th></th>
                    <th style="text-transform: uppercase;" colspan="2">
                        {{ $full_name . '-VAN_SELLING_EXPORTED_DATA' . $time . '-' . $date_from . '-' . $date_to }}</th>
                    <th></th>
                    <th>DATE RANGE</th>
                    <th>{{ $date_from . ' - ' . $date_to }}</th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <th>DATE</th>
                    <th>CUSTOMER</th>
                    <th>DR NO</th>
                    <th>ID</th>
                    <th>DESCRIPTION</th>
                    <th>SKU TYPE</th>
                    <th>QTY</th>
                    <th>U/P</th>
                    <th>AMOUNT</th>
                    <th>REMARKS</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($van_selling_transaction as $data)
                    @foreach ($data->van_selling_transaction_details as $details)
                        @if ($data->status != 'CANCELLED')
                            <tr>
                                <td>{{ $data->date }}</td>
                                <td>{{ $data->store_name }}</td>
                                <td>{{ $data->delivery_receipt }}</td>
                                <td>{{ $details->sku_id }}</td>
                                <td>{{ $details->sku_code }}-{{ $details->description }}</td>
                                <td>{{ $details->sku->sku_type }}</td>
                                <td style="text-align: right">{{ $details->quantity }}</td>
                                <td style="text-align: right">{{ $details->price }}</td>
                                <td style="text-align: right">{{ $details->amount }}</td>
                                <td>{{ $details->remarks }}</td>
                            </tr>
                        @endif
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
@endif

{{-- <div class="row">
	<div class="col-md-12">
		<label>&nbsp;</label>
		<button class="btn btn-block btn-success" style="text-transform: uppercase;" onclick="exportTableToCSV('{{ "JAYMAR MACAHILOS-VAN_SELLING_EXPORTED_DATA-". $date_from ."-". $date_to }}.csv')">EXPORT TABLE DATA</button>
	</div>
</div> --}}

<script type="text/javascript">
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
