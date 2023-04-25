 @extends('layouts.master')

 @section('title', 'VS EXPORT SALES ')

 @section('navbar')


 @section('sidebar')


 @section('content')

     <br />
     <!-- Main content -->
     <section class="content">
         <!-- Default box -->
         <div class="card">
             <div class="card-header">
                 <h3 class="card-title" style="font-weight: bold;">VS EXPORT SALES </h3>
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
                 <form action="{{ route('van_selling_export_sales_update_remarks') }}" method="post">
                     @csrf
                     <div class="table table-responsive">
                         <table class="table table-bordered table-sm table-striped" id="export_table">
                             <thead>
                                 <tr>
                                    <th></th>
                                     <th></th>
                                     <th></th>
                                     <th></th>
                                     <th></th>
                                     <th colspan="2" style="text-align: center;">VAN SELLING EXPORT</th>
                                     <th></th>
                                     <th></th>
                                     <th></th>
                                     <th></th>
                                     <th></th>
                                     <th></th>
                                 </tr>
                                 <tr>
                                     <th>{{ $agent_user->full_name }}</th>
                                     <th>{{ $agent_user->user_id }}</th>
                                     <th></th>
                                     <th style="text-transform: uppercase;" colspan="2">
                                         {{ $agent_user->full_name . '-VAN_SELLING_EXPORTED_DATA' . $date . '-' . $time }}
                                     </th>
                                     <th></th>
                                     <th>DATE EXPORTED</th>
                                     <th>{{ $date }}</th>
                                     <th></th>
                                     <th></th>
                                     <th></th>
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
                                     <th></th>
                                     <th></th>
                                     <th></th>
                                 </tr>
                                 <tr>
                                     <th>DATE</th>
                                     <th>CUSTOMER</th>
                                     <th>DR NO</th>
                                     <th>ID</th>
                                     <th>CODE</th>
                                     <th>DESCRIPTION</th>
                                     <th>TYPE</th>
                                     <th>QTY</th>
                                     <th>U/P</th>
                                     <th>AMOUNT</th>
                                     <th>LOCATION</th>
                                     <th>Barangay</th>
                                     <th>Address</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 @foreach ($van_selling_transaction as $data)
                                     @foreach ($data->van_selling_transaction_details as $details)
                                         @if ($data->status != 'CANCELLED')
                                             @if ($details->remarks != 'EXPORTED')
                                                 <tr>
                                                     <td>
                                                         {{ str_replace(',', '', $data->remarks) }}
                                                         <input type="hidden" name="details_id[]"
                                                             value="{{ $details->id }}">
                                                     </td>
                                                     <td>{{ str_replace(',', '', $data->store_name) }}</td>
                                                     <td>{{ str_replace(',', '', $data->delivery_receipt) }}</td>
                                                     <td>{{ str_replace(',', '', $details->sku_id) }}</td>
                                                     <td>{{ str_replace(',', '', $details->sku_code) }}</td>
                                                     <td>{{ str_replace(',', '', $details->description) }}</td>
                                                     <td>{{ str_replace(',', '', $details->sku->sku_type) }}</td>
                                                     <td>{{ str_replace(',', '', $details->quantity) }}</td>
                                                     <td>{{ str_replace(',', '', $details->price) }}</td>
                                                     <td>{{ str_replace(',', '', $details->amount) }}</td>
                                                     <td>{{ str_replace(',', '', $data->full_address) }}</td>
                                                     <td>{{ str_replace(',', '', $data->barangay) }}</td>
                                                     <td>{{ str_replace(',', '', $data->address) }}</td>
                                                 </tr>
                                             @endif
                                         @endif
                                     @endforeach
                                 @endforeach

                             </tbody>
                         </table>
                     </div>

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
             <!-- /.card-body -->
             <div class="card-footer">


             </div>
             <!-- /.card-footer-->
         </div>
         <!-- /.card -->

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
