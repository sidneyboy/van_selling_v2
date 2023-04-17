 @extends('layouts.master')

 @section('title', 'UPLOAD CUSTOMER')

 @section('navbar')


 @section('sidebar')


 @section('content')
  
    <br />
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title" style="font-weight: bold;">UPLOAD NEW CUSTOMER</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          <form id="customer_upload">
            <div class="form-group">
              <label for="exampleInputFile">File input</label>
              <input type="file" name="agent_csv_file" required class="form-control">
            </div>
             <div class="form-group">
              
              <button type="submit" class="btn btn-success btn-block">UPDATED CUSTOMER</button>
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


  $("#customer_upload").on('submit',(function(e){
        e.preventDefault();
        $('.loading').show();
        

        const swalWithBootstrapButtons = Swal.mixin({
          customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
          },
          buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
          title: 'Are you assigned in a new area?',
          text: "Please select carefully, the system needs an authentic answer",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'YES, NEW AREA!',
          cancelButtonText: 'NO, SAME AREA!',
          reverseButtons: true
        }).then((result) => {
          if (result.isConfirmed) {
            Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: 'CREATING AND PREPARING DATABASE FOR NEW AREA! PLEASE WAIT A MOMENT THIS WILL TAKE A MIN OR SO! THANK YOU!',
              showConfirmButton: false,
              timer: 3000
            })


                $.ajax({
                  url: "customer_upload_new_area",
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
                          title: 'UPLOAD SUCCESS. REDIRECTING TO CUSTOMER PRINCIPAL CODE!',
                          showConfirmButton: false,
                          timer: 1500
                        })
                        window.location.href = "/customer_principal_code";
                      }else if(data == 'incorrect_file'){
                        Swal.fire(
                          'INCORRECT FILE',
                          'FILE NAME SHOULD BE (CUSTOMER APPLIED TO AGENT)',
                          'error'
                        )
                         $('.loading').hide();
                      }else if(data == 'file_contains_new_area_reverting_process'){
                        Swal.fire(
                          'CANNOT UPLOAD FILE!',
                          'FILE SEEMS TO CONTAIN NEW LOCATION ID, REVERTING PROCESS!',
                          'error'
                        )
                        $('.loading').hide();
                      }else{
                         Swal.fire(
                          'SOMETHING WENT WRONG',
                          'CONTACT JULMAR ADMIN',
                          'error'
                        )
                         $('.loading').hide();
                      }
                  },
            });
          } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
          ) {
            Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: 'RECONSTRUCTING PRINCIPAL(CODE && PRICE), THIS MAY TAKE A FEW MIN(s). PLEASE WAIT FOR A MOMENT!',
              showConfirmButton: false,
              timer: 3000
            })


                $.ajax({
                  url: "customer_upload",
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
                          title: 'UPLOAD SUCCESS. REDIRECTING TO CUSTOMER PRINCIPAL CODE!',
                          showConfirmButton: false,
                          timer: 1500
                        })
                        window.location.href = "/customer_principal_code";
                      }else if(data == 'incorrect_file'){
                        Swal.fire(
                          'INCORRECT FILE',
                          'FILE NAME SHOULD BE (CUSTOMER APPLIED TO AGENT)',
                          'error'
                        )
                         $('.loading').hide();
                      }else if(data == 'file_contains_new_area_reverting_process'){
                        Swal.fire(
                          'CANNOT UPLOAD FILE!',
                          'FILE SEEMS TO CONTAIN NEW LOCATION ID, REVERTING PROCESS!',
                          'error'
                        )
                        $('.loading').hide();
                      }else{
                         Swal.fire(
                          'SOMETHING WENT WRONG',
                          'CONTACT JULMAR ADMIN',
                          'error'
                        )
                         $('.loading').hide();
                      }
                  },
            });
          }
        })


     
    }));


</script>
</body>
</html>
@endsection
























