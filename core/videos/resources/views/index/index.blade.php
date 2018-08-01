@extends('bases::layouts.master')

@section('content')

    <div id="videos-screen">
        <div class="page-header"></div>
        <div class="breadcrumbs">
            <div class="entry-count">
                <ul class="pageControls">
                    <li>
                        <div class="floatL"><strong class="blue">{{ isset($countTotalVideo) ? number_format($countTotalVideo) : 0 }}</strong><span>videos</span></div>
                        <div class="blueImg"><div class="pm-sprite ico-videos-small"></div></div>
                    </li>
                </ul><!-- .pageControls -->
            </div>
            <h2>
                Videos <a class="label opac5" href="#createNewVideo" data-toggle="modal">+ add new</a>
                {{--<a href="#modal-1" role="button" class="label opac5" data-toggle="modal">Open Modal</a>--}}
            </h2>
        </div>

        <div class="row">

            <div class="col-sm-12">
                <div class="box box-color box-bordered">
                    <div class="portlet-title">
                        <div class="row-fluid">
                            <div class="span8">
                                <ul class="pm-inline-filters list-inline">
                                    <li><a href="{{ route('video.index') }}">All videos <span class="count">({{ isset($countTotalVideo) ? number_format($countTotalVideo) : 0 }})</span></a></li>
                                    <li><a href="?status=2">Bị chặn quốc gia <span class="count">({{ isset($countBlock) ? number_format($countBlock) : 0 }})</span></a></li>
                                    <li><a href="?status=3">Chết <span class="count">({{ isset($countDie) ? number_format($countDie) : 0 }})</span></a> </li>
                                </ul>
                            </div><!-- .span8 -->
                        </div>
                        <div class="clearfix"></div>
                        <div class="row-fluid">
                            <div class="span8">
                                <div class="qsFilter pull-right">
                                    <div class="btn-group input-prepend">
                                        <div class="form-filter-inline">
                                            {!! Form::open(array('route' => 'video.index','method'=>'get','class'=>'form-inline')) !!}
                                            {!! Form::select('channel', ['' => 'Tìm kiếm video theo tên kênh'] + $channels ,isset($filters['channel'])?$filters['channel'] : null, ['id' => 'channelFilter', 'class' => 'chosen-select', 'style' => 'border-left: 1px solid #ccc !important'])!!}
                                            {!! Form::select('status', ['' => 'Trạng thái'] + $statuss, isset($filters['status']) ? $filters['status'] : '', ['id' => 'statusFilter', 'class' => 'chosen-select']) !!}
                                            {!! Form::select('display', ['' => 'Display'] + ['1' => 'Hiển thị', '2' => 'Ẩn'], isset($filters['display']) ? $filters['display'] : '', ['id' => 'displayFilter', 'class' => 'chosen-select']) !!}
                                            <button type="submit" id="appendedInputButtons" class="btn" style="border: 1px solid #ccc; border-radius: 0px !important;">Filter</button>
                                            {!! Form::close() !!}
                                        </div><!-- .form-filter-inline -->
                                    </div><!-- .btn-group -->
                                </div><!-- .qsFilter -->

                            </div>
                            <div class="span4">
                                <div class="pull-left">
                                    {!! Form::open(array('route' => 'video.index','method'=>'get','class'=>'form-search-listing form-inline')) !!}
                                    <div class="input-append">
                                        {!! Form::text('search', isset($filters['search']) && !empty($filters['search']) ? $filters['search'] : '' ,array('id' => 'form-search-input','placeholder'=>'Enter keyword', 'class' => 'search-query search-quez input-medium placeholder', 'autocomplete' => 'off')) !!}
                                        {!! Form::select('search_type',  ['video_title' => 'Title', 'uniq_id' => 'Unique ID'], isset($filters['search_type']) ? $filters['search_type'] : '', ['class' => 'input-small']) !!}
                                        <button type="submit" class="btn" id="submitFind">
                                            <i class="icon-search findIcon"></i>
                                        </button>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="box-content nopadding portlet light" id="showListVideos">
                        @include('bases::elements.paginate')
                        <div class="clearfix"></div>
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
                            <tbody id="dataVideos">
                            @foreach($videos as $key => $video)
                                <tr role="row" class="odd" id="video-{{ $video->video_id ?  $video->video_id : ''  }}">
                                    <td style="width: 10px">{{ $key + 1 }}</td>
                                    <td class="id-video">
                                        {{ isset($video->video_id) && !empty($video->video_id) ? $video->video_id : '' }}
                                    </td>
                                    <td class="img-video">
                                        <a href="http://youtube.com/watch?v={{ isset($video->video_id) ? $video->video_id : '' }}" target="_blank">
                                            <img src="{{ isset($video->thumbnails) ? $video->thumbnails : '' }}">
                                        </a>
                                    </td>
                                    <td class="title-video">
                                        <a href="{{ route('video.edit', isset($video->video_id) ? $video->video_id : '')   }}">
                                            {{ isset($video->title) ? $video->title : '' }}
                                        </a>
                                        <div class="pull-right">
                                            <i class="icon-eye-open"></i> <small>{{ isset($video->views) ? $video->views : 0 }}</small>
                                        </div>
                                    </td>
                                    <td class="gr-video" id="group-video">
                                        <ul>
                                            {!! isset($video->group->parent->name) ? '<li>
                                               <a href="?group='. $video->group->parent->id .'">'. $video->group->parent->name .'</a>
                                                <i class="fa fa-angle-right"></i>
                                            </li>' : '' !!}

                                            {!! $video->group ? '<li>
                                               <a href="?group='. $video->group->id .'">'. $video->group->name .'</a>
                                            </li>' : ''  !!}
                                        </ul>
                                    </td>
                                    <td class="channel-video">
                                        {{ isset($video->channel) && !empty($video->channel) ? $video->channel->name : '' }}
                                    </td>
                                    <td class=" lastcheck-video">
                                        @php
                                            \Carbon\Carbon::setLocale('vi');
                                        @endphp
                                        {{ isset($video->last_check) && !empty($video->last_check) ? \Carbon\Carbon::createFromTimeStamp(strtotime($video->last_check))->diffForHumans() : '' }}
                                    </td>
                                    <td style="width: 200px">
                                        {{ isset($video->note) && !empty($video->note) ? $video->note : '' }}
                                    </td>
                                    <td class="status-video" id="status-video">
                                        @php
                                            $status = $video->status == 1 ?  'Hoạt động' : ( $video->status == 2 ? 'Chặn' : 'Block');
                                            $origin = 'Video status: '. $status;
                                            $origin .= ' ';
                                        @endphp
                                        <div class="pm-sprite {{ $video->status == 1 ? 'vs_ok' : ( $video->status == 3 ? 'vs_broken' : 'vs_broken' )  }}"
                                             rel="tooltip" title=""
                                             data-original-title="{{ 'Last checked : ' . isset($video->last_check) && !empty($video->last_check) ? \Carbon\Carbon::createFromTimeStamp(strtotime($video->last_check))->diffForHumans() : '' }} ">
                                        </div>
                                        <span style="display: none">
                                            <img src="../img/ico-loading.gif"  style=" width: 16px !important; height:  16px; border:  none">
                                        </span>
                                    </td>
                                    <td class="status-video">
                                        {!!  isset($video->display) && $video->display == 1 ? '<span class="label label-info">Hiển thị</span>' : '<span class="label label-default">Ẩn</span>'  !!}
                                    </td>
                                    <td class="checkbox-video">
                                        <input type="checkbox" data-skin="square" data-color="blue" name="videoSelect[]" value="{{ isset($video->video_id) ? $video->video_id : '' }}">
                                    </td>
                                    <td class=" stt-video">{{ $video->id }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @include('bases::elements.paginate')
                    </div>
                </div>
            </div>

        </div>

    </div>
    <div class="clearfix"></div>

    <div id="stack-controls" class="list-controls scroll-to-fixed-fixed">
        <div class="pull-left form-inline" style="padding-top: 8px;">
            <small class="alert-info" style="padding: 3px 5px; font-weight: bold">Di chuyển các video đã chọn đến nhóm</small>
            <div class="input-append">
                {!! Form::open(array('route' => 'video.move.group', 'class'=>'form-inline')) !!}
                    {!! $groupsNested !!}
                    <a data-loading-text="Moving..." class="btn btn-small btn-success btn-strong" style="padding-top: 0px" id="move_to_group">
                        Move
                    </a>
                {!! Form::close() !!}
            </div>
        </div>
        <div class="btn-toolbar pull-right" style=" padding-top: 5px">
            <div class="btn-group">
                <button type="submit" name="VideoChecker" id="VideoChecker" value="Check status" class="btn btn-small btn-success btn-strong">
                    Check status
                </button>
            </div>
            <div class="btn-group dropup">
                <button name="Submit" value="Trash selected" class="btn btn-small btn-danger btn-strong" id="trashVideoSelected">Delete</button>
            </div>
            <input type="hidden" name="filter" id="listing-filter" value="added">
            <input type="hidden" name="fv" id="listing-filter_value" value="desc">
        </div>
    </div>


    <div id="createNewVideo" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 id="myModalLabel">Add Video</h3>
                </div>
                <!-- /.modal-header -->
                <div class="modal-body" style="padding: 0px">
                    <form action="#" method="POST" class='form-horizontal form-bordered'>
                        <div class="form-group">
                            <label for="textfield" class="control-label col-sm-2" style="text-align: center">
                                <div class="pm-sprite ico-add-link"></div>
                            </label>
                            <div class="col-sm-10">
                                <input type="text" name="link_video" id="link_video" placeholder="Http://" class="form-control">
                                <span class="label label-info">Nhập link youtube . Ví dụ: https://www.youtube.com/watch?v=8_9gQZmbsr4</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="textfield" class="control-label col-sm-2" style="text-align: center">
                                <div class="pm-sprite ico-add-local"></div>
                            </label>
                            <div class="col-sm-10">
                                {!! Form::select('channel', ['' => 'Chọn kênh video'] + $channels ,isset($filters['channel'])?$filters['channel'] : null, ['id' => 'channelVideoAdd', 'class' => 'form-control', 'style' => 'border-left: 1px solid #ccc !important'])!!}
                                <span class="label label-info">Chọn kênh cho video</span>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.modal-body -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-add-new-video">Add</button>
                </div>
                <!-- /.modal-footer -->
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@stop

@section('javascript')

    <script>
        $("[rel=tooltip]").tooltip();
        var checkboxes = $('#dataVideos').find(':checkbox');
        $('#select_all_video').change(function() {
            checkboxes.prop('checked', $(this).is(':checked'));
        });

        var btnCheckVideo = $('#VideoChecker');
        var btnTrashVideo = $('#trashVideoSelected');
        var btnMovieVideo = $('#move_to_group');
        var btnAddVideo = $('.btn-add-new-video');

        btnCheckVideo.on('click', function ()  {
            var listVideoChecked = [];
            $(':checkbox:checked').each(function(i){
                listVideoChecked[i] = $(this).val();
            });
            var btnSelectAll = 'on';
            listVideoChecked = jQuery.grep(listVideoChecked, function(value) {
                return value != btnSelectAll;
            });
            $.each(listVideoChecked, function( index, value ) {
                var loadingComponent = '';
                var statusVideoComponent = ''
                $('tr#video-'+value).each(function(){
                    statusVideoComponent = $(this).find('td#status-video div');
                    loadingComponent = $(this).find('td#status-video span')
                });
                $.ajax({
                    type: "POST",
                    url: "{{ route('video.check') }}",
                    data: { video : value },
                    success: function(result){
                        loadingComponent.hide();
                        statusVideoComponent.show();
                        if(result.success == true){
                            if(result.data.status == 1){
                                statusVideoComponent.addClass('vs_ok')
                            }else{
                                statusVideoComponent.addClass('vs_broken')
                            }
                        }
                    },
                    beforeSend: function(){
                        statusVideoComponent.hide();
                        loadingComponent.show();
                    },
                    error:function (xhr, ajaxOptions, thrownError){
                        xhr = jQuery.parseJSON(xhr.responseText);
                        Youtube.showNotice('error', xhr.data, xhr.message);
                    },
                });
            });
        });

        btnTrashVideo.on('click', function () {
            var listVideoChecked = [];
            $(':checkbox:checked').each(function(i){
                listVideoChecked[i] = $(this).val();
            });
            var btnSelectAll = 'on';
            listVideoChecked = jQuery.grep(listVideoChecked, function(value) {
                return value != btnSelectAll;
            });
            $.each(listVideoChecked, function( index, value ) {
                var videoTrashComponents = $('tr#video-'+value);
                $.ajax({
                    type: "POST",
                    url: "{{ route('video.delete') }}",
                    data: { video : value },
                    success: function(result){

                    },
                    beforeSend: function(){
                        videoTrashComponents.fadeOut();
                    },
                    error:function (xhr, ajaxOptions, thrownError){

                    },
                });

            });

        });

        btnMovieVideo.on('click', function () {
            var listVideoChecked = [];
            $(':checkbox:checked').each(function(i){
                listVideoChecked[i] = $(this).val();
            });
            var btnSelectAll = 'on';
            listVideoChecked = jQuery.grep(listVideoChecked, function(value) {
                return value != btnSelectAll;
            });
            var groupId = $(this).closest("form").find("select[name='move_to_group']").val();
            $.each(listVideoChecked, function( index, value ) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('video.move.group') }}",
                    data: { video : value, group: groupId },
                    success: function(result){
                        if(result.success == true){
                            Youtube.showNotice('success', result.message, Youtube.languages.notices_msg.success);
                        }
                    },
                    beforeSend: function(){

                    },
                    error:function (xhr, ajaxOptions, thrownError){
                        xhr = jQuery.parseJSON(xhr.responseText);
                        Youtube.showNotice('error', xhr.data, xhr.message);
                    },
                });
            });
            window.setTimeout(function(){location.reload()}, 3000)
        });

        btnAddVideo.on('click', function () {
            var link = $("input[name=link_video]").val();
            var channel = $("select#channelVideoAdd option").filter(":selected").val();
            $.ajax({
                type: "POST",
                url: "{{ route('video.create') }}",
                data: { link : link, channel : channel },
                success: function(result){
                    if(result.success == true){
                        Youtube.showNotice('success', result.message, Youtube.languages.notices_msg.success);
                        $('#createNewVideo').modal('hide')
                        $("input[name=link_video]").val('');
                    }
                },
                beforeSend: function(){

                },
                error:function (xhr, ajaxOptions, thrownError){
                    xhr = jQuery.parseJSON(xhr.responseText);
                    Youtube.showNotice('error', xhr.data, xhr.message);
                },
            });
        });

    </script>

@stop