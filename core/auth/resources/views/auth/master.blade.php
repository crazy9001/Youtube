@extends('bases::layouts.base')

@section('body-class')
    login
@stop

@section ('page')

    <div class="wrapper">
        <h1>
            <a href="{{ route('dashboard.index') }}">
                <img src="{{ asset('images/logo-big.png') }}" alt="" class='retina-ready' width="59" height="49">FLAT</a>
        </h1>
        <div class="login-body">
            <h2>{{ trans('auth::auth.login.title') }}</h2>
            @yield('content')
            <div class="forget">
                <a href="#">
                    <span>{{ trans('auth::auth.forgot_password.title') }}</span>
                </a>
            </div>
        </div>
    </div>

@stop