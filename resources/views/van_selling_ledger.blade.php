 @extends('layouts.master')

 @section('title', 'VS LEDGER DATA')

 @section('navbar')


 @section('sidebar')


 @section('content')
  
    <br />
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title" style="font-weight: bold;">VS LEDGER DATA</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          <form id="van_selling_ledger_generate">
            <div class="row">
              <div class="col-md-12">
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
                <div class="form-group">
                  <label>&nbsp;</label>
                  <input type="hidden" name="agent_user" value="{{ $agent_user->full_name }}">
                  <button class="btn btn-success btn-block" type="submit">GENERATE VAN SELLING LEDGER</button>
                </div>
              </div>
            </div>
          </form>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <div id="van_selling_ledger_generate_page"></div>
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title" style="font-weight: bold;">SKU LEDGER DETAILS</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          <div id="van_selling_ledger_show_details_page"></div>
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

  $("#van_selling_ledger_generate").on('submit',(function(e){
        e.preventDefault();
        $('.loading').show();
          $.ajax({
            url: "van_selling_ledger_generate",
            type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            success: function(data){
            
                 if (data == 'NO_DATA_FOUND') {
                  Swal.fire(
                    'NO DATA FOUND!',
                    'CANNOT PROCEED!',
                    'error'
                  )
                  $('.loading').hide();
                 }else{
                  $('#van_selling_ledger_generate_page').html(data);
                  $('.loading').hide();
                 }
            },
      });
    }));


</script>
</body>
</html>
@endsection
























