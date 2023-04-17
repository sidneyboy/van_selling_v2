 @extends('layouts.master')

 @section('title', 'REMITANCES')

 @section('navbar')


 @section('sidebar')


 @section('content')
  
    <br />
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title" style="font-weight: bold;">REMITANCES</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          <form id="remitances_locpd_generate_report">
            <div class="row">
              <div class="col-md-6">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="far fa-calendar-alt"></i>
                    </span>
                  </div>
                  <input type="text" class="form-control float-right" id="reservation" name="date_range" required>
                </div>
              </div>
              <div class="col-md-6">
                <input type="hidden" name="agent" value="{{ $agent->name}}">
                <button type="submit" class="btn btn-info btn-block">PROCEED AND GENERATE</button>
              </div>
            </div>
          </form>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <div id="remitances_locpd_generate_report_page"></div>
        </div>
        <!-- /.card-footer-->
      </div>
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


  $("#remitances_locpd_generate_report").on('submit',(function(e){
        e.preventDefault();
        $('.loading').show();
          $.ajax({
            url: "remitances_locpd_generate_report",
            type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            success: function(data){
              console.log(data);
               if (data == 'NO_DATA') {
                Swal.fire(
                  'CANNOT PROCEED!',
                  'NO DATA FOUND!',
                  'error'
                )
                $('.loading').hide();
               }else{
                  $('.loading').hide();
                  $('#remitances_locpd_generate_report_page').html(data);
               }
            },
      });
    }));


</script>
</body>
</html>
@endsection
























