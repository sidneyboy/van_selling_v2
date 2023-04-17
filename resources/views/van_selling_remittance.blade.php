 @extends('layouts.master')

 @section('title', 'VS REMITTANCE')

 @section('navbar')


 @section('sidebar')


 @section('content')
  
    <br />
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title" style="font-weight: bold;">VS REMITTANCE</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          <form id="van_selling_remittance_summary">
            <div class="row">
              <div class="col-md-6">
                <label>Prev. Outstanding Balance:</label>
                <input type="text" style="text-align: center;" disabled value="{{ number_format($van_selling_ar_ledger->running_balance,2,".",",") }}" required class="form-control">
                <input type="hidden" name="prev_outstanding_balance"  value="{{ $van_selling_ar_ledger->running_balance }}" required class="form-control">
              </div>
              <div class="col-md-6">
                <label>Remittance:</label>
                <input type="text" name="remittance" class="currency-default" required style="display: block;
                width: 100%;
                height: calc(2.25rem + 2px);padding: 0.375rem 0.75rem;font-size: 1rem;
                font-weight: 400;
                line-height: 1.5;
                color: #495057;
                background-color: #fff;
                background-clip: padding-box;
                border: 1px solid #ced4da;
                border-radius: 0.25rem;
                box-shadow: inset 0 0 0 transparent;
                transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;text-align: center;">
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>&nbsp;</label>
                  <input type="hidden" name="agent_user" value="{{ $agent_user->full_name }}">
                  <button class="btn btn-info btn-block" type="submit">GENERATE VAN SELLING LEDGER</button>
                </div>
              </div>
            </div>
          </form>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <div id="van_selling_remittance_summary_page"></div>
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

  $("#van_selling_remittance_summary").on('submit',(function(e){
        e.preventDefault();
        $('.loading').show();
          $.ajax({
            url: "van_selling_remittance_summary",
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
                  $('#van_selling_remittance_summary_page').html(data);
                  $('.loading').hide();
                 }
            },
      });
    }));

   $('[class=currency-default]').maskNumber();
    $('[class=currency-data-attributes]').maskNumber();
    $('[class=currency-configuration]').maskNumber({decimal: '_', thousands: '*'});
    $('[class=integer-default]').maskNumber({integer: true});
    $('[class=integer-data-attribute]').maskNumber({integer: true});
    $('[class=integer-configuration]').maskNumber({integer: true, thousands: '_'});


</script>
</body>
</html>
@endsection
























