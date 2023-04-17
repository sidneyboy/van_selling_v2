 @extends('layouts.master')

 @section('title', 'COLLECTION IMAGE')

 @section('navbar')


 @section('sidebar')


 @section('content')
  
    <br />
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title" style="font-weight: bold;">UPLOAD DEPOSIT SLIP / CHECK</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          <form id="collection_upload_image_proceed">
            @csrf
            <div class="row">
              <div class="col-md-12">
                <label>COLLECTION</label>
                <select class="form-control select2" style="width:100%;" required name="collection_id">
                  <option value="" default>SELECT</option>
                  @foreach($collection as $data)
                    <option value="{{ $data->id }}">{{ "[". $data->date_collected ."] - ".$data->customer->store_name ." | ". number_format($data->total_amount_collected,2,".",",") }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-12">
                <label>&nbsp;</label>
                <button type="submit" class="btn btn-info btn-block">PROCEED</button>
              </div>
            </div>
          </form>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <div id="collection_upload_image_proceed_page"></div>
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
  
   $("#collection_upload_image_proceed").on('submit',(function(e){
        e.preventDefault();
        $('.loading').show();
          $.ajax({
            url: "collection_upload_image_proceed",
            type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            success: function(data){
              console.log(data);
              $('#collection_upload_image_proceed_page').html(data);
              $('.loading').hide();
            },
      });
    }));



</script>
</body>
</html>
@endsection
























