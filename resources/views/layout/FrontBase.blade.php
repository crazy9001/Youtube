<!doctype html>
<html prefix="og: http://ogp.me/ns#">
<html dir="ltr" lang="en-US">
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8">
    <title>Youtube</title>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <base href="http://localhost:8000/"/>
    <meta name="description" content="">
    <meta name="generator" content="PHPVibe"/>
    <meta property="og:site_name" content="MultimediaPub"/>
    <meta property="fb:app_id" content="233014957250190"/>
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
    <link rel="stylesheet" href="https://www.multimedia.pub/lib/players/ads.jplayer.css"/>
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Material+Icons|Roboto:300,400,500" type="text/css" media="all"/>
    <script type="text/javascript" src="{{ asset('js/jquery-2-2-4.min.js') }}"></script>

    <script>
        if ((typeof jQuery == "undefined") || !window.jQuery) {
            var script = document.createElement("script");
            script.type = "text/javascript";
            script.src = "https://www.multimedia.pub/tpl/main/styles/js/jquery.js";
            document.getElementsByTagName('head')[0].appendChild(script);
        }
        var acanceltext = "Cancel";
        var startNextVideo, moveToNext, nextPlayUrl;
    </script>

    <script type="text/javascript" src="https://www.multimedia.pub/lib/players/jwplayer/jwplayer.js"></script>
    <script type="text/javascript">jwplayer.key = "gWUocJ//T//iYLr843MXTLwOfu2dM158DD/nLg==";</script>
    <link rel="stylesheet" href="https://www.multimedia.pub/lib/players/vjs/video-js.css"/>
    <script src="https://www.multimedia.pub/lib/players/vjs/video.js"></script>
    <script src="https://www.multimedia.pub/lib/players/vjs/plugins/hd.js"></script>
    <script src="https://www.multimedia.pub/lib/players/vjs/plugins/youtube.js"></script>

</head>
<body class="@yield('body-class')">

@yield('page')


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