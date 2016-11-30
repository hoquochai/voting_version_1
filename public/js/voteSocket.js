$(document).ready(function(){
    var socket = io.connect('http://localhost:8890');

    //socket load chart
    socket.on('charts', function (data) {
        var pollId = $('.hide-vote').data('pollId');
        if ($.parseJSON(data).success && $.parseJSON(data).poll_id == pollId) {
            $('.show-piechart').empty();
            $('.show-piechart').append($.parseJSON(data).htmlPieChart);
            $('.show-barchart').empty();
            $('.show-barchart').append($.parseJSON(data).htmlBarChart);
        }
    });

    //socket load vote details
    socket.on('votes', function (data) {
        var pollId = $('.hide-vote').data('pollId');
        if ($.parseJSON(data).success && $.parseJSON(data).poll_id == pollId) {
            $('.model-show-details').empty();
            $('.model-show-details').append($.parseJSON(data).html);
        }
    });

    //socket vote poll
    socket.on('message', function (data) {
        var pollId = $('.hide-vote').data('pollId');
        if ($.parseJSON(data).poll_id == pollId) {
            jQuery.each($.parseJSON(data).result, function(key,value ) {
                $('#id1' + value.option_id).html(value.count_vote);
                $('#id2' + value.option_id).html(value.count_vote);
                $('#id3' + value.option_id).html(value.count_vote);
                $('#id4' + value.option_id).html(value.count_vote);
            });
        }
    });

    //socket comment poll
    socket.on('comment', function (data) {
        var pollId = $('.hide').data('pollId');
        if ($.parseJSON(data).success && $.parseJSON(data).poll_id == pollId) {
            $('.comments').append($.parseJSON(data).html);
            var commentCount = $('.comment-count').html();
            $('.comment-count').html(parseInt(commentCount) + 1);
        }
    });
});
