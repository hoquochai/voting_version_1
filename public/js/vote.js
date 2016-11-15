$(document).ready(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.btn-vote-name').attr('disabled', true);
    $('.poll-option').on('click', function() {
        $('.btn-vote-name').attr('disabled', !($('.poll-option').is(':checked')));
    });

    $('.btn-vote-email').attr('disabled', true);
    $('.poll-option').on('click', function() {
        $('.btn-vote-email').attr('disabled', !($('.poll-option').is(':checked')));
    });

    $('.btn-vote-name').on('click', function() {
        if ($('.input').val().length != 0) {
            this.disabled = true;
            $('.message-name').html('');
            this.form.submit();
        } else {
            divChangeAmount = $(this).parent();
            var message = divChangeAmount.data('messageName');
            $('.message-validation').html(message);
        }
    });

    $('.btn-vote-email').on('click', function() {
        var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
        divChangeAmount = $(this).parent();
        var url = divChangeAmount.data('url');
        var message = divChangeAmount.data('messageExistEmail');
        if ($('.input').val().length != 0) {
            if (testEmail.test($('.input').val())) {
                $.ajax({
                    type: 'POST',
                    url: url,
                    dataType: 'JSON',
                    data: {
                        'email': $('.input').val(),
                    },
                    success: function(data){
                        if (data.success) {
                            this.disabled = true;
                            $('.message-email').html('');
                            $('#form-vote').submit();
                        } else {
                            $('.message-validation').html(message);
                        }
                    }
                });
            } else {
                divChangeAmount = $(this).parent();
                var message = divChangeAmount.data('messageValidateEmail');
                $('.message-validation').html(message);
            }
        } else {
            divChangeAmount = $(this).parent();
            var message = divChangeAmount.data('messageEmail');
            $('.message-validation').html(message);
        }
    });
});
