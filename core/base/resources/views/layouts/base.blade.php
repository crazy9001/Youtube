<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <!-- Apple devices fullscreen -->
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <!-- Apple devices fullscreen -->
    <meta names="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <!-- provide the csrf token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Manage videos</title>
    <link rel="shortcut icon" type="image/ico" href="{{ asset('img/favicon.new.ico') }}" />
    @foreach ($stylesheets as $style)
        {!! HTML::style($style) !!}
    @endforeach

    @foreach ($bodyScripts as $script)
        {!! HTML::script($script) !!}
    @endforeach

    @yield('head')

</head>

<body class="@yield('body-class')">

    @yield('page')

    @include('bases::elements.common')

    @yield('javascript')

</body>

</html>