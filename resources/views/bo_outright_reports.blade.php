@extends('layouts.master')

 @section('title', 'VAN SELLING BO OUTRIGHT DEDUCTION REPORT')

 @section('navbar')


 @section('sidebar')


 @section('content')
  
    <br />
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title" style="font-weight: bold;">VAN SELLING BO OUTRIGHT DEDUCTION REPORT</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          <form id="bo_outright_report_proceed">
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
                <input type="hidden" name="full_name" value="{{ $agent_user->full_name }}">
                <input type="hidden" name="user_id" value="{{ $agent_user->user_id }}">
                <button class="btn btn-info btn-block" type="submit">GENERATE REPORT</button>
              </div>
            </div>
          </form>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <div id="bo_outright_report_proceed_page"></div>
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

       <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title" style="font-weight: bold;">VAN SELLING BO OUTRIGHT EXPORT DATA</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          <div id="bo_outright_report_proceed_to_export_page"></div>
        </div>
        <!-- /.card-body -->
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

    $("#bo_outright_report_proceed").on('submit',(function(e){
        e.preventDefault();
        //$('.loading').show();
          $.ajax({
            url: "bo_outright_report_proceed",
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
                    $('#bo_outright_report_proceed_page').hide();
                }else{
                  $('#bo_outright_report_proceed_page').html(data);
                  $('.loading').hide();
                }
            },
      });
    }));


</script>
</body>
</html>
@endsection
























