<div class="col-md-12" id="{{ $commentId }}">
    <br>
    <div class="col-md-2 col-lg-3">
        <img class="img-comment img-circle" src="{!! $imageComment !!}">
    </div>
    <div class="col-md-10 col-lg-9">
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
