<label>SEARCH FOR</label>
<select class="form-control select2" required name="search_for" style="width:100%;">
    <option value="" default>SELECT</option>
    <option value="dsrr">DSRR</option>
    <option value="all_principal">ALL PRINCIPAL</option>}
    option
    @foreach ($principal as $data)
        <option value="{{ $data->principal }}">{{ $data->principal }}</option>
    @endforeach
</select>
<script type="text/javascript">
    $('.select2').select2()
</script>
