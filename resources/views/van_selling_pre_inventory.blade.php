@extends('layouts.master')

@section('title', 'VS PRE INVENTORY')

@section('navbar')


@section('sidebar')


@section('content')

    <br />
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title" style="font-weight: bold;">VS PRE INVENTORY</h3>
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
                    <div class="row">
                        <div class="col-md-12">
                            <label>Select Principal</label>
                            <select name="principal" id="principal" required class="form-control select2" style="width:100%;">
                                <option value="" default>SELECT</option>
                                @foreach ($principal as $data)
                                    <option value="{{ $data->principal }}">{{ $data->principal }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <div id="van_selling_pre_inventory_generate_sku_page"></div>
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

        <!-- Default box -->
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
                <div id="van_selling_pre_inventory_generate_summary_page"></div>
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

        $("#principal").change(function() {
            $('#van_selling_pre_inventory_generate_sku').show();
            //$('.loading').show();
            $('#hide_if_trigger').show();
            var principal = $('#principal').val();
            $.post({
                type: "POST",
                url: "/van_selling_pre_inventory_generate_sku",
                data: 'principal=' + principal,
                success: function(data) {
                    console.log(data);

                    $('#van_selling_pre_inventory_generate_sku_page').html(data);
                    $('.loading').hide();
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });

    </script>
    </body>

    </html>
@endsection
