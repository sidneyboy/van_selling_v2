<style type="text/css">
    .wrapper {
        position: relative;
        height: 200px;
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    .signature-pad {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 200px;
        background-color: white;
    }
</style>




@if (count($van_selling_os_cart_details) != 0)
    <table class="table table-bordered table-sm">
        <thead>
            <tr>
                <th colspan="4" style="text-align: center;">OUT OF STOCK</th>
            </tr>
            <tr>
                <th>SKU</th>
                <th>QUANTITY</th>
                <th>U/P</th>
                <th>TOTAL</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($van_selling_os_cart_details as $data)
                <tr>
                    <th>
                        {{ $data->van_selling_os_sku->sku_code }} <br />
                        {{ $data->van_selling_os_sku->description }}
                    </th>
                    <th style="text-align: right">{{ $data->quantity }}</th>
                    <th style="text-align: right">{{ $data->unit_price }}</th>
                    <th style="text-align: right">
                        @php
                            $sum_cart_os_total[] = $data->unit_price * $data->quantity;
                        @endphp

                        {{ number_format($data->unit_price * $data->quantity, 2, '.', ',') }}
                    </th>
                </tr>
            @endforeach
            <tr>
                <th colspan="3">TOTAL</th>
                <th style="text-align: right">
                    {{ number_format(array_sum($sum_cart_os_total), 2, '.', ',') }}
                </th>
            </tr>
        </tbody>
    </table>
@endif

@if (count($van_selling_cart_os_data) != 0)
    <table class="table table-bordered table-sm">
        <thead>
            <tr>
                <th colspan="4" style="text-align:center;">SERVED OS</th>
            </tr>
            <tr>
                <th>SKU</th>
                <th>QUANTITY</th>
                <th>U/P</th>
                <th>TOTAL</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($van_selling_cart_os_data as $data)
                <tr>
                    <th>
                        {{ $data->sku_code }} <br />
                        {{ $data->description }}
                    </th>
                    <th style="text-align: right">{{ $data->quantity }}</th>
                    <th style="text-align: right">{{ $data->price }}</th>
                    <th style="text-align: right">
                        @php
                            $sum_os_data_total[] = $data->price * $data->quantity;
                        @endphp

                        {{ number_format($data->price * $data->quantity, 2, '.', ',') }}
                    </th>
                </tr>
            @endforeach
            <tr>
                <th colspan="3">TOTAL</th>
                <th style="text-align: right">
                    {{ number_format(array_sum($sum_os_data_total), 2, '.', ',') }}
                </th>
            </tr>
        </tbody>
    </table>
@endif

<div id="html-content-holder">

    <form method="post" action="{{ route('van_selling_transaction_summary_save') }}" accept-charset="UTF-8">
        @if (count($van_selling_cart_data) != 0)
            <table class="table table-borderless" style="font-size:30px;font-family: Arial, Helvetica, sans-serif;"
                id="print_table">
                <thead>
                        <tr>
                            <th style="text-align: center;" colspan="3">JULMAR COMMERCIAL INC.</th>
                        </tr>
                        <tr>
                            <th style="text-align: center;" colspan="3">OSMENA ST., CDO</th>
                        </tr>
                        <tr>
                            <th style="text-align: center;" colspan="3">TEL 857-6197, 858-5771</th>
                        </tr>
                        <tr>
                            <th style="text-align: center;" colspan="3">Vat Reg. TIN 486-701-947-000</th>
                        </tr>
                        <tr>
                            <th style="text-align: center;" colspan="3">REP: {{ $full_name }}</th>
                        </tr>
                        <tr>
                            <th style="text-align: center;" colspan="3">
                                Store: {{ $store_name }}
                                <input type="hidden" name="store_name" value="{{ $store_name }}">
                            </th>
                        </tr>
                        <tr>
                            <th style="text-align: center;" colspan="3">
                                <input type="hidden" name="store_type" value="{{ $store_type }}">
                                <input type="hidden" name="location" value="{{ $location }}">
                                <input type="hidden" name="barangay" value="{{ $barangay }}">
                                <input type="hidden" name="address" value="{{ $address }}">
                                @if (count($van_selling_cart_os_data) != 0)
                                    <input type="hidden" name="van_selling_os_cart_data" value="true">
                                @else
                                    <input type="hidden" name="van_selling_os_cart_data" value="false">
                                @endif
                            </th>
                        </tr>
                        <tr>
                            <th style="text-align: center;" colspan="3">
                                DR: {{ $delivery_receipt }}
                                <input type="hidden" name="delivery_receipt" value="{{ $delivery_receipt }}">
                            </th>
                        </tr>
                        <tr>
                            <th style="text-align: center;" colspan="3">
                                Date & Time: {{ $date . ' | ' . $time }}
                                <input type="hidden" name="date_time" value="{{ $date . ' | ' . $time }}">
                            </th>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                    
                    <tr>
                        <th>SKU</th>
                        <th>U/P</th>
                        <th>TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($van_selling_cart_data as $data)
                        @if ($data->quantity != 0)
                            <tr>
                                <th>[{{ $data->sku_code }}] {{ $data->description }} x {{ $data->quantity }}</th>
                                <th style="text-align: right">{{ $data->price }}</th>
                                <th style="text-align: right">
                                    @php
                                        $total = $data->price * $data->quantity;
                                        $sum_total[] = $total;
                                        echo number_format($total, 2, '.', ',');
                                    @endphp
                                    <input type="hidden" name="amount[{{ $data->sku_code }}]"
                                        value="{{ $total }}">
                                </th>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>TOTAL:</th>
                        <th></th>
                        <th style="text-align: right;">
                            {{ number_format(array_sum($sum_total), 2, '.', ',') }}

                            <input type="hidden" name="van_selling_cart_data" value="{{ $van_selling_cart_data }}">
                        </th>
                    </tr>
                    <tr>
                        <th>PCM #:</th>
                        <th></th>
                        <th style="text-align: right">
                            {{ $pcm_number }}
                            <input type="hidden" name="pcm_number" value="{{ $pcm_number }}">
                        </th>
                    </tr>
                    <tr>
                        <th>BO AMOUNT:</th>
                        <th></th>
                        <th style="text-align: right;">-{{ number_format($bo_amount, 2, '.', ',') }}
                            <input type="hidden" name="bo_amount" value="{{ $bo_amount }}">
                        </th>
                    </tr>
                    <tr>
                        <th>GRAND TOTAL:</th>
                        <th></th>
                        <th style="text-align: center;">
                            {{ number_format(array_sum($sum_total) - $bo_amount, 2, '.', ',') }}
                            <input type="hidden" name="total_amount" value="{{ array_sum($sum_total) - $bo_amount }}">
                        </th>
                    </tr>
                    <tr>
                        <td colspan="3">&nbsp;</td>
                    </tr>
                    <tr>
                        <th colspan="3">Received by:</th>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <div class="wrapper">
                                <canvas id="signature-pad" style="border:dotted;width:100%;height:150px;"
                                    class="signature-pad"></canvas>
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>
            <input type="hidden" name="customer_selection" value="{{ $customer_selection }}">
            <button type="submit" id="submit" class="btn btn-success btn-block"
                style="display: none;">SUBMIT</button>
        @else
            <input type="hidden" name="store_type" value="{{ $store_type }}">
            <input type="hidden" name="location" value="{{ $location }}">
            <input type="hidden" name="barangay" value="{{ $barangay }}">
            <input type="hidden" name="address" value="{{ $address }}">
            <input type="hidden" name="store_name" value="{{ $store_name }}">
            <input type="hidden" name="total_amount" value="0">
            <button type="submit" id="submit" class="btn btn-success btn-block"
                style="display: none;">SUBMIT</button>

        @endif
    </form>

    <br />
    <input type="button" value="CONVERT TO IMAGE AND SUBMIT" class="btn btn-info btn-block" id="btnConvert">
    <div id="previewImg"></div>
    <input type="hidden" id="download_button_counter" value="1">
</div>


<script type="text/javascript">
    $("#btnConvert").on('click', function() {
        $('.loading').show();
        html2canvas(document.getElementById("html-content-holder")).then(function(canvas) {
            var anchorTag = document.createElement("a");
            document.body.appendChild(anchorTag);
            document.getElementById("previewImg").appendChild(canvas);
            anchorTag.download = "{{ $store_name . ' ' . uniqid() }}.jpg";
            anchorTag.href = canvas.toDataURL();
            anchorTag.target = '_blank';
            anchorTag.click();
            $('#previewImg').hide();
            $('#btnConvert').hide();
            $('#submit').click();
            $('.loading').hide();
        });
    });

    $("#submit").on('click', (function(e) {
        $('.loading').show();
    }));
</script>

<script src="{{ asset('js/signature_pad.umd.js') }}"></script>
<script src="{{ asset('js/app2.js') }}"></script>
<script type="text/javascript">
    var canvas = document.getElementById('signature-pad');
    // Adjust canvas coordinate space taking into account pixel ratio,
    // to make it look crisp on mobile devices.
    // This also causes canvas to be cleared.
    function resizeCanvas() {
        // When zoomed out to less than 100%, for some very strange reason,
        // some browsers report devicePixelRatio as less than 1
        // and only part of the canvas is cleared then.
        var ratio = Math.max(window.devicePixelRatio || 1, 1);
        canvas.width = canvas.offsetWidth * ratio;
        canvas.height = canvas.offsetHeight * ratio;
        canvas.getContext("2d").scale(ratio, ratio);
    }
    window.onresize = resizeCanvas;
    resizeCanvas();
    var signaturePad = new SignaturePad(canvas, {
        backgroundColor: 'rgb(255, 255, 255)' // necessary for saving image as JPEG; can be removed is only saving as PNG or SVG
    });
    document.getElementById('save-png').addEventListener('click', function() {
        if (signaturePad.isEmpty()) {
            return alert("Please provide a signature first.");
        }
        var data = signaturePad.toDataURL('image/png');
        console.log(data);
        window.open(data);
    });
    document.getElementById('save-jpeg').addEventListener('click', function() {
        if (signaturePad.isEmpty()) {
            return alert("Please provide a signature first.");
        }
        var data = signaturePad.toDataURL('image/jpeg');
        console.log(data);
        window.open(data);
    });
    document.getElementById('save-svg').addEventListener('click', function() {
        if (signaturePad.isEmpty()) {
            return alert("Please provide a signature first.");
        }
        var data = signaturePad.toDataURL('image/svg+xml');
        console.log(data);
        console.log(atob(data.split(',')[1]));
        window.open(data);
    });
    document.getElementById('clear').addEventListener('click', function() {
        signaturePad.clear();
    });
    document.getElementById('draw').addEventListener('click', function() {
        var ctx = canvas.getContext('2d');
        console.log(ctx.globalCompositeOperation);
        ctx.globalCompositeOperation = 'source-over'; // default value
    });
    document.getElementById('erase').addEventListener('click', function() {
        var ctx = canvas.getContext('2d');
        ctx.globalCompositeOperation = 'destination-out';
    });
</script>
