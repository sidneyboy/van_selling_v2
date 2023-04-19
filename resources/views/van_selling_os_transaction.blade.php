@extends('layouts.master')
@section('title', 'VS - TRANSACTION')
@section('navbar')
@section('sidebar')
@section('content')

    <br />
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title" style="font-weight: bold;">VAN SELLING OS TRANSACTION</h3>
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
                <form id="van_selling_os_transaction_proceed">
                    <div class="row">
                        <div class="col-md-12">
                            <label>CUSTOMER:</label>
                            <select class="form-control select2" style="width:100%;" name="os_code" id="os_code" required>
                                <option value="" default>SELECT</option>
                                @foreach ($os as $data)
                                    <option value="{{ $data->os_code }}">{{ $data->store_name }} - {{ $data->date }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label>&nbsp;</label>
                            <div id="van_selling_transaction_show_sku_page"></div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-info btn-block">PROCEED</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <div id="van_selling_os_transaction_proceed_page"></div>
            </div>
            <!-- /.card -->
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title" style="font-weight: bold;"></h3>
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
                <div id="van_selling_os_transaction_summary_page"></div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title" style="font-weight: bold;">SUMMARY</h3>
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
                <div id="van_selling_os_transaction_final_summary_page"></div>
            </div>
            <div class="card-footer">

            </div>
            <!-- /.card -->
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

        $("#van_selling_os_transaction_proceed").on('submit', (function(e) {
            e.preventDefault();
            //$('.loading').show();
            $.ajax({
                url: "van_selling_os_transaction_proceed",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    $('.loading').hide();
                    $('#van_selling_os_transaction_proceed_page').html(data);
                    $('#hide_if_trigger').show();
                },
                error: function(error) {
                    $('.loading').hide();
                    Swal.fire(
                        'Cannot Proceed',
                        'Please Contact IT Support',
                        'error'
                    )
                }
            });
        }));
    </script>
    </body>

    </html>
@endsection
