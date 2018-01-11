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

                <form method="post" action="{{ URL::route('SickCRUD.auth.login') }}">

                    {{ csrf_field() }}

                    <div class="form-group">
                        <input type="text" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ Request::old('email') }}" placeholder="{{ Lang::get('SickCRUD::misc.fields.email') }}">
                        @if ($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" value="{{ Request::old('password') }}" placeholder="{{ Lang::get('SickCRUD::misc.fields.password') }}" data-show="{{ Lang::get('SickCRUD::misc.show') }}" data-hide="{{ Lang::get('SickCRUD::misc.hide') }}">
                        @if ($errors->has('password'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>

                    <div class="row no-gutters align-items-center justify-content-between">

                        <div class="form-check float-left">
                            <label class="form-check-label">
                                <input type="checkbox" name="remember" class="form-check-input"> {{ Lang::get('SickCRUD::misc.fields.remember_me') }}
                            </label>
                        </div>

                        <div class="form-check float-right">
                            <a href="#">{{ Lang::get('SickCRUD::misc.forgot_password') }}</a>
                        </div>

                    </div>

                    <button type="submit" class="submit-button btn btn-block btn-primary my-4 mx-auto">{{ Lang::get('SickCRUD::misc.login') }}</button>

                </form>

            </div>

        </div>

    </div>

@endsection