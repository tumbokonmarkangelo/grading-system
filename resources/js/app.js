$(document).ready(function() {
    setTimeout(() => {
        $('body').removeClass('loading'); // remove loader overlay when page is ready with 1 sec delay
    }, 1000);
    $('form.ajax-submit').on('submit', function (e) {
        e.preventDefault();
        var form = $(this);
        var method = $(this).attr('method');
        var url = $(this).attr('action');
        var data = $(this).serializeArray();
        var confirmation = $(this).attr('confirmation');
        var confirmation_note = $(this).attr('confirmation-note');
        var confirmation_cancelled_note = $(this).attr('confirmation-cancelled-note');

        var isComputation = form.hasClass('form-computation');

        if (isComputation) {
            var total = 0;
            form.find('input[name="value[]"]').each(function () {
                var input = $(this);
                var value = input.val();
                var action = input.closest('.action-coverage').find('input.action-input').val();
                if (value.length && action != 'delete') {
                    total += parseInt(value);
                }
            });

            if (total != 100) {
                swal({
                    title: "Please check criteria values",
                    text:  "Total of all values must be exactly 100.",
                    icon: "warning",
                    dangerMode: true,
                })
                return false;
            }
        }

        var threeInputs = form.find('.three-inputs-container')
        if (threeInputs.length) {
            var total = 0;
            threeInputs.find(':input').each(function () {
                var input = $(this);
                var value = input.val();
                if (value.length) {
                    total += parseInt(value);
                }
            });

            if (total != 100) {
                swal({
                    title: "Please check subject period values",
                    text:  "Total of all values must be exactly 100.",
                    icon: "warning",
                    dangerMode: true,
                })
                return false;
            }
        }
        
        if (confirmation) {
            swal({
                title: "Are you sure?",
                text:  !confirmation_note ? "Once deleted, you may not be able to recover this data." :  confirmation_note,
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    submitForm(form, method, url, data);
                } else {
                    swal("Cancelled action",  !confirmation_cancelled_note ? "Data is retain." :  confirmation_cancelled_note);
                }
            });
        } else {
            submitForm(form, method, url, data);
        } 
    });

    function submitForm(form, method, url, data) {
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
                if (data.redirect !== undefined) {
                    toastr.success('Redirecting please wait...');
					setTimeout(function() {
						window.location = data.redirect;
					}, 2500);
                }
                if (data.notifMessage !== undefined) {
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
    }
});