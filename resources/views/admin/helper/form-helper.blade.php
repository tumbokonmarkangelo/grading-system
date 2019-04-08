@section('added-scripts')
<script>
    $(document).ready(function() {
        @if (!empty($data))
        var data = JSON.parse('{!! json_encode($data) !!}');
        Object.keys(data).forEach(function(key) {
            if (data[key]) {
                var input = $('form.need-help input[name='+key+']');
                if (!input.length) input = $('form.need-help select[name='+key+']');
                if (!input.length) input = $('form.need-help textarea[name='+key+']');
                if (input.length) input.val(data[key]);
            }
        });
        @endif
    });
</script>
@stop