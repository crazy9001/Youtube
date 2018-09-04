<div class="fixed-top">
    <div class="row block" style="position:relative;">
        <div class="logo-wrapper"><a id="show-sidebar" href="javascript:void(0)" title="Show sidebar"><i
                        class="material-icons">&#xE5D2;</i></a><a href="https://www.multimedia.pub/" title=""
                                                                  class="logo"><img
                        src="https://www.multimedia.pub/storage/uploads/mpb-jpg5a9c474203891.jpg"/></a><br
                    style="clear:both;"/>
        </div>
        <div class="header">
            <div class="searchWidget">
                <form action="" method="get" id="searchform"
                      onsubmit="location.href='https://www.multimedia.pub/show/' + encodeURIComponent(this.tag.value).replace(/%20/g, '+') + '?type=' + encodeURIComponent(this.component.value).replace(/%20/g, '+'); return false;"
                      autocomplete="off">
                    <div class="search-holder">
                        <span class="search-button">
                            <button type="submit"><i class="material-icons">&#xE8B6;</i></button>
                        </span>
                        <div class="search-target">
                            <a id="switch-search" class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false" data-animation="scale-up" role="button">
                                <i class="icon material-icons">&#xE63A;</i>
                            </a>
                            <input type="text" id="switch-com" class="hide" name="component" value="video">
                            <ul class="dropdown-menu dropdown-left bullet" role="menu">
                                <li role="presentation"><a id="s-video" href="javascript:SearchSwitch('video')"><i
                                                class="icon material-icons">&#xE63A;</i>Videos and Music</a></li>
                                <li role="presentation"><a id="s-picture" href="javascript:SearchSwitch('picture')"><i
                                                class="icon material-icons">&#xE43B;</i>Pictures</a></li>
                                <li role="presentation"><a id="s-channel" href="javascript:SearchSwitch('channel')"><i
                                                class="icon material-icons">&#xE55A;</i>Channels</a></li>
                                <li role="presentation"><a id="s-playlist" href="javascript:SearchSwitch('playlist')"><i
                                                class="icon material-icons">&#xE05F;</i>Playlists</a></li>
                            </ul>
                        </div>
                        <div class="form-control-wrap"><input type="text" class="form-control input-lg empty" name="tag"
                                                              value="" placeholder="Tìm kiếm"></div>
                    </div>
                </form>
                <div id="suggest-results"></div>
            </div>
            <div class="user-quick"><a data-target="#search-now" data-toggle="modal" href="javascript:void(0)"
                                       class="top-link" id="show-search"><i class="material-icons">search</i></a><a
                        id="uploadNow" data-target="#login-now" data-toggle="modal" href="javascript:void(0)"
                        class="top-link" title="Login to upload"><i class="material-icons">file_upload</i> </a> <a
                        id="openusr" class="btn uav btn-small no-user" href="javascript:showLogin()"
                        data-animation="scale-up" role="button" title="Login"><img class="NoAvatar" data-name="Guest"
                                                                                   src=""/> </a></div>
        </div>
    </div>
</div>