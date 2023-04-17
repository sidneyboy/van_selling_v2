@extends('layouts.master')
@section('title', 'VS - UPLOAD')
@section('navbar')
@section('sidebar')
@section('content')

<br />
<!-- Main content -->
<section class="content">
  <!-- Default box -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title" style="font-weight: bold;">VAN SELLING UPLOAD NEW INVENTORY</h3>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
        <i class="fas fa-minus"></i></button>
        <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
        <i class="fas fa-times"></i></button>
      </div>
    </div>
    <div class="card-body">
      <form id="van_selling_upload_new_inventory">
        <div class="form-group">
          <label for="exampleInputFile">File input</label>
          <input type="file" name="agent_csv_file" required class="form-control">
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-success btn-block">SUBMIT NEW INVENTORY</button>
        </div>
      </form>
      <!-- /.card-body -->
      <div class="card-footer">
        
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
 
  $("#van_selling_upload_new_inventory").on('submit',(function(e){
        e.preventDefault();
        $('.loading').show();
          $.ajax({
            url: "van_selling_upload_new_inventory",
            type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            success: function(data){
              console.log(data);
                if(data == 'incorrect_file'){
	                Swal.fire(
        					  'INCORRECT FILE',
        					  'PLEASE SELECT THE CORRECT FILE',
        					  'error'
        					)	
                  $('.loading').hide();
                }else if(data == 'file_already_uploaded'){
                  Swal.fire(
                    'EXISTING FILE',
                    'FILE ALREADY UPLOADED',
                    'error'
                  ) 
                  $('.loading').hide();
                }else if(data == 'saved'){
                  Swal.fire({
        					  position: 'top-end',
        					  icon: 'success',
        					  title: 'DATA SUCCESSFULLY UPLOADED',
        					  showConfirmButton: false,
        					  timer: 1500
        					})
                  window.location.href = "van_selling_transaction";
                }else if(data == 'customer_id_not_equal'){
                   Swal.fire(
                    'THIS IS NOT YOUR FILE, ASK ENCODER FOR THE RIGHT FILE WITH YOUR NAME IN IT',
                    'CANNOT PROCEED!!',
                    'error'
                  ) 
                  $('.loading').hide();
                }else{
                  Swal.fire(
                    'INCORRECT FILE',
                    data,
                    'error'
                  ) 
                  $('.loading').hide();
                }
            },
      });
    }));


</script>
</body>
</html>
@endsection
























