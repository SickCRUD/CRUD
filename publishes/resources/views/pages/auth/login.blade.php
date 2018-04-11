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
                    <input type="text" name="email" value="{{ Request::old('email') }}" class="form-control" placeholder="{{ Lang::get('SickCRUD::fields.email') }}">
                    <span class="fas fa-envelope form-control-feedback"></span>
                    @if ($errors->has('email'))
                        <span class="help-block">{{ $errors->first('email') }}</span>
                    @endif
                </div>

                <div class="form-group has-feedback  {{ $errors->has('password') ? 'has-error' : '' }}">
                    <input type="password" name="password" class="form-control" placeholder="{{ Lang::get('SickCRUD::fields.password') }}">
                    <span class="fas fa-lock form-control-feedback"></span>
                    @if ($errors->has('password'))
                        <span class="help-block">{{ $errors->first('password') }}</span>
                    @endif
                </div>

                @if(SickCRUD_config('general', 'login-reCaptcha', false) === true)
                    <div class="form-group has-feedback {{ $errors->has('g-recaptcha-response') ? 'has-error' : '' }}">
                        {!! NoCaptcha::display() !!}
                        @if ($errors->has('g-recaptcha-response'))
                            <span class="help-block">{{ $errors->first('g-recaptcha-response') }}</span>
                        @endif
                    </div>
                @endif

                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox">
                            <label class="checkbox-control">
                                <input type="checkbox"name="remember" {{ Request::old('remember') ? 'checked' : null }}> {{ Lang::get('SickCRUD::fields.remember_me') }}
                                <div class="checkbox-indicator"></div>
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