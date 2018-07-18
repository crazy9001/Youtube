@extends('bases::layouts.master')

@section('content')

    <div id="videos-screen">
        <div class="page-header"></div>
        <div class="breadcrumbs">
            <div class="entry-count">
                <ul class="pageControls">
                    <li>
                        <div class="floatL"><strong class="blue">{{ isset($videos) ? number_format($videos->count()) : 0 }}</strong><span>videos</span></div>
                        <div class="blueImg"><div class="pm-sprite ico-videos-small"></div></div>
                    </li>
                </ul><!-- .pageControls -->
            </div>
            <h2>Videos <a class="label opac5" href="#addVideo" onclick="location.href='#addVideo';" data-toggle="modal">+ add new</a></h2>
        </div>

        <div class="row">

            <div class="col-sm-12">
                <div class="box box-color box-bordered">
                    <div class="portlet-title">
                        <div class="row-fluid">
                            <div class="span8">
                                <ul class="pm-inline-filters list-inline">
                                    <li><a href="{{ route('video.index') }}">All videos <span class="count">({{ isset($videos) ? number_format($videos->count()) : 0 }})</span></a></li>
                                    <li><a href="?status=2">Block <span class="count">({{ isset($countBlock) ? number_format($countBlock) : 0 }})</span></a></li>
                                    <li><a href="?status=3">Bị chặn quốc gia <span class="count">({{ isset($countDie) ? number_format($countDie) : 0 }})</span></a> </li>
                                </ul>
                            </div><!-- .span8 -->
                        </div>
                        <div class="clearfix"></div>
                        <div class="row-fluid">
                            <div class="span8">
                                <div class="qsFilter pull-left">
                                    <div class="btn-group input-prepend">
                                        <div class="form-filter-inline">
                                            {!! Form::open(array('route' => 'video.index','method'=>'get','class'=>'form-inline')) !!}
                                            <button type="submit" id="appendedInputButtons" class="btn">Filter</button>
                                            {!! Form::select('channel', ['' => 'Tìm kiếm video theo tên kênh'] + $channels ,isset($filters['channel'])?$filters['channel'] : null, ['id' => 'channelFilter', 'class' => 'chosen-select'])!!}
                                            {!! Form::select('status', ['' => 'Trạng thái'] + $statuss, isset($filters['status']) ? $filters['status'] : '', ['id' => 'statusFilter', 'class' => 'chosen-select last-filter']) !!}
                                            {!! Form::close() !!}
                                        </div><!-- .form-filter-inline -->
                                    </div><!-- .btn-group -->
                                </div><!-- .qsFilter -->

                            </div>
                            <div class="span4">
                                <div class="pull-right">
                                    {!! Form::open(array('route' => 'video.index','method'=>'get','class'=>'form-search-listing form-inline')) !!}
                                    <div class="input-append">
                                        {!! Form::text('search', isset($filters['search']) && !empty($filters['search']) ? $filters['search'] : '' ,array('id' => 'form-search-input','placeholder'=>'Enter keyword', 'class' => 'search-query search-quez input-medium placeholder', 'autocomplete' => 'off')) !!}
                                        {!! Form::select('search_type',  ['video_title' => 'Title', 'uniq_id' => 'Unique ID'], isset($filters['search_type']) ? $filters['search_type'] : '', ['class' => 'input-small']) !!}
                                        <button type="submit" class="btn" id="submitFind">
                                            <i class="icon-search findIcon"></i>
                                            <span class="findLoader"><img src="img/ico-loading.gif" width="16" height="16"></span>
                                        </button>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="box-content nopadding portlet light" id="showListVideos">
                        <table class="table table-bordered" id="list_videos">
                            <thead>
                            <tr>
                                <th></th>
                                <th>{!!$columns['video_id']!!}</th>
                                <th>{!!$columns['thumbnails']!!}</th>
                                <th>{!!$columns['title']!!}</th>
                                <th>{!!$columns['group_name']!!}</th>
                                <th>{!!$columns['channel_name']!!}</th>
                                <th>{!!$columns['updated_at']!!}</th>
                                <th>{!!$columns['note']!!}</th>
                                <th>{!!$columns['status']!!}</th>
                                <th>{!!$columns['display']!!}</th>
                                <th>{!!$columns['checkbox']!!}</th>
                                <th>{!!$columns['id']!!}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($videos as $key => $video)
                                <tr role="row" class="odd">
                                    <td style="width: 10px">{{ $key + 1 }}</td>
                                    <td class="id-video">
                                        {{ isset($video->video_id) && !empty($video->video_id) ? $video->video_id : '' }}
                                    </td>
                                    <td class="img-video">
                                        <a href="http://youtube.com?watch={{ isset($video->video_id) ? $video->video_id : '' }}" target="_blank">
                                            <img src="{{ isset($video->thumbnails) ? $video->thumbnails : '' }}">
                                        </a>
                                    </td>
                                    <td class="title-video">
                                        <a href="http://youtube.com?watch={{ isset($video->video_id) ? $video->video_id : '' }}" target="_blank">
                                            {{ isset($video->title) ? $video->title : '' }}
                                        </a>
                                        <div class="pull-right">
                                            <i class="icon-thumbs-up opac5"></i> <small>{{ isset($video->like_count) ? $video->like_count : 0 }}</small>&nbsp;&nbsp;
                                            <i class="icon-thumbs-down opac5"></i> <small>{{ isset($video->dislike_count) ? $video->dislike_count : 0 }}</small>
                                            <i class="icon-eye-open"></i> <small>{{ isset($video->views) ? $video->views : 0 }}</small>
                                        </div>
                                    </td>
                                    <td class="gr-video">
                                        {{ isset($video->group_name) && !empty($video->group_name) ? $video->group_name : '' }}
                                    </td>
                                    <td class="channel-video">
                                        {{ isset($video->channel_name) && !empty($video->channel_name) ? $video->channel_name : '' }}
                                    </td>
                                    <td class=" lastcheck-video">
                                        {{ isset($video->updated_at) && !empty($video->updated_at) ? \Carbon\Carbon::createFromTimeStamp(strtotime($video->updated_at))->diffForHumans() : '' }}
                                    </td>
                                    <td> Ghi chu</td>
                                    <td class="status-video">
                                        @php
                                            $status = $video->status == 1 ?  'Hoạt động' : ( $video->status == 2 ? 'Chặn' : 'Block');
                                            $origin = 'Video status: '. $status;
                                            $origin .= ' ';
                                        @endphp
                                        <div class="pm-sprite {{ $video->status == 1 ? 'vs_ok' : ( $video->status == 3 ? 'vs_broken' : 'vs_restricted' )  }}"
                                             data-toggle="tooltip" title=""
                                             data-original-title="{{ 'Last checked : ' . \Carbon\Carbon::createFromTimeStamp(strtotime($video->updated_at))->diffForHumans()}} "></div>
                                    </td>
                                    <td class=" status-video">
                                        {!!  isset($video->display) && $video->display == 1 ? '<span class="label label-info">Hiển thị</span>' : '<span class="label label-default">Ẩn</span>'  !!}
                                    </td>
                                    <td class="checkbox-video">
                                        <input type="checkbox" data-skin="square" data-color="blue">
                                    </td>
                                    <td class=" stt-video">{{ $video->id }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    @include('bases::elements.paginate')
                </div>
            </div>

        </div>

    </div>

@stop

@section('javascript')

    <script>
        $("[data-toggle=tooltip]").tooltip();

    </script>

@stop