<div class="col-md-12" id="{{ $commentId }}">
    <br>
    <div class="col-md-1">
        <img class="img-comment" src="{!! $imageComment !!}">
    </div>
    <div class="col-md-11">
        <label data-comment-id="{{ $commentId }}" data-poll-id="{{ $poll->id }}">
            <label class="user-comment">{{ $name }}</label>
            {{ $createdAt }}
            @if (Gate::allows('ownerPoll', $poll))
                <span class="glyphicon glyphicon-trash delete-comment"></span>
            @endif
        </label>
        <br>
        {{ $content }}
    </div>
</div>
