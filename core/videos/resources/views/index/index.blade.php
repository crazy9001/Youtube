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


                    <select id="statusFilter">
                        <option value="">All Status</option>
                        <option value="UC0jDoh3tVXCaqJ6oTve8ebA">Channel 1</option>
                        <option value="UCQGd-eIAxQV7zMvTT4UmjZA">Channel 2</option>
                    </select>

                    <table class="table table-bordered dataTable-scroll-x" id="list_videos">
                        <thead>
                        <tr>
                            <th style="width: 50px"></th>
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
            var dtListUsers = $('#list_videos').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{route('list.videos')}}",
                "columns": [
                    { "data": "thumbnails", render: getImg, },
                    { "data": "title" },
                    { "data": "channelId" },
                    { "data": "group_id" },
                    { "data": "video_id" },
                ],
                "scrollY": '60vh',
            });


            $('#statusFilter').on('change', function(){
                var filter_value = $(this).val();
                var new_url = "{{route('list.videos')}}" + '?channel=' + filter_value;

                dtListUsers.ajax.url(new_url).load();
            });

        });

        /**
         *
         * @param data
         * @param type
         * @param full
         * @param meta
         * @returns {string}
         */
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