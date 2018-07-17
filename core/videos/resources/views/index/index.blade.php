@extends('bases::layouts.master')

@section('content')


    <div class="page-header"></div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="{{ route('dashboard.index') }}">Bảng điều khiển</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="{{ route('video.index') }}">Danh sách video</a>
            </li>
        </ul>
    </div>

    <div class="row">

        <div class="col-sm-12">
            <div class="box box-color box-bordered">
                <?php /*dd($filters) */?>
                <div class="box">
                    <div class="box-filter" {!!  isset($filters) && (!empty($filters['channel']) || !empty($filters['status'] || !empty($filters['search']))  ) ? "style='display:block'" : ""  !!}>
                        <div class="filter-item">
                            {!! Form::open(array('route' => 'video.index','method'=>'get','class'=>'form-inline')) !!}
                            <div id="boxFilter">
                                {!! Form::select('channel', ['' => 'Tìm kiếm video theo tên kênh'] + $channels ,isset($filters['channel'])?$filters['channel'] : null, ['id' => 'channelFilter', 'class' => 'chosen-select form-control'])!!}
                                {!! Form::select('status', ['' => 'Trạng thái'] + $statuss, isset($filters['status']) ? $filters['status'] : '', ['id' => 'statusFilter', 'class' => 'chosen-select form-control']) !!}
                                {!! Form::text('search', isset($filters['search']) && !empty($filters['search']) ? $filters['search'] : '' ,array('id' => 'textSearch','placeholder'=>' Tìm kiếm (Enter để search)', 'class' => 'form-control')) !!}
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
                <div class="box-content nopadding portlet light" id="showListVideos">
                    <div class="portlet-title">
                        <div class="caption">
                            <div class="wrapper-action">
                                <div class="btn-group">
                                    <a href="#" data-toggle="dropdown" class="btn dropdown-toggle btn--icon">
                                        Action <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="#">Action 1</a>
                                        </li>
                                        <li>
                                            <a href="#">Action 2</a>
                                        </li>
                                        <li>
                                            <a href="#">Action 3</a>
                                        </li>
                                    </ul>
                                </div>
                                <button class="btn btn-primary btn-show-table-options content-slideUp">Tìm kiếm</button>
                            </div>
                        </div>
                    </div>

                    <table class="table table-bordered" id="list_videos">
                        <thead>
                        <tr>
                            <th></th>
                            <th>{!!$columns['thumbnails']!!}</th>
                            <th>{!!$columns['title']!!}</th>
                            <th>{!!$columns['group_name']!!}</th>
                            <th>{!!$columns['channel_name']!!}</th>
                            <th>{!!$columns['updated_at']!!}</th>
                            <th>{!!$columns['note']!!}</th>
                            <th>{!!$columns['status']!!}</th>
                            <th>{!!$columns['display']!!}</th>
                            <th>{!!$columns['checkbox']!!}</th>
                            {{--<th>{!!$columns['video_id']!!}</th>--}}
                            <th>{!!$columns['id']!!}</th>



                        </tr>
                        </thead>
                        <tbody>
                        @foreach($videos as $key => $video)
                            <tr role="row" class="odd">
                                <td style="width: 10px">{{ $key + 1 }}</td>
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
                                    </div>
                                </td>
                                <td class="gr-video">
                                    {{ isset($video->group_name) && !empty($video->group_name) ? $video->group_name : '' }}
                                </td>
                                <td class="channel-video">
                                    {{ isset($video->channel_name) && !empty($video->channel_name) ? $video->channel_name : '' }}
                                </td>
                                <td class=" lastcheck-video">
                                    {{ isset($video->updated_at) && !empty($video->updated_at) ? $video->updated_at : '' }}
                                </td>
                                <td> Ghi chu</td>
                                <td class="status-video">
                                    @php
                                        $status = $video->status == 1 ?  'Hoạt động' : ( $video->status == 2 ? 'Chặn' : 'Block');
                                        $origin = 'Video status: '. $status;
                                        $origin .= ' ';
                                    @endphp
                                    {{--{!! isset($video->status) && $video->status == 1 ? '<span class="label label-success">Sống</span>' : ($video->status == 3 ? '<span class="label label-danger">Chết</span>' : '<span class="label label-danger">Block</span>')  !!}--}}
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
                                {{--<td class="id-video">
                                    {{ isset($video->video_id) && !empty($video->video_id) ? $video->video_id : '' }}
                                </td>--}}
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

@stop

@section('javascript')

    <script>
        $('#channelFilter').on('change', function(){
            this.form.submit();
        });
        $('#statusFilter').on('change', function(){
            this.form.submit();
        });
        $('#textSearch').keypress(function(event) {
            if (event.keyCode == 13) {
                this.form.submit();
            }
        });

        $(".content-slideUp").click(function(e) {
            e.preventDefault();
            var $el = $(this), filter = $el.parents('.box').find(".box-filter");
            console.log($el);
            filter.slideToggle('fast', function() {
                $el.find("i").toggleClass('icon-angle-up').toggleClass("icon-angle-down");
                if (!$el.find("i").hasClass("icon-angle-up")) {
                    if (filter.hasClass('scrollable')) slimScrollUpdate(filter);
                } else {
                    if (filter.hasClass('scrollable')) destroySlimscroll(filter);
                }
            });
        });

        $("[data-toggle=tooltip]").tooltip();

    </script>

@stop