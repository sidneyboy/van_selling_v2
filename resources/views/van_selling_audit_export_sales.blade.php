 @extends('layouts.master')

 @section('title', 'VS AUDIT EXPORT SALES ')

 @section('navbar')


 @section('sidebar')


 @section('content')
  
    <br />
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title" style="font-weight: bold;">VS AUDIT EXPORT SALES </h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          <form id="van_selling_audit_export_sales_generate_data">
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
                  <input type="text" class="form-control float-right" id="reservation" name="date_range" required>
                </div>
                </div>
              </div>
              <div class="col-md-12">
              	<label>AUDIT ACCESS KEY:</label>
              	<input type="password" name="password" required id="password" class="form-control">
              </div>

              <div class="col-md-12">
                <label>&nbsp;</label>
                <div class="form-group">
                  <input type="hidden" name="full_name" value="{{ $agent_user->full_name }}">
                  <input type="hidden" name="user_id" value="{{ $agent_user->user_id }}">
                  <button class="btn btn-info btn-block" type="button" id="check_password">PROCEED</button>
                  <button class="btn btn-success btn-block" id="generate_export_sales" style="display: none;" type="submit">GENERATE DATA</button>
                </div>
              </div>
            </div>
          </form>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <div id="van_selling_audit_export_sales_generate_data_page"></div>
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

  $( "#check_password" ).click(function() {
    $('.loading').show();
    var password = $('#password').val();
      $.post({
        type: "POST",
        url: "/van_selling_audit_export_sales_check_password",
        data: 'password=' + password,
        success: function(data){
          if (data == 'wrong_credentials') {
              Swal.fire(
                'CANNOT PROCEED!',
                'WRONG CREDENTIALS',
                'error'
              )
              $('.loading').hide();
          }else{
            $('.loading').hide();
            $('#check_password').hide();
            $('#generate_export_sales').show();
          }         
        },
        error: function(error){
          console.log(error);
        }
      });
  });

  $("#van_selling_audit_export_sales_generate_data").on('submit',(function(e){
        e.preventDefault();
        $('.loading').show();
          $.ajax({
            url: "van_selling_audit_export_sales_generate_data",
            type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            success: function(data){
              console.log(data);
                if (data == 'NO_DATA_FOUND') {
                    Swal.fire(
                        'CANNOT PROCEED!',
                        'NO DATA FOUND!',
                        'error'
                    )
                    $('.loading').hide();
                }else{
                  $('#van_selling_audit_export_sales_generate_data_page').html(data);
                  $('.loading').hide();
                }
            },
      });
    }));




</script>
</body>
</html>
@endsection
























