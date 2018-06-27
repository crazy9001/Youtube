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
                <div class="box-content nopadding">
                    <table class="table table-bordered dataTable-scroll-x" id="list_videos">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Tiêu đề</th>
                            <th>ID Channel</th>
                            <th>Nhóm</th>
                            <th>ID</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

@stop

@section('javascript')

    <script>

        $(document).ready(function() {

            $('#list_videos').DataTable( {
                "ajax": "{{route('list.videos')}}",
                "columns": [
                    { "data": "thumbnails", render: getImg },
                    { "data": "title" },
                    { "data": "channelId" },
                    { "data": "group_id" },
                    { "data": "video_id" },
                ],
                "scrollY": '60vh',
            } );
        });

        function getImg(data, type, full, meta) {
            var orderType = data.OrderType;
            if (orderType === 'Surplus') {
                return '<img src="' + data + '" />';
            } else {
                return '<img src="' + data + '" />';
            }
        }

    </script>

@stop