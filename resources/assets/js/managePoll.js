$(document).ready(function(){

    $('.loader').hide();

    var urlSearch = $('.hide-search').data('urlSearch');

    //searchable
     var engine = new Bloodhound({
        remote: {
            url: '/find?q=%QUERY%',
            wildcard: '%QUERY%'
        },
        datumTokenizer: Bloodhound.tokenizers.whitespace('q'),
        queryTokenizer: Bloodhound.tokenizers.whitespace
    });

    $(".search-input").typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    }, {
            source: engine.ttAdapter(),

            // This will be appended to "tt-dataset-" to form the class name of the suggestion menu.
            name: 'pollsList',

            // the key from the array we want to display (name,id,email,etc...)
            templates: {
                empty: [
                    '<div class="list-group search-results-dropdown"><div class="list-group-item">Nothing found.</div></div>'
                ],
                header: [
                    '<div style="position:relative; z-index: 2000;" class="list-group search-results-dropdown">'
                ],
                suggestion: function (data) {
                    return '<a href="' + urlSearch + '/search/' + data.id + '/' + data.created_at + '" class="list-group-item">' + data.title + '</a>'
            }
        }
    });

    $('.btn-delete-participant').on('click', function() {
        var confirmDeleteParticipant = $('.hide').data('deleteParticipant');
        swal({
            title: confirmDeleteParticipant,
            type: "info",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes",
            closeOnConfirm: true
        },
        function(){
            $('#form-delete-participant').submit();
            $('.loader').show();
        });
    });

    $('.close-poll').on('click', function() {
        swal({
            title: $('.hide').data('closePoll'),
            type: "info",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes",
            closeOnConfirm: true
        },
        function(){
            $('#close-poll').submit();
            $('.loader').show();
        });
    });

    $('.reopen-poll').on('click', function() {
        var confirmReopenPoll = $('.hide').data('reopenPoll');
        var urlReopenPoll = $('.hide').data('urlReopenPoll');
        var pollId = $('.hide').data('pollId');
        swal({
            title: confirmReopenPoll,
            type: "info",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes",
            closeOnConfirm: true
        },
        function(){
            window.location.href = urlReopenPoll + '/' + pollId + '/edit';
            $('.loader').show();
        });
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
