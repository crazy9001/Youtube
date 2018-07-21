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
            <h2>Videos <a class="label opac5" href="#addVideo" onclick="location.href='#addVideo';" data-toggle="modal">+ add new</a></h2>
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
                                        <a href="http://youtube.com?watch={{ isset($video->video_id) ? $video->video_id : '' }}" target="_blank">
                                            <img src="{{ isset($video->thumbnails) ? $video->thumbnails : '' }}">
                                        </a>
                                    </td>
                                    <td class="title-video">
                                        <a href="http://youtube.com?watch={{ isset($video->video_id) ? $video->video_id : '' }}" target="_blank">
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
                                        {{ isset($video->updated_at) && !empty($video->updated_at) ? \Carbon\Carbon::createFromTimeStamp(strtotime($video->updated_at))->diffForHumans() : '' }}
                                    </td>
                                    <td> Ghi chu</td>
                                    <td class="status-video" id="status-video">
                                        @php
                                            $status = $video->status == 1 ?  'Hoạt động' : ( $video->status == 2 ? 'Chặn' : 'Block');
                                            $origin = 'Video status: '. $status;
                                            $origin .= ' ';
                                        @endphp
                                        <div class="pm-sprite {{ $video->status == 1 ? 'vs_ok' : ( $video->status == 3 ? 'vs_broken' : 'vs_broken' )  }}"
                                             rel="tooltip" title=""
                                             data-original-title="{{ 'Last checked : ' . \Carbon\Carbon::createFromTimeStamp(strtotime($video->updated_at))->diffForHumans()}} ">
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
            <small>Di chuyển các video đã chọn đến</small>
            <div class="input-append">
                <select name="move_to_category" id="" class="inline smaller-select">
                    <option value="-1" selected="selected">Nhóm...</option>
                    <option value="5"> Cars</option>
                    <option value="6">&nbsp;&nbsp;&nbsp; Car Reviews</option>
                    <option value="7"> Comedy</option>
                    <option value="10"> Courses</option>
                    <option value="11">&nbsp;&nbsp;&nbsp; Business</option>
                    <option value="12">&nbsp;&nbsp;&nbsp; Marketing</option>
                    <option value="8"> Gaming</option>
                    <option value="9"> Entertainment</option>
                    <option value="18">&nbsp;&nbsp;&nbsp; Movie Trailers</option>
                    <option value="17"> Fashion</option>
                    <option value="1"> Film &amp; animation</option>
                    <option value="2">&nbsp;&nbsp;&nbsp; Stop motion</option>
                    <option value="19"> Music</option>
                    <option value="13"> Science &amp; Technology</option>
                    <option value="14"> Sports</option>
                    <option value="15"> Travel &amp; Events</option>
                    <option value="16"> Nonprofit &amp; Activism</option>
                </select>
                <button type="submit" name="Submit" value="Move" data-loading-text="Moving..." class="btn-small" rel="tooltip" data-original-title="Video sẽ được chuyển sang nhóm đã chọn">Move</button>

            </div>
        </div>
        <div class="btn-toolbar pull-right">
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

    </script>

@stop