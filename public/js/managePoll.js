$(document).ready(function(){

    $('.loader').hide();

    $('.btn-delete-participant').on('click', function() {
        var confirmDeleteParticipant = $('.hide').data('deleteParticipant');

        if (confirm(confirmDeleteParticipant)) {
            $('#form-delete-participant').submit();
            $('.loader').show();
        }
    });

    $('.close-poll').on('click', function() {
        var confirmClosePoll = $('.hide').data('closePoll');

        if (confirm(confirmClosePoll)) {
            $('#close-poll').submit();
            $('.loader').show();
        }
    });

    $('.reopen-poll').on('click', function() {
        var confirmReopenPoll = $('.hide').data('reopenPoll');
        var urlReopenPoll = $('.hide').data('urlReopenPoll');
        var pollId = $('.hide').data('pollId');

        if (confirm(confirmReopenPoll)) {
            window.location.href = urlReopenPoll + '/' + pollId + '/edit';
            $('.loader').show();
        }
    });

     $('#btn-register').on('click', function() {
        $('#form-register').submit();
        $('.loader').show();
    });

    $('.btn-reset-password').on('click', function() {
        $('#form-reset-password').submit();
        $('.loader').show();
    });
});
