<link rel="stylesheet" href="{{ asset('/adminLte/dist/css/adminlte.min.css') }}">

<div class="table table-responsive">
  <br />
  <table class="table table-bordered table-hover">
    <thead>
      <tr>
        <th style="text-align: center;" colspan="7">ORIGNAL TRANSACTION FROM ENCODER</th>
        <th style="text-align: center;" colspan="4">BUTAL CONVERSION</th>
      </tr>
      <tr>
        <th>CODE</th>
        <th>DESCRIPTION</th>
        <th>SKU TYPE</th>
        <th>UOM</th>
        <th>QTY</th>
        <th>U/P</th>
        <th>TOTAL</th>
        <th>BUTAL EQUIVALENT</th>
        <th>QTY - BUTAL</th>
        <th>U/P</th>
        <th>TOTAL</th>
      </tr>
    </thead>
    <tbody>
      @foreach($van_selling_upload_transaction as $data)
        <tr>
          <td>{{ $data->sku_code }}</td>
          <td>{{ $data->description }}</td>
          <td>{{ $data->sku_type }}</td>
          <td>{{ $data->unit_of_measurement }}</td>
          <td style="text-align: right;">{{ $data->quantity }}</td>
          <td style="text-align: right;">{{ number_format($data->unit_price_left,2,".",",") }}</td>
          <td style="text-align: right;">{{ number_format($data->total_left,2,".",",") }}</td>
          <td style="text-align: right;">{{ $data->butal_equivalent }}</td>
          <td style="text-align: right;">{{ $data->quantity_butal }}</td>
          <td style="text-align: right;">{{ number_format($data->unit_price_right,2,".",",")  }}</td>
          <td style="text-align: right;">{{ number_format($data->total_right,2,".",",") }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

<br />



<table class="table table-bordered table-hover" id="example2">
  <thead>
    <tr>
      <th colspan="15" style="text-align: center;">VAN SELLING SKU LEDGER</th>
    </tr>
    <tr>
      <th style="text-transform: uppercase;">Reference</th>
      <th style="text-transform: uppercase;">Store Name</th>
      <th style="text-transform: uppercase;">Principal</th>
      <th style="text-transform: uppercase;">Code</th>
      <th style="text-transform: uppercase;">Description</th>
      <th style="text-transform: uppercase;">Uom</th>
      <th style="text-transform: uppercase;">Beg</th>
      <th style="text-transform: uppercase;">Van Load</th>
      <th style="text-transform: uppercase;">Sales</th>
      <th style="text-transform: uppercase;">End / Qty Butal</th>
      <th style="text-transform: uppercase;">U/P</th>
      <th style="text-transform: uppercase;">Equivalent</th>
      <th style="text-transform: uppercase;">Quantity Case</th>
      <th style="text-transform: uppercase;">Total</th>
      <th style="text-transform: uppercase;">Running Balance</th>
    </tr>
  </thead>
  <tbody>
    @foreach($van_selling_details as $data)
    <tr>
      <td>{{ $data->reference }}</td>
      <td>{{ $data->store_name }}</td>
      <td>{{ $data->principal }}</td>
      <td>
        {{ $data->sku_code }}
      </td>
      <td>{{ $data->description }}</td>
      <td>{{ $data->unit_of_measurement }}</td>
      
      <td style="text-align: right;">{{ $data->beg }}</td>
      <td style="text-align: right;">{{ $data->van_load }}</td>
      <td style="text-align: right;">{{ number_format($data->sales,2,".",",") }}</td>
      <td style="text-align: right;">{{ $data->end }}</td>
       <td style="text-align: right;">{{ number_format($data->unit_price,2,".",",") }}</td>
      <td style="text-align: right;">{{ $data->butal_equivalent }}</td>
      <td style="text-align: right;">
        {{ $data->end / $data->butal_equivalent }}
      </td>
      <td style="text-align: right;">{{ number_format($data->total,2,".",",") }}</td>
      <td style="text-align: right;">{{ number_format($data->running_balance,2,".",",") }}</td>
    </tr>
    @endforeach
  </tbody>
</table>