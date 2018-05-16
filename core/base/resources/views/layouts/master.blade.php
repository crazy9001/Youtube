@extends('bases::layouts.base')

@section ('page')


    <?php
        $userName = '';
        $createdDate = '';
        if (Sentinel::check()) {
            $user = Sentinel::getUser();
            $userName = (isset($user->first_name) && !empty($user->first_name) ? $user->first_name : '') . ' ' . (isset($user->last_name) && !empty($user->last_name) ? $user->last_name : '');
        }
    ?>

    @include('bases::partials.navigation')

    @include('bases::partials.left')

    <div id="main">

        <div class="container-fluid">

            @yield('content')

        </div>

    </div>

@stop