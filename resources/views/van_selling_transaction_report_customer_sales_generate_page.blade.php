@if (count($van_selling_transaction) != 0)
    <div class="table table-responsive" id="printableArea">
        <table class="table table-bordered table-hovered table-striped table-sm" id="export_table">
            <thead>
                <tr>
                    <th>{{ $full_name }}</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>DATE RANGE</th>
                    <th>{{ $date_from . ' - ' . $date_to }}</th>
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
                </tr>
                <tr>
                    <th>ADDRESS</th>
                    <th>DATE</th>
                    <th>CUSTOMER</th>
                    <th>DR</th>
                    <th>PCM</th>
                    <th>BO DEDUCTION</th>
                    <th>AMOUNT</th>
                    <th>STATUS</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($van_selling_transaction as $data)
                    <tr>
                        <td>{{ $data->full_address }}</td>
                        <td>{{ $data->date }}</td>
                        <td>{{ $data->store_name }}</td>
                        <td>{{ $data->delivery_receipt }}</td>
                        <td>{{ $data->pcm_number }}</td>
                        <td style="text-align: right">{{ $data->bo_amount }}</td>
                        <td style="text-align: right;">
                            @if ($data->status != 'CANCELLED')
                                @php
                                    $data_sales = $data->total_amount;
                                    echo $data_sales;
                                @endphp
                            @else
                                @php
                                    $data_sales = $data->total_amount * -1;
                                    echo $data_sales;
                                @endphp
                            @endif
                            @php
                                $sum_total[] = $data_sales;
                            @endphp
                        </td>
                        <td>
                            @if ($data->status != 'CANCELLED')
                                <button class="btn btn-block btn-warning cancel_button"
                                    value="{{ $data->id }}">PAID</button>
                            @else
                                {{ $data->status }}
                            @endif
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <th>GRAND TOTAL</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th style="text-align: right;">{{ array_sum($sum_total) }}</th>
                    <th></th>

                </tr>
            </tbody>
        </table>
    </div>

    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-block btn-success"
                onclick="exportTableToCSV('SALES REPORT {{ strtoupper($full_name) . ' ' . $date_from . ' - ' . $date_to }}.csv')">EXPORT
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

    $(".cancel_button").on("click", function() {
        (async () => {
            const {
                value: text
            } = await Swal.fire({
                input: 'textarea',
                inputLabel: 'Message',
                inputPlaceholder: 'Type your message here...',
                inputAttributes: {
                    'aria-label': 'Type your message here'
                },
                showCancelButton: true
            })

            if (text) {
                var van_selling_transaction_id = $(this).val();
                $('.loading').show();
                $.post({
                    type: "POST",
                    url: "/van_selling_transaction_report_cancel",
                    data: 'van_selling_transaction_id=' + van_selling_transaction_id +
                        '&text=' + text,
                    success: function(data) {
                        $('.loading').hide();
                        if (data == 'saved') {
                            Swal.fire(
                                'Transaction Cancelled!',
                                'Transaction rollback successfully',
                                'success'
                            )
                            $('.loading').hide();
                            $("#trigger_button_if_cancel_status").trigger("click");
                        } else {
                            Swal.fire(
                                'Something went wrong!',
                                'Code error',
                                'error'
                            )
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
            }

        })()
    });
</script>
