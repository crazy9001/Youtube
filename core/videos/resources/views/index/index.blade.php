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
                <div class="box-title">
                    <h3>
                        <i class="fa fa-table"></i>
                        Quản lí video
                    </h3>
                </div>
                <div class="box-content nopadding" id="showListVideos">

                    {!! Form::open(array('route' => 'video.index','method'=>'get','class'=>'form-inline')) !!}
                        <div id="boxFilter">
                            {!! Form::select('channel', ['' => 'Tìm kiếm video theo tên kênh'] + $channels ,isset($filters['channel'])?$filters['channel'] : null, ['id' => 'channelFilter'])!!}
                            {!! Form::select('status', ['' => 'Trạng thái'] + $statuss, isset($filters['status']) ? $filters['status'] : '', ['id' => 'statusFilter']) !!}
                            {!! Form::text('search', isset($filters['search']) && !empty($filters['search']) ? $filters['search'] : '' ,array('id' => 'textSearch','placeholder'=>' Tìm kiếm (Enter để search)')) !!}
                        </div>
                    {!! Form::close() !!}
                    <table class="table table-bordered" id="list_videos">
                        <thead>
                        <tr>
                            <th>{!!$columns['stt']!!}</th>
                            <th>{!!$columns['thumbnails']!!}</th>
                            <th>{!!$columns['title']!!}</th>
                            <th>{!!$columns['video_id']!!}</th>
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
                                <td class="stt-video">{{ $key + 1 }}</td>
                                <td class="img-video">
                                    <img src="{{ isset($video->thumbnails) ? $video->thumbnails : '' }}">
                                </td>
                                <td class="title-video">
                                    <a href="http://youtube.com?watch={{ isset($video->video_id) ? $video->video_id : '' }}" target="_blank">
                                        {{ isset($video->title) ? $video->title : '' }}
                                    </a>
                                </td>
                                <td class="id-video">
                                    {{ isset($video->video_id) && !empty($video->video_id) ? $video->video_id : '' }}
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
                                <td></td>
                                <td class=" status-video">
                                    {{ isset($video->status) && $video->status == 1 ? 'Hoạt động' : 'Block' }}
                                </td>
                                <td class=" status-video">
                                    {{ isset($video->display) && $video->display == 1 ? 'Hiển thị' : 'Ản' }}
                                </td>
                                <td class=" checkbox-video"><input type="checkbox"></td>
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
    </script>

@stop