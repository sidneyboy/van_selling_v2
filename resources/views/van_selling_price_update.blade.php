@extends('layouts.master')
@section('title', 'VS U/P UPDATE')
@section('navbar')
@section('sidebar')
@section('content')

<br />
<!-- Main content -->
<section class="content">
  <!-- Default box -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title" style="font-weight: bold;">VAN SELLING PRICE UPDATE</h3>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
        <i class="fas fa-minus"></i></button>
        <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
        <i class="fas fa-times"></i></button>
      </div>
    </div>
    <div class="card-body">
      <form id="van_selling_price_update_save">
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
 
  $("#van_selling_price_update_save").on('submit',(function(e){
        e.preventDefault();
        $('.loading').show();
          $.ajax({
            url: "van_selling_price_update_save",
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
                }else{
                  Swal.fire({
        					  position: 'top-end',
        					  icon: 'success',
        					  title: 'UPDATED PRICE SUCCESSFULLY UPLOADED',
        					  showConfirmButton: false,
        					  timer: 1500
        					})
                  window.location.href = "van_selling_upload";
                }
            },
      });
    }));


</script>
</body>
</html>
@endsection
























