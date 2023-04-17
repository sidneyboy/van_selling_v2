@extends('layouts.master')

@section('title', 'VS CUSTOMER UPLOAD')

@section('navbar')


@section('sidebar')


@section('content')

    <br />
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title" style="font-weight: bold;">VS CUSTOMER UPLOAD</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip"
                        title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <form id="van_selling_upload_customer_process">
                    @csrf
                    <p style="color:red">NOTE: ALL CUSTOMER DATA WILL BE RESET.</p>
                    <label>UPLOAD NEW CUSTOMER</label>
                    <input type="file" class="form-control" name="file" required>
                    <br />
                    <button class="btn btn-block btn-success" type="submit">UPLOAD NEW CUSTOMER</button>
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

        $("#van_selling_upload_customer_process").on('submit', (function(e) {
            e.preventDefault();
            $('.loading').show();
            $.ajax({
                url: "van_selling_upload_customer_process",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    console.log(data);
                    if (data == 'saved') {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'CUSTOMER DATA RESET AND UPLOADED NEW CUSTOMER',
                            showConfirmButton: false,
                            timer: 1500
                        })

                        // location.reload();
                        window.location.href = "/van_selling_transaction";
                    } else {
                        Swal.fire(
                            'Something went wrong!',
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
