<div class="form-group" id="idOption">
    <div class="input-group" id="option-poll">
        <input type="file" class="file" name="optionImage[idOption]" onchange="readURL(this, 'preview-idOption')">
        <input type="text" name="optionText[idOption]" class="form-control"
               placeholder="{{ trans('polls.placeholder.option') }}" onclick="addAutoOption('idOption')" onblur="checkOptionSame()">
        <span class="input-group-btn">
            <button class="btn" type="button" onclick="showOptionImage('idOption')" style="background: darkcyan; border-color: darkcyan; color: white">
                <span class="glyphicon glyphicon-picture"></span>
            </button>
            <button class="btn btn-danger" type="button" onclick="removeOpion('idOption')" style="border-radius: 0">
                <span class="glyphicon glyphicon-trash"></span>
            </button>
        </span>
    </div>
    <img id="preview-idOption" src="#" class="preview-image"/>
</div>
