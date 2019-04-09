@section('form-helper-scripts')
<script>
    $(document).ready(function() {
        $('.select2').select2();
        @if (!empty($data))
        var data = JSON.parse('{!! !empty($json_data) ? $json_data : json_encode($data) !!}');
        Object.keys(data).forEach(function(key) {
            if (data[key]) {
                var input = $('form.need-help input[name='+key+']');
                if (!input.length) input = $('form.need-help select[name='+key+']');
                if (!input.length) input = $('form.need-help textarea[name='+key+']');
                if (input.length) input.val(data[key]);
            }
        });
        @endif
        $('body').find('.action-container button').on('click', function () {
            var button = $(this);
            var value = button.val();
            var container = button.closest('.action-container');
            var coverage = button.closest('.action-coverage');
            var input = container.find('input.action-input');
            var currentValue = input.val();
            var isCancel = false;
            if (value == 'remove') {
                return coverage.remove();
            }

            if (currentValue != value) {
                input.val(value).prop('disabled', false);
            } else {
                isCancel = true;
                input.val('').prop('disabled', false);
            }
            
            coverage.find('input').each(function () {
                var input = $(this);
                var isInputReadonly = input.hasClass('readonly-input');
                console.log(value);
                console.log(isInputReadonly);
                console.log(isCancel);
                if (value == 'edit' && !isInputReadonly && !isCancel || value == 'delete' &&  isInputReadonly && !isCancel) {
                    input.prop('disabled', false);
                } else {
                    input.prop('disabled', true);
                }
            });
            coverage.find('select').each(function () {
                var input = $(this);
                var isInputReadonly = input.hasClass('readonly-input');
                if (value == 'edit' && !isInputReadonly && !isCancel || value == 'delete' &&  isInputReadonly && !isCancel) {
                    input.prop('disabled', false);
                } else {
                    input.prop('disabled', true);
                }
            });
            coverage.find('textarea').each(function () {
                var input = $(this);
                var isInputReadonly = input.hasClass('readonly-input');
                if (value == 'edit' && !isInputReadonly && !isCancel || value == 'delete' &&  isInputReadonly && !isCancel) {
                    input.prop('disabled', false);
                } else {
                    input.prop('disabled', true);
                }
            });

            container.find('.default-view').removeClass('hide');
            container.find('.switch-view').removeClass('show');
            if (!isCancel) {
                button.find('.default-view').addClass('hide');
                button.find('.switch-view').addClass('show');
            }
        });
        $('button.add-row').on('click', function () {
            var template = $('.row-template-container').find('.template').clone();
            template.find('.action-container button').on('click', function () {
                var button = $(this);
                var value = button.val();
                if (value == 'remove') {
                    button.closest('.action-coverage').remove();
                }
            });
            template.find('input').each(function () {
                $(this).prop('disabled', false);
            });
            template.find('select').each(function () {
                $(this).prop('disabled', false);
            });
            template.find('textarea').each(function () {
                $(this).prop('disabled', false);
            });
            $('.template-destination').append(template);
            template.find('.select2-on-template').select2();
        });
    });
</script>
@stop