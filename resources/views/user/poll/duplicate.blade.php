@extends('layouts.app')
@section('title')
    {{ trans('polls.title') }}
@endsection
@section('content')
    <div class="container">
        <div class="hide" data-poll="{{ $dataJson }}"
             data-action="edit"
             data-route-link="{{ route('link.store') }}"
             data-token="{{ csrf_token() }}"></div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <section>
                    <div class="wizard create-poll">
                        <div class="wizard-inner">
                            <div class="connecting-line"></div>
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Step 1">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-info-sign"></i>
                            </span>
                                    </a>
                                </li>

                                <li role="presentation" class="disabled">
                                    <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-option-horizontal"></i>
                            </span>
                                    </a>
                                </li>
                                <li role="presentation" class="disabled">
                                    <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Step 3">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-cog"></i>
                            </span>
                                    </a>
                                </li>

                                <li role="presentation" class="disabled">
                                    <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Complete">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-user"></i>
                            </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        @include('layouts.error')
                        @include('layouts.message')

                        {{
                            Form::open([
                                'route' => 'duplicate.store',
                                'method' => 'POST',
                                'id' => 'form_create_poll',
                                'enctype' => 'multipart/form-data',
                                'role' => 'form',
                            ])
                        }}
                        <div class="tab-content">

                            <!---------------------------------------------------/
                            /             INFORMATION                           /
                            /---------------------------------------------------->

                            <div class="tab-pane active" role="tabpanel" id="step1">

                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3>{{ strtoupper(trans('polls.label.step_1')) }}</h3>
                                    </div>
                                    <div class="panel-body">

                                        <!-- TITLE -->
                                        <div class="form-group">
                                            {{ Form::label(trans('polls.label_for.title'), trans('polls.label.title')) }}
                                            {{
                                                Form::text('title', $poll->title, [
                                                    'class' => 'form-control',
                                                    'id' => 'title',
                                                    'placeholder' => trans('polls.placeholder.title'),
                                                ])
                                            }}
                                        </div>

                                        <!-- LOCATION -->
                                        <div class="form-group">
                                            {{ Form::label(trans('polls.label_for.location'), trans('polls.label.location')) }}
                                            {{
                                                Form::text('location', $poll->location, [
                                                    'class' => 'form-control',
                                                    'id' => 'location',
                                                    'placeholder' => trans('polls.placeholder.location'),
                                                ])
                                            }}
                                        </div>

                                        <!-- DESCRIPTION -->
                                        <div class="form-group">
                                            {{ Form::label(trans('polls.label_for.description'), trans('polls.label.description')) }}
                                            {{
                                                Form::textarea('description', $poll->description, [
                                                    'class' => 'form-control',
                                                    'id' => 'description',
                                                    'placeholder' => trans('polls.placeholder.description'),
                                                ])
                                            }}
                                        </div>

                                        <!-- NAME -->
                                        <div class="form-group">
                                            {{ Form::label(trans('polls.label_for.full_name'), trans('polls.label.full_name')) }}
                                            {{
                                                Form::text('name', $poll->user->name, [
                                                    'class' => 'form-control',
                                                    'id' => 'name',
                                                    'placeholder' => trans('polls.placeholder.full_name'),
                                                ])
                                            }}
                                        </div>

                                        <!-- EMAIL -->
                                        <div class="form-group">
                                            {{ Form::label(trans('polls.label_for.email'), trans('polls.label.email')) }}
                                            {{
                                                Form::text('email', $poll->user->email, [
                                                    'class' => 'form-control',
                                                    'id' => 'email',
                                                    'placeholder' => trans('polls.placeholder.email'),
                                                ])
                                            }}
                                            <div class="email-error"></div>
                                        </div>

                                        <!-- CHATWORK -->
                                        <div class="form-group">
                                            {{ Form::label(trans('polls.label_for.chatwork'), trans('polls.label.chatwork')) }}
                                            {{
                                                Form::text('chatwork_id', $poll->user->chatwork_id, [
                                                    'class' => 'form-control',
                                                    'id' => 'chatwork',
                                                    'placeholder' => trans('polls.placeholder.chatwork'),
                                                ])
                                            }}
                                        </div>

                                        <!-- TYPE -->
                                        <div class="form-group" id="type">
                                            {{ Form::label(trans('polls.label_for.type'), trans('polls.label.type')) }}
                                            <label class="radio-inline">
                                                {{ Form::radio('type', config('settings.type_poll.single_choice'), ($poll->multiple == trans('polls.label.single_choice')) ? true : null) }}
                                                {{ trans('polls.label.single_choice') }}
                                            </label>
                                            <label class="radio-inline">
                                                {{ Form::radio('type', config('settings.type_poll.multiple_choice'), ($poll->multiple == trans('polls.label.multiple_choice')) ? true : null) }}
                                                {{ trans('polls.label.multiple_choice') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <ul class="list-inline pull-right">
                                    <li>
                                        {{
                                            Form::button(trans('polls.button.continue'), [
                                                'class' => 'btn btn-primary next-step',
                                                'value' => 'info',
                                            ])
                                        }}
                                    </li>
                                </ul>
                            </div>


                            <!---------------------------------------------------/
                            /                   OPTION                           /
                            /---------------------------------------------------->

                            <div class="tab-pane" role="tabpanel" id="step2">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3>{{ strtoupper(trans('polls.label.step_2')) }}</h3>
                                    </div>
                                    <div class="panel-body option">
                                        <!-- OLD OPTION -->
                                        <div class="old-option">
                                            @foreach($poll->options as $option)
                                                <div id="{{ $option->id }}" class="well">
                                                    <div class="panel panel-success">
                                                        <div class="panel-heading">
                                                            Option {{ $loop->index + 1 }}
                                                            <button type="button" class="btn btn-danger btn-delete-option-duplicate" onclick="removeOpion('{{ $option->id }}', 'edit')">
                                                                <span class="fa fa-trash"></span> {{ trans('polls.button.remove') }}
                                                            </button>
                                                        </div>
                                                        <div class="panel-body">
                                                            <div class="form-group">
                                                                {{ Form::text('optionText['. $option->id .']', $option->name, ['class' => 'form-control']) }}
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="col-lg-3">
                                                                    <img src="{{ asset($option->showImage()) }}" class="image-option">
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <img id="preview_{{ $option->id }}" src="#" class="preview-image" />
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                {{
                                                                    Form::file('optionImage['. $option->id .']', [
                                                                        'onchange' => 'readURL(this, "preview_' . $option->id . '")',
                                                                        'class' => 'form-control',
                                                                    ])
                                                                }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <!-- OPTION LISTS -->
                                        <div class="poll-option"></div>

                                        <!-- BUTTON ADD OPTION -->
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="form-line">
                                                    {{
                                                        Form::text('number', config('settings.length_poll.number_option'), [
                                                            'class' => 'form-control',
                                                            'placeholder' => trans('polls.placeholder.number_add'),
                                                            'id' => 'number',
                                                        ])
                                                    }}
                                                </div>
                                                <span class="input-group-btn">
                                                    {{
                                                        Form::button('<span class="glyphicon glyphicon-plus"></span>', [
                                                            'class' => 'btn btn-default',
                                                            'onclick' => 'addOption(' . $dataJson . ')'
                                                        ])
                                                    }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <ul class="list-inline pull-right">
                                    <li>{{ Form::button(trans('polls.button.previous'), ['class' => 'btn btn-default prev-step']) }}</li>
                                    <li>
                                        {{
                                            Form::button(trans('polls.button.continue'), [
                                                'class' => 'btn btn-primary next-step',
                                                'value' => 'option',
                                            ])
                                        }}
                                    </li>
                                </ul>
                            </div>

                            <!---------------------------------------------------/
                            /                   SETTING                          /
                            /---------------------------------------------------->
                            <div class="tab-pane" role="tabpanel" id="step3">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3>{{ strtoupper(trans('polls.label.step_3')) }}</h3>
                                    </div>
                                    <div class="panel-body">
                                        @foreach ($dataView['setting'] as $key => $value)
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        {{
                                                            Form::checkbox('setting[]', $key, array_key_exists($key, $setting) ? true : null, [
                                                                'onchange' => 'settingAdvance(' . $key . ')',
                                                            ])
                                                        }}
                                                    </span>
                                                    {{ Form::text('setting_text', $value, ['disabled' => true, 'class' => 'form-control']) }}
                                                </div>
                                            </div>

                                            <!-- SETTING: CUSTOM LINK -->
                                            @if ($key == config('settings.setting.custom_link'))
                                                <div class="form-group {{ empty($setting[$key]) ? "setting-advance" : "" }}" id="new-link">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            {{ Form::text('url', url('/') . config('settings.email.link_vote'), ['disable' => true]) }}
                                                        </span>
                                                        {{
                                                            Form::text('value[link]', empty($setting[$key]) ? str_random(config('settings.length_poll.link')) : $setting[$key], [
                                                                'class' => 'form-control',
                                                                'id' => 'link',
                                                                'placeholder' => trans('polls.label.setting.custom_link'),
                                                            ])
                                                        }}
                                                        <div class="link-error"></div>
                                                    </div>
                                                </div>

                                                <!-- SETTING: SET LIMIT -->
                                            @elseif ($key == config('settings.setting.set_limit'))
                                                <div class="form-group {{ empty($setting[$key]) ? "setting-advance" : "" }}" id="set-limit">
                                                    {{
                                                        Form::number('value[limit]', empty($setting[$key]) ? null : $setting[$key], [
                                                            'class' => 'form-control',
                                                            'id' => 'limit',
                                                            'placeholder' => trans('polls.label.setting.set_limit'),
                                                            'min' => 1,
                                                            'max' => 99,
                                                            'oninput' => "validity.valid||(value='1');",
                                                        ])
                                                    }}
                                                </div>

                                                <!-- SETTING: SET PASSWORD -->
                                            @elseif ($key == config('settings.setting.set_password'))
                                                <div class="form-group {{ empty($setting[$key]) ? "setting-advance" : "" }}" id="set-password">
                                                    {{
                                                        Form::text('value[password]', empty($setting[$key]) ? null : $setting[$key], [
                                                            'class' => 'form-control',
                                                            'id' => 'password',
                                                            'placeholder' => trans('polls.label.setting.set_password'),
                                                        ])
                                                    }}
                                                </div>
                                            @else
                                                @continue
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                <ul class="list-inline pull-right">
                                    <li>{{ Form::button(trans('polls.button.previous'), ['class' => 'btn btn-default prev-step']) }}</li>
                                    <li>
                                        {{
                                            Form::button(trans('polls.button.continue'), [
                                                'class' => 'btn btn-primary next-step',
                                                'value' => 'setting',
                                            ])
                                        }}
                                    </li>
                                </ul>
                            </div>

                            <!---------------------------------------------------/
                            /                   PARTICIPANT                      /
                            /---------------------------------------------------->
                            <div class="tab-pane" role="tabpanel" id="complete">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3>{{ strtoupper(trans('polls.label.step_4')) }}</h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="form-group" id="email-participant">
                                            {{ Form::label(trans('polls.label_for.invite'), trans('polls.label.invite')) }}
                                            <br>
                                            {{
                                                Form::text('member', null, [
                                                    'id' => 'member',
                                                    'class' => 'form-control',
                                                    'placeholder' => trans('polls.placeholder.email_participant'),
                                                    'data-role' => 'tagsinput',
                                                ])
                                            }}
                                        </div>
                                    </div>
                                </div>
                                <ul class="list-inline pull-right">
                                    <li>{{ Form::button(trans('polls.button.previous'), ['class' => 'btn btn-default prev-step']) }}</li>
                                    <li>
                                        {{
                                            Form::button(trans('polls.button.finish'), [
                                                'class' => 'btn btn-primary finish',
                                                'value' => 'btn_participant',
                                            ])
                                        }}
                                    </li>
                                </ul>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
