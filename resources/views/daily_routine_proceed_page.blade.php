<form id="daily_routine_proceed_to_inventory">
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label>Customer:</label>
        <select class="form-control select2" name="customer" style="width:100%;" required>
          <option value="" default>SELECT</option>
          @foreach($agent_applied_customer as $data)
          <option value="{{ $data->customer_id }}">{{ $data->customer->store_name }}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="col-md-12">
      <div class="form-group">
        <label>Principal:</label>
        <select class="form-control select2" name="principal" style="width:100%;" required>
          <option value="" default>SELECT</option>
          @foreach($principal as $data)
          <option value="{{ $data->id }}">{{ $data->principal }}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="col-md-12">
      <div class="form-group">
      {{--   <input type="hidden" name="customer_id" value="{{ $customer_id }}"> --}}
        <button type="submit" class="btn btn-info btn-block">PROCEED TO INVENTORY</button>
      </div>
    </div>
  </div>
</form>

<script type="text/javascript">
  $('.select2').select2()
  $("#daily_routine_proceed_to_inventory").on('submit',(function(e){
        e.preventDefault();
        $('.loading').show();
          $.ajax({
            url: "daily_routine_proceed_to_inventory",
            type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            success: function(data){
              console.log(data);
              $('#daily_routine_proceed_to_inventory_page').html(data);
               $('.loading').hide();
                // if(data != 'error'){
                //  Swal.fire({
                //     title: data,
                //     text: "Please send above code to agent",
                //     icon: 'success',
                //     showCancelButton: false,
                //     confirmButtonColor: '#3085d6',
                //     cancelButtonColor: '#d33',
                //     confirmButtonText: 'Yes, i will send it!'
                //   }).then((result) => {
                //     if (result.value) {
                //       Swal.fire(
                //         'Success',
                //         'Reloading Page',
                //         'success'
                //       )
                //       location.reload();
                //       $('.loading').hide();
                //     }
                //   })
                  
                // }else{
                //   Swal.fire(
                //   'Something went wrong!',
                //   'Redo process or contact system administrator',
                //   'error'
                //   )
                //   $('.loading').hide();
                // }
            },
      });
    }));
</script>