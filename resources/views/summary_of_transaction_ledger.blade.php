 @extends('layouts.master')

 @section('title', 'TRANSACTION LEDGER')

 @section('navbar')


 @section('sidebar')


 @section('content')
  
    <br />
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title" style="font-weight: bold;">TRANSACTION LEDGER <span style="color:red;">(SUMMARY OF TRANSACTION REPORT)</span></h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          <form id="summary_of_transaction_ledger_generate">
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
                <button type="submit" class="btn btn-info btn-block">GENERATE LEDGER</button>
              </div>
            </div>
          </form>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <div id="summary_of_transaction_ledger_generate_page"></div>
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title" style="font-weight: bold;">DETAILED REPORT(<span style="color:blue;">REFERENCE ID</span>)</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          <div id="summary_of_transaction_ledger_generate_detailed_report_page"></div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          
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


 


  $("#summary_of_transaction_ledger_generate").on('submit',(function(e){
        e.preventDefault();
        $('.loading').show();
        
          $.ajax({
            url: "summary_of_transaction_ledger_generate",
            type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            success: function(data){
              console.log(data);
              $('.loading').hide();
               $('#summary_of_transaction_ledger_generate_page').html(data);
            },
      });
    }));


</script>
</body>
</html>
@endsection
























