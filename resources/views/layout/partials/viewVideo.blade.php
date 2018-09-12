@extends('layout.FrontMaster')
@section('body-class')
    body-video
@stop
@section('content')

    <?php /*dd($video) */?>
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
                        myPlayer.persistvolume({namespace: 'httpswwwmultimediapub'});
                        myPlayer.brand({
                            image: "https://www.multimedia.pub/storage/uploads/brand-1-png5ac1674be2ec9.png",
                            title: "MultimediaPub",
                            destination: "https://www.multimedia.pub/",
                            destinationTarget: "_top"
                        });

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

                    <a class="userav" href="https://www.multimedia.pub/u/interact/X0/" title="Interact">
                        <img src="https://i.ytimg.com/vi/Jr4TMIU9oQ4/mqdefault.jpg" data-name="Interact"/>
                    </a>
                    <div class="user-box-txt">
                        <a class="" href="https://www.multimedia.pub/u/interact/X0/" title="Interact">
                            <h3>Interact</h3>
                        </a> <a class="tipS grcreative" href="javascript:void()" title="Premium user"><i
                                    class="material-icons" style="color:#03a9f4"></i> </a>
                        <p> 2 months ago</p>
                    </div>
                    <div class="pull-right">
                        <div class="btn-group"><a class="btn btn-labled social-google-plus subscriber"
                                                  href="javascript:showLogin()"><i class="icon icon-plus"></i>Subscribe
                                <span class="kcounter">1,177</span></a></div>
                    </div>
                </div>
                <div style="clear:both"></div>
            </div>

            <div class="sharing-icos mtop10 odet hide">
                <div class="has-shadow">
                    <div class="text-center text-uppercase full bottom10 top20">
                        <h4>Let your friends enjoy it also!</h4>
                    </div>
                    <div id="jsshare" data-url="https://www.multimedia.pub/play_zXn/"
                         data-title="MaRLo - Enough Echo (Official Music Vide"></div>
                </div>
                <div class="video-share mtop10 has-shadow right20 left20 clearfix">
                    <div class="text-center text-uppercase full bottom20 top20">
                        <h4>Add it to your website</h4>
                    </div>
                    <div class="form-group form-material floating">
                        <div class="input-group">
                        <span class="input-group-addon">
                           <i class="material-icons">&#xE157;</i>
                        </span>
                            <div class="form-control-wrap">
                                <input type="text" name="link-to-this" id="share-this-link" class="form-control"
                                       title="Link back" value="https://www.multimedia.pub/play_zXn/"/>
                                <label class="floating-label">
                                    Link to this </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-material floating">
                        <div class="input-group">
                            <span class="input-group-addon">
                               <i class="material-icons">&#xE911;</i>
                            </span>
                            <div class="form-control-wrap">
                                <div class="row">

                                    <div class="col-md-7">
                                            <textarea style="min-height:80px" id="share-embed-code-small"
                                                      name="embed-this" class="form-control"
                                                      title=" Embed this media on your page"><iframe width="853"
                                                                                                     height="480"
                                                                                                     src="https://www.multimedia.pub/embed/zXn/"
                                                                                                     frameborder="0"
                                                                                                     allowfullscreen></iframe></textarea>
                                        <label class="floating-label"> Embed code</label>
                                        <div class="radio-custom radio-primary"><input type="radio"
                                                                                       name="changeEmbed"
                                                                                       class="styled"
                                                                                       value="1"><label>1920x1080</label>
                                        </div>
                                        <div class="radio-custom radio-primary"><input type="radio"
                                                                                       name="changeEmbed"
                                                                                       class="styled"
                                                                                       value="2"><label>1280x720</label>
                                        </div>
                                        <div class="radio-custom radio-primary"><input type="radio"
                                                                                       name="changeEmbed"
                                                                                       class="styled"
                                                                                       value="3"><label>854x480</label>
                                        </div>
                                        <div class="radio-custom radio-primary"><input type="radio"
                                                                                       name="changeEmbed"
                                                                                       class="styled"
                                                                                       value="4"><label>640x360</label>
                                        </div>
                                        <div class="radio-custom radio-primary"><input type="radio"
                                                                                       name="changeEmbed"
                                                                                       class="styled"
                                                                                       value="5"><label>426x240</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-md-offset-1">
                                        <div class="well">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                                class="material-icons">&#xE86F;</i></span>
                                                    <input type="number" class="form-control" name="CustomWidth"
                                                           id="CustomWidth" placeholder="Custom width">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                                class="material-icons">&#xE883;</i></span>
                                                    <input type="number" name="CustomHeight" id="CustomHeight"
                                                           class="form-control" placeholder="Custom height"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-material floating">
                        <div class="input-group">
                        <span class="input-group-addon">
                           <i class="material-icons">&#xE1B1;</i>
                        </span>
                            <div class="form-control-wrap">
                                <input type="text" name="link-to-this" id="share-this-responsive"
                                       class="form-control" title=" Make the iframe responsive on your website"
                                       value='<script src="https://www.multimedia.pub/lib/vid.js"></script>'/>
                                <label class="floating-label">
                                    Responsive embed </label>
                            </div>
                            <span class="help-block">
							Include this script into your page along with the iframe for a <code>responsive media embed</code>
                        <span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mtop10 oboxed odet">
                <ul id="media-info" class="list-unstyled">
                    <li>

                        <div class="fb-like pull-left" data-href="https://www.multimedia.pub/play_zXn/"
                             data-width="124" data-layout="standard" data-colorscheme="dark" data-action="like"
                             data-show-faces="true" data-share="true"></div>
                    </li>
                    <li>
                        <div id="media-description" data-small="show more" data-big=" show less">
                            {{ isset($video->description) && !empty($video->description) ? $video->description : '' }}
                            <p style="font-weight:500; color:#333">
                                Category : <a href="https://www.multimedia.pub/category_eE/" title="Music">
                                    Music </a>
                            </p>
                            <p> #<a class="right20" href="https://www.multimedia.pub/show/marlo/">marlo</a>#<a
                                        class="right20" href="https://www.multimedia.pub/show/enough/">enough</a>#<a
                                        class="right20" href="https://www.multimedia.pub/show/echo/">echo</a>#<a
                                        class="right20" href="https://www.multimedia.pub/show/official/">official</a>#<a
                                        class="right20" href="https://www.multimedia.pub/show/music/">music</a>#<a
                                        class="right20" href="https://www.multimedia.pub/show/video/">video</a></p>
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
                                 src="https://www.multimedia.pub//storage/uploads/def-avatar.jpg">
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