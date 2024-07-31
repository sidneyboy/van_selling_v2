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
                 <div class="table table-responsive">
                     <table class="table table-bordered table-sm table-striped table-hover export_table" style="font-size:11px"
                         id="example2">
                         <thead>
                             <tr>
                                 <th>Principal</th>
                                 <th>Code</th>
                                 <th>Type</th>
                                 <th>Description</th>
                                 <th>Qty</th>
                             </tr>
                         </thead>
                         <tbody>
                             @for ($i = 0; $i < count($sku_ledger); $i++)
                                 <tr>
                                     <td>{{ $sku_ledger[$i]->principal }}</td>
                                     <td>{{ $sku_ledger[$i]->sku_code }}</td>
                                     <td>{{ $sku_ledger[$i]->sku_type }}</td>
                                     <td>{{ $sku_ledger[$i]->description }}</td>
                                     <td style="text-align: right">{{ $sku_ledger[$i]->running_balance }}</td>
                                 </tr>
                             @endfor
                         </tbody>
                     </table>
                 </div>

                 <br />

                 <button id="btnExport" type="button" class="btn btn-info btn-block btn-sm"><i class="fa fa-file-csv"></i> Export to CSV</button>
             </div>
         </div>
         <input type="hidden" id="agent_name" value="{{ $agent_user->full_name }} INVENTORY.csv">
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

         //  $("#van_selling_ledger_generate").on('submit', (function(e) {
         //      e.preventDefault();
         //      $('.loading').show();
         //      $.ajax({
         //          url: "van_selling_ledger_generate",
         //          type: "POST",
         //          data: new FormData(this),
         //          contentType: false,
         //          cache: false,
         //          processData: false,
         //          success: function(data) {
         //              if (data == 'NO_DATA_FOUND') {
         //                  Swal.fire(
         //                      'NO DATA FOUND!',
         //                      'CANNOT PROCEED!',
         //                      'error'
         //                  )
         //                  $('.loading').hide();
         //              } else {
         //                  $('#van_selling_ledger_generate_page').html(data);
         //                  $('.loading').hide();
         //              }
         //          },
         //          error: function(error) {
         //              $('.loading').hide();
         //              Swal.fire(
         //                  'Cannot Proceed',
         //                  'Please Contact IT Support',
         //                  'error'
         //              )
         //          }
         //      });
         //  }));

         class csvExport {
             constructor(table, header = true) {
                 this.table = table;
                 this.rows = Array.from(table.querySelectorAll("tr"));
                 if (!header && this.rows[0].querySelectorAll("th").length) {
                     this.rows.shift();
                 }
                 // console.log(this.rows);
                 // console.log(this._longestRow());
             }

             exportCsv() {
                 const lines = [];
                 const ncols = this._longestRow();
                 for (const row of this.rows) {
                     let line = "";
                     for (let i = 0; i < ncols; i++) {
                         if (row.children[i] !== undefined) {
                             line += csvExport.safeData(row.children[i]);
                         }
                         line += i !== ncols - 1 ? "," : "";
                     }
                     lines.push(line);
                 }
                 //console.log(lines);
                 return lines.join("\n");
             }
             _longestRow() {
                 return this.rows.reduce((length, row) => (row.childElementCount > length ? row.childElementCount :
                     length), 0);
             }
             static safeData(td) {
                 let data = td.textContent;
                 //Replace all double quote to two double quotes
                 data = data.replace(/"/g, `""`);
                 //Replace , and \n to double quotes
                 data = /[",\n"]/.test(data) ? `"${data}"` : data;
                 return data;
             }
         }

         const btnExport = document.querySelector("#btnExport");
         const tableElement = document.querySelector(".export_table");

         btnExport.addEventListener("click", () => {
             const obj = new csvExport(tableElement);
             const csvData = obj.exportCsv();
             const blob = new Blob([csvData], {
                 type: "text/csv"
             });
             const url = URL.createObjectURL(blob);
             const a = document.createElement("a");
             a.href = url;
             a.download = $('#agent_name').val();
             a.click();

             setTimeout(() => {
                 URL.revokeObjectURL(url);
             }, 500);
         });
     </script>
     </body>

     </html>
 @endsection
