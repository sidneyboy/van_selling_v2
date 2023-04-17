 @extends('layouts.master')

 @section('title', 'UPLOAD PRICES')

 @section('navbar')


 @section('sidebar')


 @section('content')
  
    <br />
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title" style="font-weight: bold;">UPLOAD SKU PRICES</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          <form id="sku_inventory_upload">
            <div class="form-group">
              <label for="exampleInputFile">File input</label>
              <input type="file" name="agent_csv_file" required class="form-control">
            </div>
             <div class="form-group">
              
              <button type="submit" class="btn btn-success btn-block">UPDATED PRICES</button>
            </div>
          </form>
        </div>
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



  $("#sku_inventory_upload").on('submit',(function(e){
        e.preventDefault();
        $('.loading').show();
          $.ajax({
            url: "sku_inventory_upload",
            type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            success: function(data){
              console.log(data);
                if (data == 'saved') {
                  Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'New Sku Inventory Uploaded',
                    showConfirmButton: false,
                    timer: 1500
                  })
                  window.location.href = "/sku_inventory_price";
                }else{
                  Swal.fire(
                    'Something went wrong',
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
























