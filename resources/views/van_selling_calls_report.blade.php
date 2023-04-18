@if (count($van_selling_calls) != 0)
    <form action="van_selling_calls_report_export" method="post">
        <div class="table table-responsive" id="printableArea">
            <table class="table table-bordered table-hovered table-sm table-striped" id="export_table">
                <thead>
                    <tr>
                        <th>PRODUCTIVE CALLS</th>
                        <th></th>
                        <th></th>
                        <th>{{ $van_selling_productive_calls }}</th>
                    </tr>
                    <tr>
                        <th>UNPRODUCTIVE CALLS</th>
                        <th></th>
                        <th></th>
                        <th>{{ $van_selling_unproductive_calls }}</th>
                    </tr>
                    <tr>
                        <th>TOTAL CALLS</th>
                        <th></th>
                        <th></th>
                        <th>{{ $van_selling_productive_calls + $van_selling_unproductive_calls }}</th>
                    </tr>
                    <tr>
                        <th>{{ $full_name }}</th>
                        <th>{{ $user_id }}</th>
                        <th>CALLS REPORT</th>
                        <th>DATE RANGE: {{ $date_from . ' - ' . $date_to }}</th>
                    </tr>
                    <tr>
                        <th>STORE NAME</th>
                        <th>ADDRESS</th>
                        <th>DATE</th>
                        <th>REMARKS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($van_selling_calls as $data)
                        <tr>
                            <td>{{ strtoupper(str_replace(',', '', $data->store_name)) }}</td>
                            <td>{{ $data->address }}</td>
                            <td>{{ $data->date }}</td>
                            <td>
                                {{ $data->remarks }}
                                <input type="hidden" name="id[]" value="{{ $data->id }}">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="row">
            <div class="col-md-12">
                <button class="btn btn-block btn-success" onclick="exportTableToCSV('OS REPORT {{ strtoupper($full_name) . ' ' . $date_from . ' - ' . $date_to }}.csv')" type="submit">EXPORT
                    TABLE DATA</button>
            </div>
        </div>

    </form>
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
