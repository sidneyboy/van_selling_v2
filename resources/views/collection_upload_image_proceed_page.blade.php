<form id="collection_upload_image_proceed_to_final_summary">
  @csrf
  <div class="row">
    <div class="col-md-12">
      <div class="table table-responsive">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>Store Name</th>
              <th>Principal</th>
              <th>Total Amount Collected</th>
              <th>Date Collected</th>
            </tr>
          </thead>
          <tbody>
            
            <tr>
              <td>{{ $collection->customer->store_name }}</td>
              <td>{{ $collection->principal->principal }}</td>
              <td style="text-align: right;">{{ number_format($collection->total_amount_collected,2,".",",") }}</td>
              <td>{{ $collection->date_collected }}</td>
            </tr>
            
          </tbody>
        </table>
      </div>
    </div>
    <div class="col-md-12">
      <input id="fileupload" name="images[]" class="form-control" type="file" multiple="multiple" required/>
    </div>
    <div class="col-md-12">
      <label>&nbsp;</label>
      <input type="hidden" name="collection_id" value="{{ $collection->id }}">
      <button type="submit" class="btn btn-success btn-block">GENERATE FINAL SUMMARY</button>
    </div>
  </div>
</form>

<script type="text/javascript">
    $("#collection_upload_image_proceed_to_final_summary").on('submit',(function(e){
        e.preventDefault();
        $('.loading').show();
          $.ajax({
            url: "collection_upload_image_proceed_to_final_summary",
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
                  title: 'Your work has been saved',
                  showConfirmButton: false,
                  timer: 1500
                })
                location.reload();
                $('.loading').hide();
              }else{
                Swal.fire(
                  'Something Went Wrong!',
                  'Contact Admin',
                  'error'
                )
                $('.loading').hide();
              }

            },
      });
    }));
          
  
</script>