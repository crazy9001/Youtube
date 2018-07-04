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

                    <div id="boxFilter">
                        {!! Form::select('channel', ['Tìm kiếm video theo tên kênh'] + $channels, '', ['id' => 'channelFilter']) !!}
                        {!! Form::select('status', $status, '', ['id' => 'statusFilter']) !!}
                    </div>
                    <table class="table table-bordered dataTable-scroll-x" id="list_videos">
                        <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>Tên video</th>
                            <th>Nhóm</th>
                            <th>Kênh</th>
                            <th>Last check</th>
                            <th>Ghi chú</th>
                            <th>Tình trạng</th>
                            <th>Display</th>
                            <th>Checkbox</th>
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
                    { className: 'stt-video', "data" : 'id' },
                    { "data": "thumbnails", render: getImg, },
                    { className: 'title-video', "data": "title" },
                    { "data":  function (data){
                            if (data.group){
                                render: renderLink(data.group);
                            }
                            return '';
                        }, "orderable": "false"
                    },
                    { className: "channel-video","data": "channel.name" },
                    { className: 'lastcheck-video', "data" : 'updated_at'},
                    { "data" : 'note'},
                    { className: 'status-video', "data" :  function (data) {
                            return data.status == 1 ? 'Hoạt động' : 'Block'
                        }, "orderable": "false"
                    },
                    { className: 'status-video', "data" : function (data) {
                            return data.display == 1 ? 'Hiển thị' : 'Ẩn'
                        }, "orderable": "false"
                    },
                    { className: 'checkbox-video', "data" : function(){
                            return renderCheckbox;
                        }, "orderable": "false"
                    },
                    { className: 'stt-video', "data": "id" },
                ],
                "scrollY": '60vh',
            });


            $('#channelFilter').on('change', function(){
                var status_value= $('#statusFilter').val();
                var channel_value = $(this).val();
                var new_url = "{{route('list.videos')}}" + '?channel=' + channel_value + '&status=' + status_value;
                //alert(new_url);
                dtListUsers.ajax.url(new_url).load();
            });
            $('#statusFilter').on('change', function(){
                var status_value= $(this).val();
                var channel_value = $('#channelFilter').val();
                var new_url = "{{route('list.videos')}}" + '?channel=' + channel_value + '&status=' + status_value;
                //alert(new_url);
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
        
        function renderCheckbox() {
            return '<input type="checkbox">'
        }
        /**
         *
         * @param data
         * @returns {string}
         */
        function renderLink(data)
        {
            return '<a href="' + data.slug + '">' + data.slug + '</a>'
        }

    </script>

@stop