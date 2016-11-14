<!-- ERROR OPTION -->
<div class="form-group">
    <div class="error_option"></div>
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
                    'onclick' => 'addOption(' . $data['jsonData'] . ')'
                ])
            }}
        </span>
    </div>
</div>

