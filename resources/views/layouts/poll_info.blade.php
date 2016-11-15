@if (isset($page) && $page == "edit")
    {{
       Form::open([
           'route' => ['user-poll.update', $poll->id],
           'method' => 'PUT',
           'id' => 'form_update_poll',
           'role' => 'form',
       ])
    }}
@endif
<div class="row">
<!-- EMAIL -->
    <div class="col-lg-8">
        <div class="form-group">
            <div class="input-group required">
                <span class="input-group-addon">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                </span>
                {{
                    Form::text('email', (isset($poll) && $poll) ? $poll->user->email : (auth()->user() ? auth()->user()->email : null), [
                        'class' => 'form-control',
                        'id' => 'email',
                        'placeholder' => trans('polls.placeholder.email'),
                        'onblur' => 'checkMailExitsDatabase()',
                    ])
                }}
            </div>
            <div class="form-group">
                <div class="error_email"></div>
            </div>
        </div>
    </div>
<!-- NAME -->
    <div class="col-lg-4">
        <div class="form-group">
            <div class="input-group required">
                <span class="input-group-addon">
                    <i class="fa fa-user" aria-hidden="true"></i>
                </span>
                {{
                    Form::text('name', (isset($poll) && $poll) ? $poll->user->name :  (auth()->user() ? auth()->user()->name : null), [
                        'class' => 'form-control',
                        'id' => 'name',
                        'placeholder' => trans('polls.placeholder.full_name'),
                    ])
                }}
            </div>
        </div>
    </div>
</div>
<div class="row">
<!-- TITLE -->
    <div class="col-lg-8">
        <div class="form-group">
            <div class="input-group required">
                <span class="input-group-addon">
                    <i class="fa fa-tag" aria-hidden="true"></i>
                </span>
                {{
                    Form::text('title', (isset($poll) && $poll) ? $poll->title : null, [
                        'class' => 'form-control',
                        'id' => 'title',
                        'placeholder' => trans('polls.placeholder.title'),
                    ])
                }}
            </div>
        </div>
    </div>
<!-- TYPE -->
    <div class="col-lg-4">
        <div class="form-group">
            {{ Form::select('type', $data['viewData']['types'], null, ['class' => 'form-control']) }}
        </div>
    </div>
</div>

<!-- DESCRIPTION -->
<div class="form-group">
    {{
        Form::textarea('description', (isset($poll) && $poll) ? $poll->description : null, [
            'class' => 'form-control',
            'id' => 'description',
            'placeholder' => trans('polls.placeholder.description'),
            'rows' => 2,
        ])
    }}
</div>
<div class="row">
<!-- TIME CLOSE -->
    <div class="col-lg-6">
        <div class="form-group">
            <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-clock-o" aria-hidden="true"></i>
            </span>
                {{
                    Form::text('closingTime', (isset($poll) && $poll) ? $poll->date_close : null, [
                        'class' => 'form-control',
                        'id' => 'time_close_poll',
                        'placeholder' => trans('polls.placeholder.time_close')
                    ])
                }}
            </div>
        </div>
    </div>
<!-- LOCATION -->
    <div class="col-lg-6">
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
            </span>
            {{
                Form::text('location', (isset($poll) && $poll) ? $poll->location : null, [
                    'class' => 'form-control',
                    'id' => 'location',
                    'placeholder' => trans('polls.placeholder.location'),
                ])
            }}
        </div>
    </div>
</div>
@if (isset($page) && $page == "edit")
    <input type="submit" class="btn btn-success" name="btn_edit" value="{{ trans('polls.button.save_info') }}">
    {{ Form::close() }}
@endif
