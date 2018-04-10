<div class="form-group has-feedback {{ $errors->has('tos') ? 'has-error' : '' }}">
    <div class="checkbox">
        <label class="checkbox-control">
            <input type="checkbox" name="tos"> {{ Lang::get('SickCRUD::auth.tos-read-and-accept') }} <a href="#">{{ Lang::get('SickCRUD::auth.tos-terms-and-conditions') }}.</a>
            <div class="checkbox-indicator"></div>
            @if ($errors->has('tos'))
                <span class="help-block">{{ $errors->first('tos') }}</span>
            @endif
        </label>
    </div>
</div>
