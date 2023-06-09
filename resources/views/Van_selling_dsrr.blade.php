 @extends('layouts.master')

 @section('title', 'VS DSRR ')

 @section('navbar')


 @section('sidebar')


 @section('content')

     <br />
     <!-- Main content -->
     <section class="content">
         <!-- Default box -->
         <div class="card">
             <div class="card-header">
                 <h3 class="card-title" style="font-weight: bold;">VS DSRR </h3>
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
                 <form id="van_selling_dsrr_generate_data">
                     <div class="row">
                         <div class="col-md-12">
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
                         <div class="col-md-12">
                             <div id="van_selling_dsrr_generate_principal_page"></div>
                         </div>

                         <div class="col-md-12">
                             <label>&nbsp;</label>
                             <div class="form-group">
                                 <input type="hidden" name="full_name" value="{{ $agent_user->full_name }}">
                                 <input type="hidden" name="user_id" value="{{ $agent_user->user_id }}">
                                 <button class="btn btn-info btn-block" type="button"
                                     id="generate_principal">Proceed</button>
                                 <button class="btn btn-success btn-block" id="generate_daily_sales" style="display: none;"
                                     type="submit">Generate Report</button>
                             </div>
                         </div>
                     </div>
                 </form>
             </div>
             <!-- /.card-body -->
             <div class="card-footer">
                 <div id="van_selling_dsrr_generate_data_page"></div>
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

         $("#generate_principal").click(function() {
             $('.loading').show();
             var reservation = $('#reservation').val();
             $.post({
                 type: "POST",
                 url: "/van_selling_dsrr_generate_principal",
                 data: 'reservation=' + reservation,
                 success: function(data) {
                     if (data == 'NO_DATA_FOUND') {
                         Swal.fire(
                             'CANNOT PROCEED!',
                             'NO DATA FOUND!',
                             'error'
                         )
                         $('.loading').hide();
                     } else {
                         $('.loading').hide();
                         $('#van_selling_dsrr_generate_principal_page').html(data);
                         $('#generate_principal').hide();
                         $('#generate_daily_sales').show();
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
         });

         $("#van_selling_dsrr_generate_data").on('submit', (function(e) {
             e.preventDefault();
             $('.loading').show();
             $.ajax({
                 url: "van_selling_dsrr_generate_data",
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
                     } else {
                         $('#van_selling_dsrr_generate_data_page').html(data);
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
         }));
     </script>
     </body>

     </html>
 @endsection
