<style>
    table {
        width: 100%;
        font-size: 18px;
        font-family: Arial, Helvetica, sans-serif;
        padding: 0px;
        background-color: white
    }

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

<div id="html-content-holder">
    {{-- <form method="post" action="{{ route('van_selling_transaction_summary_save') }}" accept-charset="UTF-8"> --}}
    <form id="van_selling_transaction_summary_save">
        <table style="text-align: center;">
            <tr>
                <th>JULMAR COMMERCIAL INC.</th>
            </tr>
            <tr>
                <th>OSMENA ST., CDO</th>
            </tr>
            <tr>
                <th>TEL: 857-6197, 858-5771</th>
            </tr>
            <tr>
                <th>TIN: 486-701-947-000</th>
            </tr>
            <tr>
                <th>REP: {{ $agent_user->full_name }}</th>
            </tr>
            <tr>
                <th>
                    Store: {{ $store_name }}
                    <input type="hidden" name="store_name" value="{{ $store_name }}">
                </th>
            </tr>
            <tr>
                <th>
                    <input type="hidden" name="store_type" value="{{ $store_type }}">
                    <input type="hidden" name="location_id" value="{{ $location_id }}">
                    <input type="hidden" name="barangay" value="{{ $barangay }}">
                    <input type="hidden" name="address" value="{{ $address }}">
                </th>
            </tr>
            <tr>
                <th>
                    {{ $date . ' | ' . $time }}
                    <input type="hidden" name="date_time" value="{{ $date . ' | ' . $time }}">
                </th>
            </tr>
            <tr>
                <th>
                    {{ $delivery_receipt }}
                    <input type="hidden" name="delivery_receipt" value="{{ $delivery_receipt }}">
                </th>
            </tr>
        </table>
        <br / style="background-color:white">
        @if (count($cart) != 0)
            <table>
                <thead>
                    <tr>
                        <th>Desc</th>
                        <th>Qty</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cart as $data)
                        @if ($data->quantity != 0)
                            <tr>
                                <th>{{ $data->sku_code }} <br />{{ $data->description }}<br /> x
                                    {{ $data->quantity }}
                                </th>
                                <th style="text-align: right">{{ number_format($data->price, 2, '.', ',') }}</th>
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
                        <th style="text-align: right;">
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
            <input type="hidden" value="{{ $customer_selection }}" name="customer_selection">
            <input type="hidden" name="remarks" value="PRODUCTIVE">
            <input type="button" value="Screenshot" class="btn btn-info btn-block" id="btnConvert">
            <div id="previewImg"></div>
            <input type="hidden" id="download_button_counter" value="1">
            <button type="submit" class="btn btn-success btn-block" id="submit" style="display: none;">Submit</button>
        @else
            <input type="hidden" value="{{ $customer_selection }}" name="customer_selection">
            <input type="hidden" name="remarks" value="UNPRODUCTIVE">
            <center>
                <h1 style="color:red;">UNPRODUCTIVE</h1>
            </center>
            <button type="submit" id="submit" class="btn btn-success btn-block">Submit</button>
        @endif


    </form>
</div>




<script src="{{ asset('js/signature_pad.umd.js') }}"></script>
<script src="{{ asset('js/app2.js') }}"></script>
<script type="text/javascript">
    $("#van_selling_transaction_summary_save").on('submit', (function(e) {
        e.preventDefault();
        $('.loading').show();
        $.ajax({
            url: "van_selling_transaction_summary_save",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $('.loading').hide();
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Your work has been saved',
                    showConfirmButton: false,
                    timer: 1500
                });

                location.reload();
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
            $('#submit').show();
            $('.loading').hide();
        });
    });

    var canvas = document.getElementById('signature-pad');

    function resizeCanvas() {
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
