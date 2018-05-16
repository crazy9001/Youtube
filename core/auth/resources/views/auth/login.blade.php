@extends('auth::auth.master')

@section('content')

    {!! Form::open(['route' => 'access.login', 'class' => 'form-validate', 'id' => 'test']) !!}
        <div class="form-group @if ($errors->has('username')) has-error @endif">
            <div class="email controls">
                {!! Form::text('email', old('username', ''), ['class' => 'form-control', 'placeholder' => trans('auth::auth.login.username'), /*'data-rule-required' => 'true', 'data-rule-email' => 'true'*/]) !!}
                @if ($errors->has('username'))
                    <span id="username-error" class="help-block has-error">{{ $errors->first('username') }}</span>
                @endif
            </div>
        </div>
        <div class="form-group @if ($errors->has('username')) has-error @endif">
            <div class="pw controls">
                {!! Form::input('password', 'password', '', ['class' => 'form-control', 'placeholder' => trans('auth::auth.login.password'), /*'data-rule-required' => 'true'*/]) !!}
                @if ($errors->has('username'))
                    <span id="password-error" class="help-block has-error">{{ $errors->first('password') }}</span>
                @endif
            </div>
        </div>
        <div class="submit">
            <div class="remember">
                <input type="checkbox" name="remember" class='icheck-me' data-skin="square" data-color="blue" id="remember">
                <label for="remember">{{ trans('auth::auth.login.remember') }}</label>
            </div>
            <input type="submit" value="{{ trans('auth::auth.login.login') }}" class='btn btn-primary'>
        </div>
    {!! Form::close() !!}

@stop