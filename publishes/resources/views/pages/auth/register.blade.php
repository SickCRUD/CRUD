@extends('SickCRUD::layout.layout')

@section('pageContent')

    <div class="d-table auth-box-container">

        <div class="auth-box-aligned">

            <div class="auth-box">

                <div class="logo">
                    <!-- This can be a letter, or an image -->
                    <img src="http://via.placeholder.com/350x350" alt="">
                    <!-- <span>C</span> -->
                </div>

                <h5 class="mt-3 mb-4 text-center lead">Login into your account.</h5>

                <form method="post" action="{{ URL::route('SickCRUD.auth.register') }}">

                    {{ csrf_field() }}

                    <div class="form-group">
                        <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ Request::old('name') }}" placeholder="{{ Lang::get('SickCRUD::misc.fields.name') }}" autocomplete="off" data-lpignore="true">
                        @if ($errors->has('name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <input type="text" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ Request::old('email') }}" placeholder="{{ Lang::get('SickCRUD::misc.fields.email') }}">
                        @if ($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="{{ Lang::get('SickCRUD::misc.fields.password') }}" data-show="Show" data-hide="Hide">
                        @if ($errors->has('password'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <input type="password" name="password_confirmation" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" placeholder="{{ Lang::get('SickCRUD::misc.fields.password_confirmation') }}" data-show="Show" data-hide="Hide">
                        @if ($errors->has('password_confirmation'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password_confirmation') }}
                            </div>
                        @endif
                    </div>

                    @if(SickCRUD_config('general', 'register-reCaptcha', false))
                        <div class="form-group">
                            {!! NoCaptcha::display() !!}
                            @if ($errors->has('g-recaptcha-response'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('g-recaptcha-response') }}
                                </div>
                            @endif
                        </div>
                    @endif

                    <div class="row no-gutters align-items-center justify-content-between">

                        <div class="form-check mx-auto">
                            <label class="form-check-label">
                                <input type="checkbox" name="remember" class="form-check-input"> I read and accept <a href="">terms and conditions</a>
                            </label>
                        </div>

                    </div>

                    <button type="submit" class="submit-button btn btn-block btn-primary my-4 mx-auto">{{ Lang::get('SickCRUD::misc.register') }}</button>

                </form>

            </div>

        </div>

    </div>

@endsection