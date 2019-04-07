$(document).ready(function() {
    $('form.ajax-submit').on('submit', function (e) {
        e.preventDefault();
        var form = $(this);
        var method = $(this).attr('method');
        var url = $(this).attr('action');
        var data = $(this).serializeArray();
        
        toastr.options.positionClass = 'toast-bottom-right';
        toastr.options.extendedTimeOut = 1000;
        toastr.options.timeOut = 2000;
        toastr.options.fadeOut = 250;
        toastr.options.fadeIn = 250;

        $.ajax({
            type : method,
            url: url,
            data : data,
            dataType : 'json',
            processData: true,
            success : function(data) {
                if (data.resetForm) {
                    form.trigger("reset");
                }
                if (data.redirect !== 'undefined') {
                    toastr.success('Redirecting please wait...');
					setTimeout(function() {
						window.location = data.redirect;
					}, 2500);
                }
                if (data.notifMessage !== 'undefined') {
                    toastr.success(data.notifMessage);
                }
            },
            error : function(data, text, error) {
                if (data.responseJSON.message.length) {
                    for (let index = 0; index < data.responseJSON.message.length; index++) {
                        const message = data.responseJSON.message[index];
                        toastr.warning(message);
                    }
                } else if (data.responseJSON.notifMessage.length) {
                    toastr.warning(data.responseJSON.notifMessage);
                }
            }
        });
    });
});