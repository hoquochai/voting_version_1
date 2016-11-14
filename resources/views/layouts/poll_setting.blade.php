@foreach ($data['viewData']['settings'] as $settingKey => $settingText)
    <div class="form-group">
        <label>
            <input type="checkbox" name="setting[{{ $settingKey }}]" value="{{ $settingKey }}" onchange="settingAdvance('{{ $settingKey }}')"> {{ $settingText }}
        </label>
    </div>
    @if ($settingKey == config('settings.setting.custom_link'))
        <div class="form-group setting-advance" id="setting-link">
            <div class="row">
                <div class="col-lg-7">
                    <div class="input-group">
                        <span class="input-group-addon">
                            {{ url('/') . config('settings.email.link_vote') }}
                        </span>
                        {{
                            Form::text('value[link]', str_random(config('settings.length_poll.link')), [
                                'class' => 'form-control',
                                'id' => 'link',
                                'placeholder' => trans('polls.label.setting.custom_link'),
                                'onkeyup' => 'checkLink()',
                            ])
                        }}
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="error_link"></div>
        </div>
    @elseif ($settingKey == config('settings.setting.set_limit'))
        <div class="form-group setting-advance" id="setting-limit">
            <div class="row">
                <div class="col-lg-3">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-list-ol" aria-hidden="true"></i>
                        </span>
                        {{
                           Form::number('value[limit]', null, [
                               'class' => 'form-control',
                               'id' => 'limit',
                               'min' => 1,
                               'max' => 99,
                               'placeholder' => trans('polls.label.setting.set_limit'),
                               'oninput' => "validity.valid||(value='1');",
                               'onkeyup' => 'checkLimit()',
                           ])
                        }}
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="error_limit"></div>
        </div>
    @elseif ($settingKey == config('settings.setting.set_password'))
        <div class="form-group setting-advance" id="setting-password">
            <div class="row">
                <div class="col-lg-6">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-key" aria-hidden="true"></i>
                        </span>
                        {{
                            Form::password('value[password]', [
                                'class' => 'form-control',
                                'id' => 'password',
                                'placeholder' => trans('polls.label.setting.set_password'),
                                'onkeyup' => 'checkPassword()',
                            ])
                        }}
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button" onclick="showAndHidePassword()">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="error_password"></div>
        </div>
    @else
       @continue
    @endif
@endforeach
