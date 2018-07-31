@extends('bases::layouts.master')

@section('content')
    <div id="groups-screen">

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
            <h2>Nhóm Video <a class="label opac5" href="#addVideo" data-toggle="modal">+ add new</a></h2>
        </div>

        <div class="row">

            <div class="col-sm-12">

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
                            <div class="pull-left">
                                {!! Form::open(array('route' => 'group.index', 'method'=>'get','class'=>'form-search-listing form-inline')) !!}
                                <div class="input-append">
                                    {!! Form::text('search', isset($filters['search']) && !empty($filters['search']) ? $filters['search'] : '' ,array('id' => 'form-search-input','placeholder'=>'Nhập tên nhóm', 'class' => 'search-query search-quez input-medium placeholder', 'autocomplete' => 'off', 'style' => 'width:250px !important')) !!}
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

                <div class="box-content nopadding portlet light" id="showListGroups">

                    <table class="table table-bordered" id="list_groups">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên nhóm</th>
                            <th>Tags</th>
                            <th>Ghi chú</th>
                            <th>Display</th>
                            <th>Chọn</th>
                        </tr>
                        </thead>
                        <tbody id="dataGroups">
                            {{--<tr role="row" class="odd" id="group-1">
                                <td style="width: 10px">2</td>
                                <td class="group-name">
                                    Nhạc Hoa
                                </td>
                                <td>Nhạc trung quốc</td>
                                <td>Ghi chú</td>
                                <td>display</td>
                                <td>
                                    <input type="checkbox" data-skin="square" data-color="blue" name="videoSelect[]" value="{{ isset($video->video_id) ? $video->video_id : '' }}">
                                </td>
                            </tr>
                            <tr role="row" class="odd" id="group-2">
                                <td style="width: 10px">1</td>
                                <td class="group-name">
                                    ━ Âu Thần x Hạ Mạt
                                </td>
                                <td>Nhạc trung quốc</td>
                                <td>Ghi chú</td>
                                <td>display</td>
                                <td>
                                    <input type="checkbox" data-skin="square" data-color="blue" name="videoSelect[]" value="{{ isset($video->video_id) ? $video->video_id : '' }}">
                                </td>
                            </tr>--}}
                            {!! $html !!}
                        </tbody>
                    </table>

                </div>

            </div>

        </div>

    </div>


@stop
@section('javascript')
    {{--<script>
        $(document).ready(function () {
            $("#browser").treeview();
        });
    </script>--}}
    <script>
        $(document).ready(function () {
            $("#load").hide();
            $("#submit").click(function () {
                $("#load").show();

                var dataString = {
                    label: $("#label").val(),
                    link: $("#link").val(),
                    id: $("#id").val()
                };

                $.ajax({
                    type: "POST",
                    url: "save_menu.php",
                    data: dataString,
                    dataType: "json",
                    cache: false,
                    success: function (data) {
                        if (data.type == 'add') {
                            $("#menu-id").append(data.menu);
                        } else if (data.type == 'edit') {
                            $('#label_show' + data.id).html(data.label);
                            $('#link_show' + data.id).html(data.link);
                        }
                        $('#label').val('');
                        $('#link').val('');
                        $('#id').val('');
                        $("#load").hide();
                    }, error: function (xhr, status, error) {
                        alert(error);
                    },
                });
            });

            $('.dd').on('change', function () {
                $("#load").show();

                var dataString = {
                    data: $("#nestable-output").val(),
                };

                $.ajax({
                    type: "POST",
                    url: "save.php",
                    data: dataString,
                    cache: false,
                    success: function (data) {
                        $("#load").hide();
                    }, error: function (xhr, status, error) {
                        alert(error);
                    },
                });
            });

            $("#save").click(function () {
                $("#load").show();

                var dataString = {
                    data: $("#nestable-output").val(),
                };

                $.ajax({
                    type: "POST",
                    url: "save.php",
                    data: dataString,
                    cache: false,
                    success: function (data) {
                        $("#load").hide();
                        alert('Data has been saved');

                    }, error: function (xhr, status, error) {
                        alert(error);
                    },
                });
            });


            $(document).on("click", ".del-button", function () {
                var x = confirm('Delete this menu?');
                var id = $(this).attr('id');
                if (x) {
                    $("#load").show();
                    $.ajax({
                        type: "POST",
                        url: "delete.php",
                        data: {id: id},
                        cache: false,
                        success: function (data) {
                            $("#load").hide();
                            $("li[data-id='" + id + "']").remove();
                        }, error: function (xhr, status, error) {
                            alert(error);
                        },
                    });
                }
            });

            $(document).on("click", ".edit-button", function () {
                var id = $(this).attr('id');
                var label = $(this).attr('label');
                var link = $(this).attr('link');
                $("#id").val(id);
                $("#label").val(label);
                $("#link").val(link);
            });

            $(document).on("click", "#reset", function () {
                $('#label').val('');
                $('#link').val('');
                $('#id').val('');
            });

        });

    </script>
@stop