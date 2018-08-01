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
                <a href="{{ route('channel.index') }}">Danh sách kênh</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="box box-bordered box-color box-list-data">

                <div class="box-content nopadding">

                    <div class="tab-content">
                        <div class="tab-pane active" id="inbox">
                            <div class="highlight-toolbar">
                                <div class="pull-left">
                                    <div class="btn-toolbar">
                                        <div class="btn-group">
                                            <a href="#modal_add_channel" role="button" data-toggle="modal" class="btn btn-danger" data-placement="bottom" data-original-title="Thêm mới">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                        </div>

                                        <div class="btn-group">
                                            <span class="btn btn-default">
                                                <input type="checkbox" id="select_all_channel" class='' data-skin="minimal" data-color="blue" style="margin: 0">
                                            </span>
                                        </div>

                                        <div class="btn-group">
                                            <a href="#" id="deleteButton" class="btn" rel="tooltip" data-placement="bottom" title="" data-original-title="Delete">
                                                <i class="fa fa-trash-o"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-striped table-nomargin table-mail">
                                <thead>
                                <tr>
                                    <th class="hidden-480">STT</th>
                                    <th class="table-icon"></th>
                                    <th>Tên kênh</th>
                                    <th class="hidden-480">ID Kênh</th>
                                    <th class="hidden-480">Last update</th>
                                    <th class="hidden-480">Số video</th>
                                    <th class="hidden-480">Ghi chú</th>
                                    <th class="table-icon hidden-480">Action</th>
                                </tr>
                                </thead>
                                <tbody id="dataChannel"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div id="paginateChannel" class="btn-toolbar" style="margin-top: 10px"></div>
        </div>
    </div>
    <div id="modal_add_channel" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 id="myModalLabel">Add Channel</h3>
                </div>
                <div class="modal-body">
                    <input type="text" name="idChannel" class="form-control" autocomplete="off">
                    <span class="label label-info">ID Channel lấy từ Youtube . Ví dụ : UCCE0ldAqiHLYeQaa8yI2_aQ</span>
                </div>
                <!-- /.modal-body -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="save_channel">Thêm</button>
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
        $(document).ready(function() {

            Youtube.getJsonData(APIGetListChannelURL, function (data) {
                Youtube.parseDataChannel(data);
            });

            $('#paginateChannel').on('click', '.pager a', function(e) {
                e.preventDefault();
                Youtube.getJsonData(APIGetListChannelURL + $(this).data('link'), function (data) {
                    Youtube.parseDataChannel(data);
                });
            });

            $('#save_channel').on('click', function (e) {
                $(this).text('Loading...');
                e.preventDefault();
                var formData = {
                    idChannel: $("input[name=idChannel]").val(),
                };
                $.ajax({
                    url: '{{ route('channel.store') }}',
                    type: 'POST',
                    data: formData,
                    dataType: 'JSON',
                    success: function (data) {
                        if(data.success == true){
                            $("#modal_add_channel").modal('hide');
                            Youtube.getJsonData(APIGetListChannelURL, function (data) {
                                Youtube.parseDataChannel(data);
                            });
                            Youtube.showNotice('success', data.message, Youtube.languages.notices_msg.success);
                        };
                    },
                    error:function (xhr, ajaxOptions, thrownError){
                        xhr = jQuery.parseJSON(xhr.responseText);
                        Youtube.showNotice('error', xhr.data, xhr.message);
                    },
                    complete: function () {
                        $('#save_channel').text('Thêm');
                    }

                });

            });
            $('#select_all_channel').change(function() {
                var checkboxes = $('#dataChannel').find(':checkbox');
                checkboxes.prop('checked', $(this).is(':checked'));
            });
            $(function(){
                $('#deleteButton').click(function(){
                    var listChannel = [];
                    $(':checkbox:checked').each(function(i){
                        listChannel[i] = $(this).val();
                    });
                    var removeItem = 'on';
                    listChannel = jQuery.grep(listChannel, function(value) {
                        return value != removeItem;
                    });
                    if(listChannel.length === 0){
                        Youtube.showNotice('error', 'Vui lòng chọn kênh', 'Error');
                    }else{
                        if(confirm("Are you sure?")){
                           deleteChannel(listChannel);
                        }
                    }
                });
            });

        });
        $(document).on("click", '#nameChannel', function() {
            $(this).editable({
                url: '{{ route('channel.update.name') }}',
                type: 'text',
                ajaxOptions:{
                    type:'post'
                } ,
                title: 'Nhập tên kênh',
                success: function(data) {
                    if(data.success === true){
                        Youtube.showNotice('success', data.message, Youtube.languages.notices_msg.success);
                    }
                },
                error:function (xhr, ajaxOptions, thrownError){
                    xhr = jQuery.parseJSON(xhr.responseText);
                    Youtube.showNotice('error', xhr.data, xhr.message);
                },
            });

        });
        $(document).on("click", '#noteChannel', function() {
            $(this).editable({
                url: '{{ route('channel.update.note') }}',
                type: 'text',
                ajaxOptions:{
                    type:'post'
                } ,
                placeholder: 'Ghi chú kênh',
                title: 'Ghi chú kênh',
                success: function(data) {
                    if(data.success === true){
                        Youtube.showNotice('success', data.message, Youtube.languages.notices_msg.success);
                    }
                },
                error:function (xhr, ajaxOptions, thrownError){
                    xhr = jQuery.parseJSON(xhr.responseText);
                    Youtube.showNotice('error', xhr.data, xhr.message);
                },
            });

        });
        function deleteChannel(listChannel){
            $.ajax({
                type: "POST",
                url: "{{ route('channel.delete') }}",
                data: { listChannel: listChannel},
                success: function(result){
                    if(result.success === true){
                        Youtube.getJsonData(APIGetListChannelURL, function (data) {
                            Youtube.parseDataChannel(data);
                        });
                        Youtube.showNotice('success', result.message, Youtube.languages.notices_msg.success);
                    }
                },
                error:function (xhr, ajaxOptions, thrownError){
                    xhr = jQuery.parseJSON(xhr.responseText);
                    Youtube.showNotice('error', xhr.data, xhr.message);
                },
            });
        }

    </script>

@stop