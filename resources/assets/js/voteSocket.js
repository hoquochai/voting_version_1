$(document).ready(function(){
    var socket = io.connect('http://localhost:8890');
    socket.on('message', function (data) {
        var pollId = $('.hide-vote').data('pollId');
        if ($.parseJSON(data).poll_id == pollId) {
            jQuery.each($.parseJSON(data).result, function( key, value ) {
                $('#id1' + value.option_id).html(value.count_vote);
                $('#id2' + value.option_id).html(value.count_vote);
                $('#id3' + value.option_id).html(value.count_vote);
            });
        }
    });

    socket.on('comment', function (data) {
        var pollId = $('.hide').data('pollId');

        if ($.parseJSON(data).success && $.parseJSON(data).poll_id == pollId) {
            $('.comments').append($.parseJSON(data).html);
            var commentCount = $('.comment-count').html();
            $('.comment-count').html(parseInt(commentCount) + 1);
        }
    });
});
