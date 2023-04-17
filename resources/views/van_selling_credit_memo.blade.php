 @extends('layouts.master')

 @section('title', 'VS FOR CM')

 @section('navbar')


 @section('sidebar')


 @section('content')
  
    <br />
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title" style="font-weight: bold;">VAN SELLING FOR CM</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          <form id="van_selling_credit_memo_generate_dr_data">
              <div class="row">
                <div class="col-md-12">
                  <label>INPUT DR #</label>
                  <input type="text" name="delivery_receipt" required class="form-control">
                </div>
                <div class="col-md-12">
                  <label>&nbsp;</label>
                  <button type="submit" class="btn btn-info btn-block">PROCEED TO QUANTITY FORM</button>
                </div>
              </div>
          </form>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <div id="van_selling_credit_memo_generate_dr_data_page"></div>
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title" style="font-weight: bold;">VAN SELLING FOR CM SUMMARY</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          <div id="van_selling_credit_memo_proceed_to_final_summary_page"></div>
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

  $("#van_selling_credit_memo_generate_dr_data").on('submit',(function(e){
        e.preventDefault();
       //$('.loading').show();
          $.ajax({
            url: "van_selling_credit_memo_generate_dr_data",
            type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            success: function(data){

                if (data == 'CANCELLED') {
                  Swal.fire(
                    'Cannot Proceed!',
                    'DR is Cancelled',
                    'error'
                  )
                  $('.loading').hide();
                }else{
                  $('#van_selling_credit_memo_generate_dr_data_page').html(data);
                  $('.loading').hide();
                }
            },
      });
    }));


</script>
</body>
</html>
@endsection
























