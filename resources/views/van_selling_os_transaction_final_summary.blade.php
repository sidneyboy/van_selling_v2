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
