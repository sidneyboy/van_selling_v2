 @extends('layouts.master')

 @section('title', 'VS CUSTOMER LIST')

 @section('navbar')


 @section('sidebar')


 @section('content')

     <br />
     <!-- Main content -->
     <section class="content">
         <!-- Default box -->
         <div class="card">
             <div class="card-header">
                 <h3 class="card-title" style="font-weight: bold;">VS CUSTOMER LIST READY FOR EXPORT</h3>
                 <div class="card-tools">
                     <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                         title="Collapse">
                         <i class="fas fa-minus"></i></button>
                     <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip"
                         title="Remove">
                         <i class="fas fa-times"></i></button>
                 </div>
             </div>
             <form action="{{ route('van_selling_customer_export_process') }}" method="post">
                 @csrf
                 <div class="card-body">
                     <div class="table table-responsive">
                         <table class="table table-bordered btn-sm table-striped table-hover"
                             id="export_table">
                             <thead>
                                 <tr>
                                     <th>ID</th>
                                     <th>LOCATION ID</th>
                                     <th>STORE NAME</th>
                                     <th>STORE TYPE</th>
                                     <th>BARANGAY</th>
                                     <th>ADDRESS</th>
                                     <th>CONTACT PERSON</th>
                                     <th>CONTACT NUMBER</th>
                                     <th>LATITUDE</th>
                                     <th>LONGITUDE</th>
                                     <th>STATUS</th>
                                     <th>VAN_SELLING_CUSTOMER_CSV_FILE</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 @foreach ($van_selling_customer_list as $data)
                                     <tr>
                                         <td>{{ str_replace(',', '', $data->id) }}</td>
                                         <td>{{ str_replace(',', '', $data->location_id) }}</td>
                                         <td>{{ str_replace(',', '', $data->store_name) }}</td>
                                         <td>{{ str_replace(',', '', $data->store_type) }}</td>
                                         <td>{{ str_replace(',', '', $data->barangay) }}</td>
                                         <td>{{ str_replace(',', '', $data->address) }}</td>
                                         <td>{{ str_replace(',', '', $data->contact_person) }}</td>
                                         <td>{{ str_replace(',', '', $data->contact_number) }}</td>
                                         <td>{{ str_replace(',', '', $data->longitude) }}</td>
                                         <td>{{ str_replace(',', '', $data->latitude) }}</td>
                                         <td>
                                             @if ($data->status == null)
                                                 <a class="btn btn-primary btn-block btn-sm"
                                                     href="{{ url('van_selling_customer_edit', ['id' => $data->id]) }}">(+)
                                                     Store Info</a>
                                                 <input type="hidden" id="need_to_update" value="need_to_update">
                                             @else
                                                 {{ $data->status }}
                                             @endif
                                         </td>
                                         <td>
                                             <input type="hidden" value="{{ $data->id }}" name="customer_id[]">
                                             Ready for Export
                                         </td>
                                     </tr>
                                 @endforeach
                             </tbody>
                             <tfoot>
                                 <tr>
                                     <th colspan="14">
                                         <button type="submit" style="display: none" id="trigger"></button>
                                     </th>
                                 </tr>
                             </tfoot>
                         </table>
                     </div>
                 </div>
                 <br />
             </form>

             <!-- /.card-body -->
             <div class="card-footer">
                 <div class="row">
                     @if (count($van_selling_customer_list) != 0)
                         <div class="col-md-3" style="margin-bottom: 10px;">
                             <button class="btn btn-success btn-sm btn-block" type="button"
                                 onclick="exportTableToCSV('VAN SELLING CUSTOMER AGENT SYSTEM.csv')">EXPORT
                                 CUSTOMER</button>

                         </div>
                         <div class="col-md-3" style="margin-bottom: 10px;">
                             <a href="{{ url('van_selling_upload_customer') }}"
                                 class="btn btn-sm btn-info btn-block">UPLOAD
                                 CUSTOMER</a>
                         </div>
                         <div class="col-md-3" style="margin-bottom: 10px;">
                             <a href="{{ url('van_selling_customer_geo_tag') }}"
                                 class="btn btn-sm btn-dark btn-block">CUSTOMER
                                 GEOTAG</a>
                         </div>
                         <div class="col-md-3" style="margin-bottom: 10px;">
                             <!-- Button trigger modal -->
                             <button type="button" class="btn btn-sm btn-secondary btn-block" data-toggle="modal"
                                 data-target="#exampleModal_barangay">
                                 BARANGAY GEOTAG
                             </button>

                             <!-- Modal -->
                             <div class="modal fade" id="exampleModal_barangay" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                 <div class="modal-dialog" role="document">
                                     <div class="modal-content">
                                         <div class="modal-header">
                                             <h5 class="modal-title" id="exampleModalLabel">BARANGAY</h5>
                                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                 <span aria-hidden="true">&times;</span>
                                             </button>
                                         </div>
                                         <form action="{{ route('van_selling_barangay_geo_tag') }}" method="get">
                                             @csrf
                                             <div class="modal-body">
                                                 <select name="barangay_data" class="form-control" required>
                                                     <option value="" default>Select</option>
                                                     @foreach ($barangay as $data_barangay)
                                                         <option value="{{ $data_barangay->barangay }}">
                                                             {{ $data_barangay->barangay }}</option>
                                                     @endforeach
                                                 </select>
                                             </div>
                                             <div class="modal-footer">
                                                 <button type="button" class="btn btn-sm btn-secondary"
                                                     data-dismiss="modal">Close</button>
                                                 <button type="submit" class="btn btn-sm btn-primary">PROCEED</button>
                                             </div>
                                         </form>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     @else
                         <div class="col-md-12">
                             <a href="{{ url('van_selling_upload_customer') }}" class="btn btn-info btn-block">UPLOAD
                                 CUSTOMER</a>
                         </div>
                     @endif
                 </div>
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

         //  $(document).ready(function() {
         //      // function getLocation() {
         //      if (navigator.geolocation) {
         //          navigator.geolocation.getCurrentPosition(showPosition);
         //      } else {
         //          x.innerHTML = "Geolocation is not supported by this browser.";
         //      }
         //      // }

         //      function showPosition(position) {
         //          $('#latitude').val(position.coords.latitude);
         //          $('#longitude').val(position.coords.longitude);
         //      },
         //  });

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

             if ($('#need_to_update').val() != 'need_to_update') {
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

                 $('#trigger').click();
             } else {
                 Swal.fire(
                     'Cannot Proceed',
                     'Need To Update Customer',
                     'error'
                 )

             }

         }
     </script>
     </body>

     </html>
 @endsection
