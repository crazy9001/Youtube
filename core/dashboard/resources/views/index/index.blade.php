@extends('bases::layouts.master')

@section('content')

    @if(Permission::isSuperAdmin())
        <!--Super Admins-->
        @include('dashboard::partials.admin')
    @elseif(Permission::isUser())
        @include('dashboard::partials.user')
    @endif
@stop