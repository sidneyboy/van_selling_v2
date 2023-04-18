@if (count($van_selling_os_data) != 0)
    <div class="table table-responsive" id="printableArea">
        <table class="table table-bordered table-sm table-striped" id="export_table">
            <thead>
                <tr>
                    <th>{{ $full_name }}</th>
                    <th>{{ $user_id }}</th>
                    <th>OUT OF STOCK</th>
                    <th>REPORT</th>
                    <th>{{ uniqid() }}</th>
                    <th>DATE RANGE</th>
                    <th>{{ $date_from . ' - ' . $date_to }}</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <th>STORE NAME</th>
                    <th>INVENTORY ID</th>
                    <th>CODE</th>
                    <th>DESCRIPTION</th>
                    <th>QUANTITY</th>
                    <th>OS U/P</th>
                    <th>OS SUB TOTAL</th>
                    <th>OS DATE</th>
                    <th>SERVED QTY</th>
                    <th>SERVED U/P</th>
                    <th>SERVED SUB TOTAL</th>
                    <th>SERVED DATE</th>
                    <th>PRINCIPAL</th>
                    <th>CODE</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($van_selling_os_data as $data)
                    <tr>
                        <td>{{ strtoupper(str_replace(',', '', $data->store_name)) }}</td>
                        <td>{{ $data->van_selling_inventory_id }}</td>
                        <td>{{ strtoupper($data->sku_code) }}</td>
                        <td>{{ strtoupper($data->description) }}</td>
                        <td>{{ $data->quantity }}</td>
                        <td>{{ $data->unit_price }}</td>
                        <th>{{ $data->quantity * $data->unit_price }}</th>
                        <td>{{ $data->date }}</td>
                        <td>{{ $data->served_quantity }}</td>
                        <td>{{ $data->served_unit_price }}</td>
                        <th>{{ $data->served_quantity * $data->served_unit_price }}</th>
                        <td>{{ $data->served_date }}</td>
                        <td>{{ strtoupper($data->principal) }}</td>
                        <td>{{ $data->code }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>

    <div class="row">
        {{-- <div class="col-md-6">
          <a href="{{ route('van_selling_transaction_report_print_table', $date_from ."=". $date_to) }}" class="btn btn-info btn-block" target="_blank">PRINT TABLE</a><br />
</div> --}}
        <div class="col-md-12">
            <button class="btn btn-block btn-success"
                onclick="exportTableToCSV('VAN SELLING OS REPORT {{ strtoupper($full_name) . ' ' . $date_from . ' - ' . $date_to }}.csv')">EXPORT
                TABLE DATA</button>
        </div>
    </div>

@endif
<script type="text/javascript">
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }


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

    //     $(".cancel_button").on("click", function() {
    //         (async () => {
    //             const {
    //                 value: text
    //             } = await Swal.fire({
    //                 input: 'textarea',
    //                 inputLabel: 'Message',
    //                 inputPlaceholder: 'Type your message here...',
    //                 inputAttributes: {
    //                     'aria-label': 'Type your message here'
    //                 },
    //                 showCancelButton: true
    //             })

    //             if (text) {
    //                 var van_selling_transaction_id = $(this).val();
    //                 $('.loading').show();
    //                 $.post({
    //                     type: "POST",
    //                     url: "/van_selling_transaction_report_cancel",
    //                     data: 'van_selling_transaction_id=' + van_selling_transaction_id +
    //                         '&text=' + text,
    //                     success: function(data) {
    //                         console.log(data);
    //                         if (data == 'saved') {
    //                             Swal.fire(
    //                                 'Transaction Cancelled!',
    //                                 'Transaction rollback successfully',
    //                                 'success'
    //                             )
    //                             $('.loading').hide();
    //                             $("#trigger_button_if_cancel_status").trigger("click");
    //                         } else {
    //                             Swal.fire(
    //                                 'Something went wrong!',
    //                                 'Code error',
    //                                 'error'
    //                             )
    //                             $('.loading').hide();
    //                         }
    //                     },
    //                     error: function(error) {
    //                         console.log(error);
    //                     }
    //                 });
    //             }

    //         })()
    //     });
</script>
