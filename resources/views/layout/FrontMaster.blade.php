@extends('layout.FrontBase')
@section('page')

    @include('layout.FrontNavigation')

    <div id="wrapper" class="container haside">
        <div class="row block page p-home">

            @include('layout.FrontSideBar')
            @yield('content')
        </div>
    </div>
    <a href="#" id="linkTop" class="backtotop"><i class="material-icons">arrow_drop_up</i></a>
    <div id="footer" class="row block full oboxed">
        @include('layout.FrontFooter')
    </div>

    @include('layout.FrontModal')

@stop