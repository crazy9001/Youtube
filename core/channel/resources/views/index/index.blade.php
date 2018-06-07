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
                                            <a href="#" class="btn" data-toggle="dropdown" rel="tooltip" data-placement="bottom" data-original-title="Chọn tất cả">
                                                <i class="fa fa-square-o"></i>
                                            </a>
                                            <a href="#" class="btn" rel="tooltip" data-placement="bottom" title="" data-original-title="Archive">
                                                <i class="fa fa-inbox"></i>
                                            </a>
                                            <a href="#" class="btn" rel="tooltip" data-placement="bottom" title="" data-original-title="Mark as spam">
                                                <i class="fa fa-exclamation-triangle"></i>
                                            </a>
                                            <a href="#" class="btn" rel="tooltip" data-placement="bottom" title="" data-original-title="Delete">
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
                                <tbody id="dataChannel">
                                    {{--<tr>
                                        <td class="table-checkbox hidden-480 table-stt">
                                            1
                                        </td>
                                        <td>
                                            <img src="https://dantricdn.com/2018/6/2/photo-1-15279301495401624388931.png" width="80px">
                                        </td>
                                        <td>
                                            Lorem ipsum sint laborum.
                                        </td>
                                        <td class="hidden-480">
                                            06/07/2018
                                        </td>
                                        <td class="hidden-480">
                                            12,500,500
                                        </td>
                                        <td class="hidden-480">
                                            Lorem ipsum sint laborum.
                                        </td>
                                        <td class="hidden-480">
                                            <input type="checkbox" class="selectable">
                                            <a href="#" class="sel-star active">
                                                <i class="fa fa-star"></i>
                                            </a>
                                        </td>
                                        <td class="hidden-480">
                                            12
                                        </td>
                                    </tr>--}}
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div id="modal_add_channel" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
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

        function overLoadDataChannel(){
            $.ajax({
                url: '{{ route('channel.list') }}',
                type: 'GET',
                success: function (data, textStatus, jqXHR) {
                    var row = '';
                    console.log(typeof data.data);
                    if((data.data).length){
                        $.each(data.data, function (i, item) {
                            row += '<tr>' +
                                '<td class="table-checkbox hidden-480 table-stt"> ' + i + ' </td>' +
                                '<td> <a href="' + Youtube.GlobalLinkChannelYoutube + item.id_channel + '" target="_blank"> <img src="' + item.images + '" width="50px"> </a></td>' +
                                '<td><span class="nameChannel">' + item.name + '</span> </td>' +
                                '<td class="hidden-480">' + item.id_channel + ' </td>' +
                                '<td class="hidden-480"> 06/07/2018 </td>' +
                                '<td class="hidden-480"> 12,500,500 </td>' +
                                '<td class="hidden-480"> ' + item.note + ' </td>' +
                                '<td class="hidden-480">' +
                                '<input type="checkbox" class="selectable">' +
                                //'<a href="#" class="sel-star active"> <i class="fa fa-star"></i></a>' +
                                '</td>' +
                                '</tr>';

                        });
                    }else{
                        row += '<tr><td colspan="8">No data</td></tr>'
                    }
                    $('#dataChannel').html('');
                    $('#dataChannel').append(row);
                }
            });
        }

        $(document).ready(function() {
            overLoadDataChannel();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
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
                            overLoadDataChannel();
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


            $(document).on("click", '.nameChannel', function(event) {
                $(this).editable({
                    showbuttons: true,
                    url: '{{ route('channel.update.name') }}',
                    type: 'text',
                    title: 'Edit category',
                    ajaxOptions:{
                        type:'post'
                    } ,
                });

            });

        });

        /*$('.nameChannel').on('click', function (e) {
            $(this).editable({
                showbuttons: true
            });
        });*/



    </script>

@stop