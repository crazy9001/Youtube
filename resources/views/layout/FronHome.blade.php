@extends('layout.FrontMaster')
@section('body-class')
    body-home
@stop
@section('content')
    <div id="home-content" class="main-holder col-md-12">

        @include('layout.FrontAds')
        @forelse($groups as $group)
            @if($group->videos && count($group->videos))
                <h3 class="loop-heading loop-carousel">
                    <a href="#" class="name-parent-group">
                        {!!  isset($group->name) && !empty($group->name) ? $group->name : '' !!}
                    </a>
                    @forelse($group->children as $children)
                        <a href="#" class="name-children-group">
                            {!! isset($children->name) && !empty($children->name) ? '| ' . $children->name : ''  !!}
                        </a>
                    @empty
                    @endforelse
                </h3>
                <div class="loop-content">
                    <div class="">
                        @forelse($group->videos as $video)
                            <div id="video-206" class="video">
                                <div class="video-thumb">
                                    <a class="clip-link" data-id="206" title="{{ isset($video->title) ? $video->title : '' }}" href="{{ route('view.video') . '?v=' . $video->video_id }}">
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
                                        <a href="{{ route('view.video') . '?v=' . $video->video_id }}" title="{{ isset($video->title) ? $video->title : '' }}">{{ isset($video->title) ? $video->title : '' }}</a></h4>
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
                        @empty
                        @endforelse
                    </div>
                </div>
                <div class="clearfix"></div>
            @else
                @include('layout.partials.recursive', ['groups'  =>  $group->children])
            @endif
        @empty
        @endforelse
    </div>
@stop