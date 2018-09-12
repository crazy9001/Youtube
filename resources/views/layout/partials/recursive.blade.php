@forelse($groups as $group)
    @if($group->videos && count($group->videos))
    <h3 class="loop-heading loop-carousel">
        <a href="#" class="name-parent-group">
            {!!  isset($group->parent) && !empty($group->parent->name) ? $group->parent->name : '' !!}
            <a href="#" class="name-children-group">
                {!! isset($group->name) && !empty($group->name) ? '| ' . $group->name : ''  !!}
            </a>
        </a>
    </h3>
    <div class="loop-content">
        <div class="">
            @foreach($group->videos as $video)
                <div id="video-206" class="video">
                    <div class="video-thumb">
                        <a class="clip-link" data-id="206" title="{{ isset($video->title) ? $video->title : '' }}" href="#">
                            <span class="clip">
                                <img src="{{ isset($video->thumbnails) ? $video->thumbnails : '' }}" alt="{{ isset($video->title) ? $video->title : '' }}"/>
                                <span class="vertical-align"></span>
                            </span>
                            <span class="overlay"></span>
                        </a>
                        <span class="timer">04:14</span>
                    </div>
                    <div class="video-data">
                        <h4 class="video-title">
                            <a href="#" title="MUSE - Dig Down [Official Music Video]">{{ isset($video->title) ? $video->title : '' }}</a></h4>
                        <ul class="stats">
                            <li class="uploaderlink">
                                <a href="#" title="Interact">
                                    {{ isset($video->channel) ? $video->channel->name : '' }}
                                </a>
                            </li>
                            <li>{{ isset($video->views) ? $video->views : '0' }} views</li>
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="clearfix"></div>
    @endif
@empty
@endforelse