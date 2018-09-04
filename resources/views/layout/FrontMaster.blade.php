<!doctype html>
<html prefix="og: http://ogp.me/ns#">
<html dir="ltr" lang="en-US">
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8">
    <title>Multimedia.pub</title>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <base href="https://www.multimedia.pub/"/>
    <meta name="description" content="">
    <meta name="generator" content="PHPVibe"/>
    <link rel="alternate" type="application/rss+xml" title="MultimediaPub All Media Feed"
          href="https://www.multimedia.pub/feed/"/>
    <link rel="alternate" type="application/rss+xml" title="MultimediaPub Video Feed"
          href="https://www.multimedia.pub/feed?m=1"/>
    <link rel="alternate" type="application/rss+xml" title="MultimediaPub Music Feed"
          href="https://www.multimedia.pub/feed?m=2"/>
    <link rel="alternate" type="application/rss+xml" title="MultimediaPub Images Feed"
          href="https://www.multimedia.pub/feed?m=3"/>
    <link rel="canonical" href="https://multimedia.pub:443/"/>
    <meta property="og:site_name" content="MultimediaPub"/>
    <meta property="fb:app_id" content="233014957250190"/>
    <meta property="og:url" content="https://multimedia.pub:443/"/>

    <link rel="apple-touch-icon" sizes="180x180" href="https://www.multimedia.pub/lib/favicos/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="https://www.multimedia.pub/lib/favicos/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="https://www.multimedia.pub/lib/favicos/favicon-16x16.png">
    <link rel="manifest" href="https://www.multimedia.pub/lib/favicos/site.webmanifest">
    <link rel="mask-icon" href="https://www.multimedia.pub/lib/favicos/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="https://www.multimedia.pub/lib/favicos/favicon.ico">
    <meta name="msapplication-TileColor" content="#2b5797">
    <meta name="msapplication-config" content="https://www.multimedia.pub/lib/favicos/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/phpvibe.css') }}" media="screen"/>
    <link href="{{ asset('css/bootstrap-2.min.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}"/>
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Material+Icons|Roboto:300,400,500" type="text/css" media="all"/>
    <script type="text/javascript" src="{{ asset('js/jquery-2-2-4.min.js') }}"></script>

    <script>if ((typeof jQuery == "undefined") || !window.jQuery) {
            var script = document.createElement("script");
            script.type = "text/javascript";
            script.src = "https://www.multimedia.pub/tpl/main/styles/js/jquery.js";
            document.getElementsByTagName('head')[0].appendChild(script);
        }
        var acanceltext = "Cancel";
        var startNextVideo, moveToNext, nextPlayUrl;
    </script>

</head>
<body class="body-home">

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

    <script type="text/javascript">
        var site_url = 'https://www.multimedia.pub/';
        var nv_lang = 'Next video starting soon';
        var select2choice = 'Select option';
        var delete_com_text = 'Delete this comment?';
    </script>
    <script src="{{ asset('js/bootstrap.min.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('js/jquery.form.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.imagesloaded.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.infinitescroll.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/js-alert.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.slimscroll.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.emoticons.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.minimalect.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.validarium.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.tagsinput.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jssocials.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.grid-a-licious.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/phpvibe_app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/extravibes.js') }}"></script>
</body>
</html>