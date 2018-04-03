@extends('SickCRUD::layout.layout')

@section('pageContent')

    <div class="login-box">

        <div class="login-box-body">

            <div class="login-logo">
                <a href="#"><b>Sick</b>CRUD</a>
            </div>

            <p class="login-box-msg">{{ Lang::get('SickCRUD::auth.login-into-account') }}</p>

            <form action="{{ URL::route('SickCRUD.auth.login') }}" method="post">

                {{ csrf_field() }}

                <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                    <input type="text" name="email" class="form-control" placeholder="{{ Lang::get('SickCRUD::fields.email') }}">
                    <span class="fas fa-envelope form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback  {{ $errors->has('password') ? 'has-error' : '' }}">
                    <input type="password" name="password" class="form-control" placeholder="{{ Lang::get('SickCRUD::fields.password') }}">
                    <span class="fas fa-lock form-control-feedback"></span>
                </div>

                @if(SickCRUD_config('general', 'login-reCaptcha', false) === true)
                    <div class="form-group has-feedback {{ $errors->has('g-recaptcha-response') ? 'has-error' : '' }}">
                        {!! NoCaptcha::display() !!}
                    </div>
                @endif

                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> {{ Lang::get('SickCRUD::fields.remember_me') }}
                            </label>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">{{ Lang::get('SickCRUD::auth.actions.login') }}</button>
                    </div>
                </div>

            </form>

            <a href="#">{{ Lang::get('SickCRUD::auth.actions.forgot_password') }}</a>

        </div>
    </div>

@endsection