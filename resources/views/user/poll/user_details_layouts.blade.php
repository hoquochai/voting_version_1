<div class="dropdown">
    <a class="dropbtn">{{ $user->name }}</a>
    <div class="dropdown-content">
        <center><img class="img-comment img-circle" src="{{ $poll->user->getAvatarPath() }}"></center>
        <br>
        {{ trans('label.name') }}: {{ $user->name }}
        @if (! is_null($user->gender))
            <br>
            {{ trans('label.label_gender') }}: {{ $user->showGender() }}
        @endif
    </div>
</div>
