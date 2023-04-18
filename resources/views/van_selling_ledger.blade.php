 @extends('layouts.master')

 @section('title', 'VS LEDGER DATA')

 @section('navbar')


 @section('sidebar')


 @section('content')

     <br />
     <section class="content">
         <div class="card">
             <div class="card-header">
                 <h3 class="card-title" style="font-weight: bold;">INVENTORY LEDGER</h3>
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
                 <table class="table table-bordered table-sm table-striped table-hover" id="example2">
                     <thead>
                         <tr>
                             <th>Principal</th>
                             <th>Description</th>
                             <th>Inventory</th>
                         </tr>
                     </thead>
                     <tbody>
                         @for ($i = 0; $i < count($sku_ledger); $i++)
                             <tr>
                                 <td>{{ $sku_ledger[$i]->principal }}</td>
                                 <td> <b style="color:green">{{ $sku_ledger[$i]->sku_code }}</b> - {{ $sku_ledger[$i]->description }}</td>
                                 <td style="text-align: right">{{ $sku_ledger[$i]->running_balance }}</td>
                             </tr>
                         @endfor
                     </tbody>
                 </table>
             </div>
         </div>
     </section>
 @endsection


 @section('footer')
     @parent
     <script>
         $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
         });

         $("#van_selling_ledger_generate").on('submit', (function(e) {
             e.preventDefault();
             $('.loading').show();
             $.ajax({
                 url: "van_selling_ledger_generate",
                 type: "POST",
                 data: new FormData(this),
                 contentType: false,
                 cache: false,
                 processData: false,
                 success: function(data) {
                     if (data == 'NO_DATA_FOUND') {
                         Swal.fire(
                             'NO DATA FOUND!',
                             'CANNOT PROCEED!',
                             'error'
                         )
                         $('.loading').hide();
                     } else {
                         $('#van_selling_ledger_generate_page').html(data);
                         $('.loading').hide();
                     }
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
