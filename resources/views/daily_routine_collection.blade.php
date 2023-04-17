@extends('layouts.master')
@section('title', 'DAILY COLLECTION')
@section('navbar')
@section('sidebar')
@section('content')

<br />
<!-- Main content -->
<section class="content">
  <!-- Default box -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title" style="font-weight: bold;">DAILY ROUTINE COLLECTION</h3>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
        <i class="fas fa-minus"></i></button>
        <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
        <i class="fas fa-times"></i></button>
      </div>
    </div>
    <div class="card-body">
      <form id="daily_routine_collection_proceed">
        @csrf
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>CUSTOMER:</label>
              <input type="text" value="{{ $customer->store_name }}" class="form-control">
              <input type="hidden" name="customer_id" value="{{ $customer->id }}">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>OR #:</label>
              <input type="text" name="or_number" style="text-transform: uppercase;" class="form-control" required>
            </div>
          </div>
          <div class="col-md-12">
            <label># of Particulars:</label>
            <input type="number" name="particulars" min="0" value="0" required class="form-control">
          </div>
          <div class="col-md-12">
            <label># of Less Referals:</label>
            <input type="number" name="less_referals" min="0" value="0" required class="form-control">
          </div>     
          <div class="col-md-12">
            <label>Delivery Receipt</label>
            <select class="form-control select2" multiple="multiple" style="width:100%;" name="ar_ledger_data[]">
              @for ($i=0; $i < array_sum($array_counter); $i++)
                <option value="{{ $array_id[$i] ."/". $array_delivery_receipt[$i] ."/". $array_final_balance[$i] }}">{{ $array_delivery_receipt[$i] ." | ". $array_final_balance[$i] }}</option>
              @endfor
            </select>
          </div>     
          <div class="col-md-12">
            <div class="form-group">
              <br />
              <button type="submit" class="btn btn-info btn-block">PROCEED</button>
            </div>
          </div>
        </div>
      </form>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
      <div id="daily_routine_collection_proceed_page"></div>
    </div>
    <!-- /.card-footer-->
  </div>
  <!-- /.card -->
    <div class="card">
    <div class="card-header">
      <h3 class="card-title" style="font-weight: bold;">DAILY ROUTINE COLLECTION</h3>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
        <i class="fas fa-minus"></i></button>
        <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
        <i class="fas fa-times"></i></button>
      </div>
    </div>
    <div class="card-body">
      <div id="daily_routine_collection_proceed_to_final_summary_page"></div>
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


   var status = '<?php echo Session::has("status"); ?>';
   if(status)
   {
     //$('.loading').show();
     Swal.fire({
        title: 'Redirecting Page',
        text: "Cannot Proceed, Customer does not have a registered ar control at the moment!",
        icon: 'warning',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Okay!'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = '/daily_routine';
        }
      })
   }


  $("#daily_routine_collection_proceed").on('submit',(function(e){
        e.preventDefault();
        //$('.loading').show();
          $.ajax({
            url: "daily_routine_collection_proceed",
            type: "post",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            success: function(data){
              console.log(data);
              $('#daily_routine_collection_proceed_page').html(data);
               $('.loading').hide();
            },
      });
    }));


</script>
</body>
</html>
@endsection
























