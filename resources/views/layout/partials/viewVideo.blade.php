@extends('layout.FrontMaster')
@section('body-class')
    body-video
@stop
@section('content')

    <div class="video-holder row">
        <div class="col-md-8 col-xs-12 ">
            <div id="video-content" class="row block">
                <div class="video-player pull-left
                ">
                    <video id="tvideo" class="video-js vjs-default-skin vjs-big-play-centered"
                           controls
                           preload="auto"
                           poster="{{ isset($video->thumbnails) && !empty($video->thumbnails) ? $video->thumbnails  : 'https://img.youtube.com/vi/jYjnQPd33NA/mqdefault.jpg'}}"
                           data-setup='{"controls": true, "autoplay": true, "fluid": true, "aspectRatio": "16:9",   "playbackRates": [0.5, 1, 1.5, 2]}'>
                        <source src="https://www.youtube.com/watch?v={{ isset($video->video_id) && !empty($video->video_id) ? $video->video_id  : 'jYjnQPd33NA' }}" type='video/youtube'/>
                        <p class="vjs-no-js">
                            To view this video please enable JavaScript, and consider upgrading to a web browser that
                            <a href="http://videojs.com/html5-video-support/" target="_blank">supports  HTML5 video</a>
                        </p>
                    </video>
                    <script type="text/javascript">
                        var myPlayer = videojs("#tvideo");
                        myPlayer.videoJsResolutionSwitcher({
                            default: 'high',
                            dynamicLabel: true
                        });
                       /* myPlayer.brand({
                            image: "https://scontent.fhan2-2.fna.fbcdn.net/v/t1.0-1/p160x160/40136622_1913752615584236_6129206961784225792_n.jpg?_nc_cat=0&oh=82fdceb9c2d183aef30d4b3cbab9e4ce&oe=5C2DA3B0",
                            title: "Tới Nguyễn",
                            destination: "https://facebook.com/Spacy2804",
                            destinationTarget: "_top"
                        });*/

                        myPlayer.ready(function () {
                            this.hotkeys({
                                volumeStep: 0.1,
                                seekStep: 5,
                                enableModifiersForNumbers: false
                            });
                            $(".bAd").detach().appendTo(".video-js");
                            $(".plAd").detach().appendTo(".video-js");
                            function resizeVideoJS() {
                                var containerWidth = $('.video-player').width();
                                var videoHeight = Math.round((containerWidth / 16) * 9);
                                myPlayer.width(containerWidth).height(videoHeight);
                            }
                            //resizeVideoJS();
                            window.onresize = resizeVideoJS;
                            myPlayer.on("ended", function () {
                                startNextVideo();
                            });
                        }); </script>
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="rur video-under-right oboxed  pull-right col-md-4 col-xs-12">
            <div class="related video-related top10 related-with-list">
                <ul>
                    <div class="ajaxreqRelated"
                         data-url="relatedvids?videoowner&videoid=71&videomedia=1&videocategory=1">
                        <div class="cp-spinner cp-flip"></div>
                    </div>
                </ul>
            </div>
        </div>

        <div class="video-under col-md-8 col-xs-12">
            <div class="oboxed odet mtop10">
                <div class="row vibe-interactions">
                    <h1>
                        {{ isset($video->title) && !empty($video->title) ? $video->title : '' }}
                    </h1>
                    <div class="addiv">
                        <div class="like-views">
                            {{ isset($video->views) && !empty($video->views) ? $video->views . 'views' : '' }}
                        </div>
                        <div class="interaction-iconvideo-holder rows">
                            <div class="likes-bar">
                                <div class="aaa">
                                    <a href="javascript:iLikeThis(71)" id="i-like-it" class="pv_tip likes"
                                       title=" Like">
                                        <i class="material-icons">&#xE8DC;</i>
                                        <span>1</span>
                                    </a>
                                </div>
                                <div class="aaa ">
                                    <a href="javascript:iHateThis(71)" id="i-dislike-it" class="pv_tip dislikes "
                                       data-toggle="tooltip" data-placement="top" title=" Dislike">
                                        <i class="material-icons">&#xE8DB;</i>
                                        <span> 0</span>
                                    </a>
                                </div>
                                <div class="like-box">
                                    <div class="like-progress">
                                        <div class="likes-success" style="width:
                                        100%;">
                                        </div>
                                        <div class="likes-danger second" style="width:
                                        0%;">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="aaa">
                                <a id="social-share" href="javascript:void(0)" title=" Share or Embed">
                                    <i class="material-icons ico-flipped">&#xE15E;</i>
                                    <span class="hidden-xs"> Share </span>
                                </a>
                            </div>
                            <div class="aaa">
                                <a class="tipS" title=" Report" data-target="#report-it" data-toggle="modal"
                                   href="javascript:void(0)" title=" Report media">
                                    <i class="material-icons">&#xE153;</i>
                                </a>
                            </div>
                        </div>
                        <br style="clear:both">
                    </div>

                </div>
                <div class="clearfix"></div>
            </div>

            <div class="user-container full top20 bottom20">
                <div class="pull-left user-box" style="">

                    <a class="userav" href="#" title="{{ isset($video->channel) ? $video->channel->name : '' }}">
                        <img src="{{ isset($video->channel) ? $video->channel->images : '' }}" data-name="{{ isset($video->channel) ? $video->channel->name : '' }}"/>
                    </a>

                    <div class="user-box-txt">
                        <a class="" href="#" title="Interact">
                            <h3>{{ isset($video->channel) ? $video->channel->name : '' }}</h3>
                        </a> <a class="tipS grcreative" href="javascript:void()" title="Premium user"><i
                                    class="material-icons" style="color:#03a9f4"></i> </a>
                        <p> 2 months ago</p>
                    </div>
                    {{--<div class="pull-right">
                        <div class="btn-group"><a class="btn btn-labled social-google-plus subscriber"
                                                  href="javascript:showLogin()"><i class="icon icon-plus"></i>Subscribe
                                <span class="kcounter">1,177</span></a></div>
                    </div>--}}
                </div>
                <div style="clear:both"></div>
            </div>
            <div class="mtop10 oboxed odet">
                <ul id="media-info" class="list-unstyled">
                    <li>
                        <div class="fb-like pull-left" data-href="#"
                             data-width="124" data-layout="standard" data-colorscheme="dark" data-action="like"
                             data-show-faces="true" data-share="true"></div>
                    </li>
                    <li>
                        <div id="media-description" data-small="show more" data-big=" show less">
                            {{ isset($video->description) && !empty($video->description) ? $video->description : '' }}
                            <p style="font-weight:500; color:#333">
                                Category :
                                <a href="#" title="Music"> Music </a>
                            </p>
                            <p>
                                <a class="right20" href="#">marlo</a>
                            </p>
                        </div>
                    </li>
                </ul>

            </div>
            <div class="clearfix"></div>
            <div class="oboxed related-mobi mtop10 visible-sm visible-xs hidden-md hidden-lg">
                <a id="revealRelated" href="javascript:void(0)">
                        <span class="show_more text-uppercase">
                            show more                        </span>
                    <span class="show_more text-uppercase hide">
                            show less                        </span>
                </a>
            </div>
            <div class="clearfix"></div>
            <div class="oboxed ocoms mtop10">
                <div id="video_71" class="emComments" object="video_71" class="ignorejsloader">
                    <ul id="emContent_video_71-0" class="comments full">
                        <div class="cctotal">0 Comments and 0 replies</div>
                        <li id="reply-video_71-0" class="addcm ">
                            <img class="avatar" data-name="Guest"
                                 src="https://yt3.ggpht.com/-k8cNWPkMl4Q/AAAAAAAAAAI/AAAAAAAAAAA/JZb2iDka-mA/s48-c-k-no-mo-rj-c0xffffff/photo.jpg">
                            <div class="message clearfix">
                                <div class="arrow">
                                    <div class="arrow-inner"></div>
                                    <div class="arrow-outer"></div>
                                </div>
                                <form class="body" method="post" onsubmit="return false;">
                                        <textarea placeholder="Register or login to leave your impressions."
                                                  id="addDisable" class="addEmComment auto" name="comment"/></textarea>
                                </form>
                            </div>
                        </li>
                        <div id="NoMore" class="NoMore"></div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

@stop