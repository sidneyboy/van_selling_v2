 @extends('layouts.master')

 @section('title', 'VS REPORT ')

 @section('navbar')


 @section('sidebar')


 @section('content')

     <br />
     <!-- Main content -->
     <section class="content">
         <!-- Default box -->
         <div class="card">
             <div class="card-header">
                 <h3 class="card-title" style="font-weight: bold;">VS REPORT </h3>
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
                 <form id="van_selling_transaction_report_generate">
                     <div class="row">
                         <div class="col-md-6">
                             <label>DATE RANGE:</label>
                             <div class="form-group">
                                 <div class="input-group">
                                     <div class="input-group-prepend">
                                         <span class="input-group-text">
                                             <i class="far fa-calendar-alt"></i>
                                         </span>
                                     </div>
                                     <input type="text" class="form-control float-right" id="reservation"
                                         name="date_range" required>
                                 </div>
                             </div>
                         </div>
                         <div class="col-md-6">
                             <label>SEARCH FOR:</label>
                             <select class="form-control select2" style="width:100%;" name="search_for" required>
                                 <option value="" default>SELECT</option>
                                 <option value="CUSTOMER_SALES_REPORT">CUSTOMER SALES REPORT</option>
                                 <option value="DETAILED_CUSTOMER_SALES_REPORT">DETAILED CUSTOMER SALES REPORT</option>
                                 <option value="OS_REPORT">OS REPORT</option>
                                 <option value="CALLS">PRODUCTIVE CALLS</option>
                             </select>
                         </div>
                         <div class="col-md-12">
                            <br />
                             <div class="form-group">
                                 <input type="hidden" name="full_name" value="{{ $agent_user->full_name }}">
                                 <input type="hidden" name="user_id" value="{{ $agent_user->user_id }}">
                                 <button class="btn btn-info btn-block" type="submit"
                                     id="trigger_button_if_cancel_status">GENERATE</button>
                             </div>
                         </div>
                     </div>
                 </form>
             </div>
             <!-- /.card-body -->
             <div class="card-footer">
                 <div id="van_selling_transaction_report_generate_page"></div>
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

         $("#van_selling_transaction_report_generate").on('submit', (function(e) {
             e.preventDefault();
             $('.loading').show();
             $.ajax({
                 url: "van_selling_transaction_report_generate",
                 type: "POST",
                 data: new FormData(this),
                 contentType: false,
                 cache: false,
                 processData: false,
                 success: function(data) {
                     console.log(data);
                     if (data == 'NO_DATA_FOUND') {
                         Swal.fire(
                             'CANNOT PROCEED!',
                             'NO DATA FOUND!',
                             'error'
                         )
                         $('.loading').hide();
                         $('#van_selling_transaction_report_generate_page').hide();
                     } else {
                         $('#van_selling_transaction_report_generate_page').html(data);
                         $('.loading').hide();
                     }
                 },
             });
         }));
     </script>
     </body>

     </html>
 @endsection
