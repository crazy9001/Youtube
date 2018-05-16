<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <!-- Apple devices fullscreen -->
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <!-- Apple devices fullscreen -->
    <meta names="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

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