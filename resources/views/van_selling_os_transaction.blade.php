@extends('layouts.master')
@section('title', 'VS - TRANSACTION')
@section('navbar')
@section('sidebar')
@section('content')

    <br />
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title" style="font-weight: bold;">VAN SELLING OS TRANSACTION</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip"
                        title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('van_selling_export_os_update_remarks') }}" method="post">
                    @csrf
                    <table class="table table-bordered table-sm table-striped" id="export_table">
                        <thead>
                            <tr>
                                <th>VAN SELLING OS REPORT</th>
                                <th>{{ $agent_user->full_name }}</th>
                                <th>{{ $agent_user->user_id }}</th>
                                <th>{{ $date ."-". uniqid() }}</th>
                                <th></th>
                                <th></th>
                            </tr>
                            <tr>
                                <th>Date</th>
                                <th>Store</th>
                                <th>SKU ID</th>
                                <th>Code</th>
                                <th>Qty</th>
                                <th>Unit Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($os as $data)
                                <tr>
                                    <th>{{ $data->date }}
                                        <input type="hidden" name="id[]"  value="{{ $data->id }}">
                                    </th>
                                    <th>{{ $data->store_name }}</th>
                                    <th>{{ $data->sku_code }}</th>
                                    <th>{{ $data->sku_id }}</th>
                                    <th>{{ $data->quantity }}</th>
                                    <th>{{ $data->unit_price }}</th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-12">
                            <label>&nbsp;</label>
                            <button class="btn btn-block btn-success" style="text-transform: uppercase;"
                                onclick="exportTableToCSV('{{ $agent_user->full_name . '-VAN_SELLING_SALES-' . $date . '-' . $time }}.csv')">EXPORT
                                TABLE DATA</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>

        {{-- <div class="card">
            <div class="card-header">
                <h3 class="card-title" style="font-weight: bold;"></h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip"
                        title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div id="van_selling_os_transaction_summary_page"></div>
            </div>
        </div> --}}

        {{-- <div class="card">
            <div class="card-header">
                <h3 class="card-title" style="font-weight: bold;">SUMMARY</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip"
                        title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div id="van_selling_os_transaction_final_summary_page"></div>
            </div>
            <div class="card-footer">

            </div>
            <!-- /.card -->
        </div> --}}
    </section>
    <!-- /.content -->
@endsection

@section('footer')
    @parent
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

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
    </body>

    </html>
@endsection
