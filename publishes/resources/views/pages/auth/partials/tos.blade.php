<div class="row no-gutters align-items-center justify-content-between">

    <div class="form-group mx-auto mb-0">

        <div class="form-check">
            <input type="checkbox" class="form-check-input" name="tos" id="tos">
            <label class="form-check-label" for="tos">
                {{ Lang::get('SickCRUD::auth.tos-read-and-accept') }} <a href="#">{{ Lang::get('SickCRUD::auth.tos-terms-and-conditions') }}</a>
            </label>
            @if ($errors->has('tos'))
                <div class="invalid-feedback mt-0">
                    {{ $errors->first('tos') }}
                </div>
            @endif
        </div>

    </div>

</div>
