@extends('SickCRUD::layout.layout')

@section('pageContent')

    <div class="register-box">

        <div class="register-box-body">

            <div class="register-logo">
                <a href="#"><b>Sick</b>CRUD</a>
            </div>

            <p class="register-box-msg">{{ Lang::get('SickCRUD::auth.register-account') }}</p>

            <form action="{{ URL::route('SickCRUD.auth.register') }}" method="post">

                {{ csrf_field() }}

                <div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
                    <input type="text" name="name" value="{{ Request::old('name') }}" class="form-control" placeholder="{{ Lang::get('SickCRUD::fields.name') }}">
                    <span class="fas fa-user form-control-feedback"></span>
                    @if ($errors->has('name'))
                        <span class="help-block">{{ $errors->first('name') }}</span>
                    @endif
                </div>

                <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                    <input type="text" name="email" value="{{ Request::old('email') }}" class="form-control" placeholder="{{ Lang::get('SickCRUD::fields.email') }}">
                    <span class="fas fa-envelope form-control-feedback"></span>
                    @if ($errors->has('email'))
                        <span class="help-block">{{ $errors->first('email') }}</span>
                    @endif
                </div>

                <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                    <input type="password" name="password" class="form-control" placeholder="{{ Lang::get('SickCRUD::fields.password') }}">
                    <span class="fas fa-lock form-control-feedback"></span>
                    @if ($errors->has('password'))
                        <span class="help-block">{{ $errors->first('password') }}</span>
                    @endif
                </div>

                <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="{{ Lang::get('SickCRUD::fields.password_confirmation') }}">
                    <span class="fas fa-lock form-control-feedback"></span>
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">{{ $errors->first('password_confirmation') }}</span>
                    @endif
                </div>

                @if(SickCRUD_config('general', 'register-reCaptcha', false) === true)
                    <div class="form-group has-feedback {{ $errors->has('g-recaptcha-response') ? 'has-error' : '' }}">
                        {!! NoCaptcha::display() !!}
                    </div>
                @endif

                @if(SickCRUD_config('general', 'register-require-tos', false) === true)

                    @include('SickCRUD::pages.auth.partials.tos')

                @endif

                <div class="row">
                    <div class="col-xs-4 col-xs-offset-8">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">{{ Lang::get('SickCRUD::auth.actions.register') }}</button>
                    </div>
                </div>

            </form>

        </div>

    </div>

@endsection