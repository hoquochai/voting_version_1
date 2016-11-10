$(document).ready(function(){

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
        if ($('.input').val().length != 0) {
            if (testEmail.test($('.input').val())) {
                this.disabled = true;
                $('.message-email').html('');
                this.form.submit();
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

function voted(id) {
    $('#' + id).removeClass('animated pulse').delay(2000).addClass('animated pulse');
}

function selectOption(option) {
    console.log(option.value);
    $('html, body').animate({
        scrollTop: $('#option-' + option.value).offset().top - 100
    }, 1000);
}

function goVoteInfor() {
    $('html, body').animate({
        scrollTop: $('#vote-info').offset().top - 100
    }, 1000);
}

function goComment() {
    $('html, body').animate({
        scrollTop: $('#panel-comment').offset().top - 100
    }, 1000);
}

function showModelImage(src) {
    $('#imageOfOptionPreview').attr("src", src);
    $('#modalImageOption').modal('show');
}

