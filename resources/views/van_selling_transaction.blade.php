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
                <h3 class="card-title" style="font-weight: bold;">VAN SELLING TRANSACTION</h3>
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
                @if ($van_selling_customer_check != 0)
                    <p style="color:red;text-align:center;">Please Update Pending Customer Profile</p>
                @else
                    @if (session('success'))
                        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <form id="van_selling_transaction_proceed">
                        <div class="row">
                            <div class="col-md-12">
                                <label>CUSTOMER:</label>
                                <select class="form-control select2" style="width:100%;" name="customer_selection"
                                    id="customer_selection" required>
                                    <option value="" default>SELECT CUSTOMER</option>
                                    <option value="NEW_CUSTOMER">NEW CUSTOMER</option>
                                    @foreach ($van_selling_customer as $data)
                                        <option value="{{ $data->id }}">
                                            {{ $data->store_name . ' - ' . $data->barangay . ' - ' . $data->location->location }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label>PRINCIPAL:</label>
                                <select class="form-control select2" id="principal" style="width:100%;" name="principal"
                                    required>
                                    <option value="" default>SELECT PRINCIPAL</option>
                                    @foreach ($principal as $data)
                                        <option value="{{ $data->principal }}">{{ $data->principal }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label>&nbsp;</label>
                                <div id="van_selling_transaction_show_sku_page"></div>
                            </div>
                            <div class="col-md-12">
                                <label>&nbsp;</label>
                                <input type="hidden" name="user_id" value="{{ $agent_user->user_id }}">
                                <input type="hidden" name="full_name" value="{{ $agent_user->full_name }}">
                                <button type="submit" id="hide_if_trigger" class="btn btn-info btn-block">PROCEED</button>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
            <div class="card-footer">
                <div id="van_selling_transaction_proceed_page"></div>
            </div>
            <!-- /.card -->
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
                <div id="van_selling_transaction_summary_page"></div>
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

        $("#principal").change(function() {
            $('#van_selling_transaction_show_sku_page').show();
            //$('.loading').show();
            $('#hide_if_trigger').show();
            var principal = $('#principal').val();
            var store_name = $('#customer_selection').val();
            $.post({
                type: "POST",
                url: "/van_selling_transaction_show_sku",
                data: 'principal=' + principal + '&store_name=' + store_name,
                success: function(data) {
                    console.log(data);

                    $('#van_selling_transaction_show_sku_page').html(data);
                    $('.loading').hide();
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });



        $("#van_selling_transaction_proceed").on('submit', (function(e) {
            e.preventDefault();
            //$('.loading').show();
            $('#hide_if_trigger').hide();
            $.ajax({
                url: "van_selling_transaction_proceed",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    console.log(data);

                    $('.loading').hide();
                    $("#principal").val('').trigger('change');
                    $('#van_selling_transaction_show_sku_page').hide();
                    $('#van_selling_transaction_proceed_page').html(data);
                    $('#hide_if_trigger').show();
                },
            });
        }));
    </script>
    </body>

    </html>
@endsection
